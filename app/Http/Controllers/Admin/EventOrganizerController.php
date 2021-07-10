<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait; 
use App\Http\Requests\StoreEventOrganizerRequest;
use App\Http\Requests\UpdateEventOrganizerRequest;
use App\Models\EventOrganizer;
use Gate;
use App\Models\User;
use App\Models\City;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EventOrganizerController extends Controller
{
    use MediaUploadingTrait;

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

    public function index(Request $request)
    {
        abort_if(Gate::denies('event_organizer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventorganizers = EventOrganizer::with(['user.city'])->get();

        return view('admin.eventOrganizers.index',compact('eventorganizers'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_organizer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $nationalites = Nationality::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 

        return view('admin.eventOrganizers.create',compact('cities','nationalites'));
    }

    public function store(StoreEventOrganizerRequest $request)
    {
        $validated_requests = $request->validated(); 
        $validated_requests['password'] = bcrypt($request->password);
        $validated_requests['user_type'] = 'events_organizer';
        $validated_requests['approved'] = 1;
        $user = User::create($validated_requests);
        $eventOrganizer = EventOrganizer::create([
            'user_id' => $user->id,
            'company_name' => $validated_requests['company_name']
        ]);

        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('identity', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('identity'))))->toMediaCollection('identity');
        }
        if ($request->input('commerical_reg', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('commerical_reg'))))->toMediaCollection('commerical_reg');
        }
        
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        flash(trans('global.flash.user.success'))->success();
        return redirect()->route('admin.event-organizers.index');
    }

    public function edit(EventOrganizer $eventOrganizer)
    {
        abort_if(Gate::denies('event_organizer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $nationalites = Nationality::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 

        return view('admin.eventOrganizers.edit', compact('eventOrganizer','cities','nationalites'));
    }

    public function update(UpdateEventOrganizerRequest $request, EventOrganizer $eventOrganizer)
    {
        $user = User::findOrFail($eventOrganizer->user_id);
        $user->update($request->all());
        
        $eventOrganizer->update(['company_name' => $request->company_name]);

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

        if ($request->input('identity', false)) {
            if (!$eventOrganizer->identity || $request->input('identity') !== $eventOrganizer->identity->file_name) {
                if ($eventOrganizer->identity) {
                    $eventOrganizer->identity->delete();
                }
                $eventOrganizer->addMedia(storage_path('tmp/uploads/' . basename($request->input('identity'))))->toMediaCollection('identity');
            }
        } elseif ($eventOrganizer->identity) {
            $eventOrganizer->identity->delete();
        }

        if ($request->input('commerical_reg', false)) {
            if (!$eventOrganizer->commerical_reg || $request->input('commerical_reg') !== $eventOrganizer->commerical_reg->file_name) {
                if ($eventOrganizer->commerical_reg) {
                    $eventOrganizer->commerical_reg->delete();
                }
                $eventOrganizer->addMedia(storage_path('tmp/uploads/' . basename($request->input('commerical_reg'))))->toMediaCollection('commerical_reg');
            }
        } elseif ($eventOrganizer->commerical_reg) {
            $eventOrganizer->commerical_reg->delete();
        }

        flash(trans('global.flash.user.updated'))->success();
        return redirect()->route('admin.event-organizers.index');
    }

    public function show(EventOrganizer $eventOrganizer)
    {
        abort_if(Gate::denies('event_organizer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eventOrganizers.show', compact('eventOrganizer'));
    }

    public function destroy(EventOrganizer $eventOrganizer)
    {
        abort_if(Gate::denies('event_organizer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventOrganizer->delete();

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
