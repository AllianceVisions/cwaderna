<?php

namespace App\Http\Controllers\EventsOrganizer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait; 
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\City;
use App\Models\ProviderMan;
use App\Models\UserAlert;
use App\Models\User;
use App\Models\Specialization;
use App\Models\EventOrganizer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Alert; 
use Carbon\Carbon;

class EventsController extends Controller
{
    use MediaUploadingTrait;

    public function change_status($id, $status){
        $event = Event::findOrFail($id);
        $event->load(['items']); 
        if($status == 'accepted'){
            $event->status = 'accepted';
            foreach($event->items as $item){
                $item->pivot->status = 'ordered';
                $item->pivot->save();
                $provider_man = ProviderMan::find($item->provider_man_id);
                $userAlert2 = UserAlert::create([
                    'alert_text' => 'لديك طلب جديد للفعالية ' . $event->title,
                    'alert_link' => $event->id,
                    'type' => 'event',
                ]);
                $userAlert2->users()->sync($provider_man->user_id);
            } 
            $users = User::where('user_type','staff')->get()->pluck('id');

            $userAlert = UserAlert::create([
                'alert_text' => 'تم الموافقة علي التسعيرة للفعالية ' . $event->title,
                'alert_link' => $event->id,
                'type' => 'event',
            ]);
            $userAlert->users()->sync($users);
            Alert::success('تم الموافقة علي التسعيرة');
        }elseif($status == 'refused'){ 
            $event->status = 'refused';
            Alert::success('تم رفض التسعيرة');
        }else{ 
            Alert::error('حدث خطأ');
            return redirect()->route('events-organizer.events.show',$id);
        }
        $event->save();
        
        return redirect()->route('events-organizer.events.show',$id);
    }

    public function partials_attendance_cader(Request $request){
        $event = Event::findOrFail($request->event_id); 
        $attendance = $event->attendance()->wherePivot('cader_id',$request->cader_id)->orderBy('pivot_created_at','asc')->get();   
        return view('events_organizer.events.partials.attendance_cader',compact('attendance','event'));
    }

    public function index(Request $request)
    { 
        if ($request->ajax()) {
            $query = Event::with(['event_organizer','city'])->where('event_organizer_id',auth()->user()->events_organizer->id)->select(sprintf('%s.*', (new Event())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'event_show';
                $editGate = 'event_edit';
                $deleteGate = 'event_delete';
                $crudRoutePart = 'events-organizer.events';

                return view('partials.datatablesActions-noauth', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            }); 
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('city', function ($row) {
                $name = 'name_'.app()->getLocale();
                return $row->city ? $row->city->$name : '';
            });
            $table->editColumn('address', function ($row) {
                $name = 'name_'.app()->getLocale();
                $address =  $row->address ? $row->address : "";
                $city =  $row->city ? $row->city->$name : ""; 
                return $city . ', ' . $address;
            });
            $table->editColumn('conditions', function ($row) {
                return $row->conditions ? $row->conditions : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            }); 
            
            $table->editColumn('specializations', function ($row) {
                $name = 'name_'.app()->getLocale();
                $labels = [];

                foreach ($row->specializations as $specialize) {
                    $labels[] = sprintf('<span class="badge bg-secondary">%s<span class="badge bg-success text-white">%s</span></span>', $specialize->$name, $specialize->pivot->num_of_caders);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? trans('global.event_status.'.$row->status) : '';
            });
            $table->editColumn('date', function ($row) {
                $start = $row->start_date ? $row->start_date : '';
                $end = $row->end_date ? $row->end_date : '';
                return sprintf('<span class="badge bg-light text-dark">%s</span> <br> <span class="badge bg-secondary">%s</span>',$start,$end);
            });
            $table->editColumn('attendance', function ($row) {
                $start = $row->start_attendance ? $row->start_attendance : '';
                $end = $row->end_attendance ? $row->end_attendance : '';
                return sprintf('<span class="badge bg-light text-dark">%s</span> <br> <span class="badge bg-secondary">%s</span>',$start,$end);
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'event_organizer', 'photo', 'date', 'attendance','specializations']);

            return $table->make(true);
        }

        return view('events_organizer.events.index');
    }

    public function create()
    { 

        $event_organizers = EventOrganizer::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $specializations = Specialization::get(); 

        return view('events_organizer.events.create', compact('event_organizers','cities','specializations'));
    }

    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();

        $event = Event::create($data);

        //change datetime format that match database
        foreach($data['specializations'] as $key => $row){
            if($data['specializations'][$key]['start_attendance'] ?? 0 && data['specializations'][$key]['end_attendance'] ?? 0){ 
                $data['specializations'][$key]['start_attendance'] = Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $data['specializations'][$key]['start_attendance'])->format('Y-m-d H:i:s');
                $data['specializations'][$key]['end_attendance'] = Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $data['specializations'][$key]['end_attendance'])->format('Y-m-d H:i:s');
            }
        } 
        
        $event->specializations()->sync($data['specializations']);

        if ($request->input('photo', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        Alert::success( trans('global.flash.created'));
        return redirect()->route('events-organizer.events.index');
    }


    public function edit(Event $event)
    { 

        if(in_array($event->status,['accepted','refused','pending_owner_accept'])){
            Alert::error('لايمكن تعديل الفعالية');
            return back();
        }

        $event_organizers = EventOrganizer::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 

        $event->load(['event_organizer','specializations']); 
        $specializations = Specialization::get()->map(function($specialize) use ($event) {
            $specialize->num_of_caders = data_get($event->specializations->firstWhere('id', $specialize->id), 'pivot.num_of_caders') ?? null;
            $specialize->budget = data_get($event->specializations->firstWhere('id', $specialize->id), 'pivot.budget') ?? null;
            $specialize->start_attendance = data_get($event->specializations->firstWhere('id', $specialize->id), 'pivot.start_attendance') ?? null;
            $specialize->start_attendance = $specialize->start_attendance ? Carbon::createFromFormat('Y-m-d H:i:s', $specialize->start_attendance)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
            $specialize->end_attendance = data_get($event->specializations->firstWhere('id', $specialize->id), 'pivot.end_attendance') ?? null;
            $specialize->end_attendance = $specialize->end_attendance ? Carbon::createFromFormat('Y-m-d H:i:s', $specialize->end_attendance)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
            return $specialize;
        }); 
        
        return view('events_organizer.events.edit', compact('event_organizers', 'event','cities','specializations'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $data = $request->validated();

        $event->update($data); 

        //change datetime format that match database
        foreach($data['specializations'] as $key => $row){
            if($data['specializations'][$key]['start_attendance'] ?? 0 && data['specializations'][$key]['end_attendance'] ?? 0){ 
                $data['specializations'][$key]['start_attendance'] = Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $data['specializations'][$key]['start_attendance'])->format('Y-m-d H:i:s');
                $data['specializations'][$key]['end_attendance'] = Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $data['specializations'][$key]['end_attendance'])->format('Y-m-d H:i:s');
            }
        }

        $event->specializations()->sync($data['specializations']);

        if ($request->input('photo', false)) {
            if (!$event->photo || $request->input('photo') !== $event->photo->file_name) {
                if ($event->photo) {
                    $event->photo->delete();
                }
                $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($event->photo) {
            $event->photo->delete();
        }

        Alert::success( trans('global.flash.updated'));

        return redirect()->route('events-organizer.events.index');
    }

    public function show(Event $event)
    { 

        $event->load(['event_organizer','specializations']); 
        
        return view('events_organizer.events.show', compact('event'));
    }

    public function destroy(Event $event)
    { 

        if(in_array($event->status,['accepted','refused','pending_owner_accept'])){
            Alert::error('لايمكن تعديل الفعالية');
            return back();
        }

        $event->delete();

        Alert::success( trans('global.flash.deleted'));
        return 1;
    }

    public function storeCKEditorImages(Request $request)
    { 

        $model         = new Event();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}