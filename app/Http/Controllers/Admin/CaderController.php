<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait; 
use App\Http\Requests\StoreCaderRequest;
use App\Http\Requests\UpdateCaderRequest;
use App\Models\Cader;
use App\Models\User;
use App\Models\Skill;
use App\Models\City;
use App\Models\Specialization;
use App\Models\PreviousExperience;
use App\Models\AcademicDegree;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CaderController extends Controller
{
    use MediaUploadingTrait;
    
    public function previous_experience(){
        return view('admin.caders.partials.previous_experience');
    }

    public function new_previous_experience(Request $request){
        $previous_experience = PreviousExperience::create([
            'user_id' => $request->user_id,
            'company_name' => $request->company_name,
            'job_type' => $request->job_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]); 
        return redirect()->route('admin.caders.index');
    }

    public function new_acadmeic_degree(Request $request){
        $acadmeic_degree = AcademicDegree::create([
            'user_id' => $request->user_id,
            'university_name' => $request->university_name,
            'degree' => $request->degree,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]); 
        return redirect()->route('admin.caders.index');
    }

    public function update_approved(Request $request){
        $user = User::find($request->id);
        $user->approved = $request->status;
        if($user->save()){
            
            flash(trans('global.flash.user.approve'))->success();
            return 1;
        }
        flash(trans('global.flash.error'))->error();
        return 0;
    }

    public function index()
    {
        abort_if(Gate::denies('cader_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caders = Cader::with(['user.city'])->get();

        return view('admin.caders.index', compact('caders'));
    }

    public function create()
    {
        abort_if(Gate::denies('cader_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $skills = Skill::all();
        $specializations = Specialization::all();

        return view('admin.caders.create', compact('cities','skills','specializations'));
    }

    public function store(StoreCaderRequest $request)
    {
        
        $validated_requests = $request->validated();
        $validated_requests['password'] = bcrypt($request->password);
        $validated_requests['user_type'] = 'cader';
        $validated_requests['approved'] = 1;
        $user = User::create($validated_requests);
        $cader = Cader::create([
            'user_id' => $user->id,
            'description' => $validated_requests['description'],
        ]); 

        $cader->specializations()->sync($request->input('specializations', []));
        $cader->skills()->sync($this->mapSkills($request->input('skills')));


        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        foreach ($request->input('certificates', []) as $file) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('certificates');
        }

        if ($request->input('cv', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('cv'))))->toMediaCollection('cv');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        flash(trans('global.flash.user.success'))->success(); 
        return redirect()->route('admin.caders.index');
    }

    private function mapSkills($skills)
    {
        return collect($skills)->map(function ($i) {
            return ['progress' => $i];
        });
    }

    public function edit(Cader $cader)
    {
        abort_if(Gate::denies('cader_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), '');
        $specializations = Specialization::all();
        $cader->load(['specializations','skills']);
        $skills = Skill::get()->map(function($skill) use ($cader) {
            $skill->value = data_get($cader->skills->firstWhere('id', $skill->id), 'pivot.progress') ?? null;
            return $skill;
        });
        
        return view('admin.caders.edit', compact('cities', 'cader','skills','specializations'));
    }

    public function update(UpdateCaderRequest $request, Cader $cader)
    {

        $user = User::findOrFail($cader->user_id);
        $user->update($request->all());
        $cader->update([
            'description' => $request['description'], 
        ]);

        $cader->specializations()->sync($request->input('specializations', []));
        $cader->skills()->sync($this->mapSkills($request->input('skills',[])));

        if ($request->input('photo', false)) {
            if (!$user->photo || $request->input('photo') !== $user->photo->file_name) {
                if ($user->photo) {
                    $user->photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($user->photo) {
            $user->photo->delete();
        }

        if (count($user->certificates) > 0) {
            foreach ($user->certificates as $media) {
                if (!in_array($media->file_name, $request->input('certificates', []))) {
                    $media->delete();
                }
            }
        }
        $media = $user->certificates->pluck('file_name')->toArray();
        foreach ($request->input('certificates', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('certificates');
            }
        }

        if ($request->input('cv', false)) {
            if (!$user->cv || $request->input('cv') !== $user->cv->file_name) {
                if ($user->cv) {
                    $user->cv->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('cv'))))->toMediaCollection('cv');
            }
        } elseif ($user->cv) {
            $user->cv->delete();
        }

        flash(trans('global.flash.user.updated'))->success();
        return redirect()->route('admin.caders.index');
    }

    public function show(Cader $cader)
    {
        abort_if(Gate::denies('cader_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cader->load(['skills','specializations','user.previous_experience']);
        return view('admin.caders.show', compact('cader'));
    }

    public function destroy(Cader $cader)
    {
        abort_if(Gate::denies('cader_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cader->delete();

        return back();
    } 

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}