<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait; 
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\City;
use App\Models\Event;
use App\Models\Nationality;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Alert;

class UsersController extends Controller
{
    use MediaUploadingTrait;
    
    public function update_approved(Request $request){
        $user = User::find($request->id);
        $user->approved = $request->status;
        $user->save(); 
        Alert::success( trans('global.flash.user.approve')); 
        return 1; 
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with(['roles','city'])->where('id','!=',Auth::id())->where('user_type','staff')->select(sprintf('%s.*', (new User)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_show';
                $editGate      = 'user_edit';
                $deleteGate    = 'user_delete';
                $printGate    = 'user_print';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'printGate',
                    'crudRoutePart',
                    'row'
                ));
            });


            $table->editColumn('approved', function ($row) {
                return '<label class="c-switch c-switch-pill c-switch-success">
                            <input onchange="update_approved(this)" value=' . $row->id . ' type="checkbox" class="c-switch-input" ' . ($row->approved ? 'checked' : null) . '>
                            <span class="c-switch-slider"></span>
                        </label>';
            });

            $table->editColumn('address', function ($row) {
                $name = 'name_'.app()->getLocale();
                $city =  $row->city ? $row->city->$name : ""; 
                return $city;
            });

            $table->editColumn('first_name', function ($row) {
                $first = $row->first_name ? $row->first_name : "";
                $last = $row->last_name ? $row->last_name : "";
                return $first . ' ' . $last; 
            });

            $table->editColumn('city', function ($row) {
                $name = 'name_'.app()->getLocale();
                return $row->city ? $row->city->$name : ""; 
            }); 

            $table->editColumn('roles', function ($row) {
                $labels = [];

                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });

            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }
            });

            $table->rawColumns(['actions', 'placeholder','approved', 'roles','photo']);

            return $table->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');
        $events = Event::get(); 
        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $nationalites = Nationality::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 
        
        return view('admin.users.create', compact('roles','events','cities','nationalites'));
    }

    public function store(StoreUserRequest $request)
    {
        $validated_requests = $request->validated();
        $validated_requests['password'] = bcrypt($request->password);
        $validated_requests['user_type'] = 'staff';
        $validated_requests['approved'] = 1;
        $user = User::create($validated_requests);

        $user->roles()->sync($request->input('roles', []));
        $user->events()->sync($request->input('events', []));

        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }
            
        Alert::success( trans('global.flash.user.success'));
        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');
        $events = Event::with('event_organizer.user')->get(); 
        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $nationalites = Nationality::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $user->load(['roles','events']);

        return view('admin.users.edit', compact('roles', 'user','events','cities','nationalites'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->events()->sync($request->input('events', []));

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

        Alert::success( trans('global.flash.user.updated'));
        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();


        Alert::success( trans('global.flash.user.deleted'));
        return 1;
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