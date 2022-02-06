<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait; 
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\City;
use App\Models\Specialization;
use App\Models\EventOrganizer;
use App\Models\EventBreak;
use App\Models\Cader;
use App\Models\UserAlert;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Traits\push_notification;
use Alert;
use DateTime;

class EventsController extends Controller
{
    use MediaUploadingTrait; 
    use push_notification; 


    public function partials_cader_break_status($id,$status){
        $event_break = EventBreak::findOrFail($id);
        $event_break->status = $status;
        $event_break->save();
        
        $cader = Cader::find($event_break->cader_id);
        if($status == 'accepted'){
            Alert::success('تم قبول الأذن'); 
            $title = 'تم قبول الأذن';
        }else{ 
            Alert::success('تم رفض الأذن');
            $title = 'تم رفض الأذن';
        }

        $this->send_notification($title, '' , $title , '' , 'break' , $cader->user_id, false,$status);

        return redirect()->route('admin.events.show',$event_break->event_id);
    }

    public function partials_cader_break(Request $request){
        $event_breaks = EventBreak::where('cader_id',$request->cader_id)->where('event_id',$request->event_id)->get(); 
        return view('admin.events.partials.break',compact('event_breaks'));
    }
    public function partials_zoominmap(Request $request){
        $cader = Cader::find($request->cader_id);

        $data = [
            'lat' => $cader->latitude,
            'lng' => $cader->longitude
        ];
        
        return response()->json($data);
    }

    public function add_cader(Request $request){
        $event = Event::findOrFail($request->event_id); 
        // $num_of_caders = $event->caders->where('pivot.specialization_id',$request->specialize_id)->count();
        // $num_of_caders2 =  $event->specializations->where('pivot.specialization_id',$request->specialize_id)->first()->pivot->num_of_caders ?? 0;
        
        $start = $request->start_attendance ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $request->start_attendance)->format('Y-m-d H:i:s') : null;
        $end = $request->end_attendance ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $request->end_attendance)->format('Y-m-d H:i:s') : null; 
        $event->caders()->syncWithoutDetaching([ $request->cader_id =>
                                    [
                                        'start_attendance' => $start,
                                        'end_attendance' => $end,
                                        'specialization_id' => $request->specialize_id,
                                        'profit' => $request->profit,
                                        'price' => $request->price,
                                        'status' => 'pending',
                                        'request_type' => 'by_admin',
                                    ]
                                ]); 
                                
        $relation_tab_specialization = $request->specialize_id;
        return view('admin.events.caders.caders',compact('event','relation_tab_specialization'));
        
    }

    public function partials_add_cader(Request $request){
        global $specialize_id;
        $specialize_id = $request->specialize_id;

        $start_attendance = $request->start_attendance;
        $end_attendance = $request->end_attendance;
        $event_id = $request->event_id;

        $event_caders = Event::with('caders')->findOrFail($event_id)->caders->pluck('id');

        $caders = Cader::whereHas('specializations', function ($query) {
            $query->where('id', $GLOBALS['specialize_id']);
        })->with('user')->whereNotIn('id',$event_caders)->get();

        return view('admin.events.caders.add',compact('caders','start_attendance','end_attendance','specialize_id','event_id'));
    }

    public function partials_edit_cader(Request $request){
        return view('admin.events.caders.edit')
                ->with([  
                    'price' => $request->price,
                    'start_attendance' => $request->start_attendance,
                    'end_attendance' => $request->end_attendance,
                    'profit' => $request->profit,
                    'cader_id' => $request->cader_id,
                    'event_id' => $request->event_id,
                    'specialize_id' => $request->specialize_id,
                ]);
    }

    public function partials_attendance_cader(Request $request){
        $event = Event::findOrFail($request->event_id); 
        $attendance = $event->attendance()->wherePivot('cader_id',$request->cader_id)->orderBy('pivot_created_at','asc')->get();   
        return view('admin.events.caders.attendance',compact('attendance','event'));
    }

    public function send_pricing($id){
        $event = Event::findOrFail($id);
        $name = 'name_' . app()->getLocale();
        $check_status_caders_status = $event->caders()->wherePivotIn('status',['pending','request','send_pricing'])->get(); 
        if($check_status_caders_status->count() == 0 ){

            foreach($event->specializations as $event_specialize){
                $num_of_caders = $event_specialize->pivot->num_of_caders;
                $count_caders = $event->caders()->wherePivot('status','accepted')->wherePivot('specialization_id',$event_specialize->id)->get();
                if($count_caders->count() < $num_of_caders){
                    $title = 'لايمكن اتمام العملية';
                    $body = ' لابد من أكتمال عدد الكوادر الموافقين في تخصص ' . $event_specialize->$name . ' إلي ' . $num_of_caders . ' كوادر';
                    Alert::error($title,$body);
                    return redirect()->route('admin.events.show',$id);
                }
            } 

            $event->status = 'pending_owner_accept';
            $event->save(); 
            Alert::success( trans('تم الأرسال')); 
            $userAlert = UserAlert::create([
                'alert_text' => 'تم تسعير الفعالية ' . $event->title,
                'alert_link' => $event->id,
                'type' => 'event',
            ]);
            $userAlert->users()->sync($event->event_organizer->user_id);

            return redirect()->route('admin.events.show',$id);
        }else{
            Alert::error('لايمكن اتمام العملية','لابد من أكتمال عدد الكوادر بالموافقة أو الرفض');
            return redirect()->route('admin.events.show',$id);
        }
    }

    public function cader_status(Request $request){
        $event = Event::findOrFail($request->event_id);
        $event->caders()->syncWithoutDetaching([ $request->cader_id =>
                                    [
                                        'status' => $request->type,
                                    ]
                                ]);  
        $relation_tab_specialization = $request->specialize_id;

        if($request->type == 'send_pricing'){
            
            $cader = Cader::find($request->cader_id);

            $alert_text = 'طلب موافقة علي الفعالية ' . $event->title;
            $alert_link = $event->id;

            $body = $alert_text;
            $title = 'فعالية جديدة';
            
            $this->send_notification($title , $body , $alert_text , $alert_link , 'event' , $cader->user_id,true,$event->id);
        }

        return view('admin.events.caders.caders',compact('event','relation_tab_specialization'));
    } 
    
    public function update_cader(Request $request){
        $event = Event::findOrFail($request->event_id);  
        $start = $request->start_attendance ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $request->start_attendance)->format('Y-m-d H:i:s') : null;
        $end = $request->end_attendance ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $request->end_attendance)->format('Y-m-d H:i:s') : null; 
        $event->caders()->syncWithoutDetaching([ $request->cader_id =>
                                    [
                                        'profit' => $request->profit,
                                        'price' => $request->price, 
                                        'start_attendance' => $start,
                                        'end_attendance' => $end,
                                    ]
                                ]);  
        $relation_tab_specialization = $request->specialize_id;
        return view('admin.events.caders.caders',compact('event','relation_tab_specialization'));
    }

    
    public function delete_cader(Request $request){
        $event = Event::findOrFail($request->event_id);
        $event->caders()->wherePivot('cader_id','=',$request->cader_id)->detach();  
        $relation_tab_specialization = $request->specialize_id;
        return view('admin.events.caders.caders',compact('event','relation_tab_specialization'));
    }
    
    public function add_item(Request $request){
        $event = Event::findOrFail($request->event_id);  
        $start = $request->start_attendance ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $request->start_attendance)->format('Y-m-d H:i:s') : null;
        $end = $request->end_attendance ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $request->end_attendance)->format('Y-m-d H:i:s') : null; 

        $event->items()->syncWithoutDetaching([ $request->item_id =>
                                    [
                                        'profit' => $request->profit,
                                        'price' => $request->price, 
                                        'start_attendance' => $start,
                                        'end_attendance' => $end,
                                    ]
                                ]);

        Alert::success( trans('global.flash.created')); 
        return redirect()->route('admin.events.show',['event' => $request->event_id , 'relation_tab' => 'service']);
    }
    
    public function update_item(Request $request){
        $event = Event::findOrFail($request->event_id);  
        $start = $request->start_attendance ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $request->start_attendance)->format('Y-m-d H:i:s') : null;
        $end = $request->end_attendance ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $request->end_attendance)->format('Y-m-d H:i:s') : null; 

        $event->items()->syncWithoutDetaching([ $request->item_id =>
                                    [
                                        'profit' => $request->profit,
                                        'price' => $request->price, 
                                        'start_attendance' => $start,
                                        'end_attendance' => $end,
                                    ]
                                ]);

        Alert::success( trans('global.flash.updated'));
        return redirect()->route('admin.events.show',['event' => $request->event_id , 'relation_tab' => 'service']);
    }

    public function refresh_caders_list(Request $request){ 
        $event = Event::findOrFail($request->event_id);  
        return view('admin.events.partials.caders_map',compact('event'));
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Event::with(['event_organizer','city'])->select(sprintf('%s.*', (new Event())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'event_show';
                $editGate = 'event_edit';
                $deleteGate = 'event_delete';
                $crudRoutePart = 'events';

                return view('partials.datatablesActions', compact(
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
            $table->addColumn('event_organizer_company_name', function ($row) {
                return $row->event_organizer ? $row->event_organizer->company_name : '';
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
            $table->editColumn('status', function ($row) {
                return $row->status ? trans('global.event_status.'.$row->status) : '';
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

        return view('admin.events.index');
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event_organizers = EventOrganizer::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $specializations = Specialization::get(); 

        return view('admin.events.create', compact('event_organizers','cities','specializations'));
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
        return redirect()->route('admin.events.index');
    } 

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
        
        return view('admin.events.edit', compact('event_organizers', 'event','cities','specializations'));
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
        return redirect()->route('admin.events.index');
    }

    public function show(Event $event,$relation_tab = null)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load(['event_organizer','specializations','caders']);   
        
        return view('admin.events.show', compact('event','relation_tab'));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
        abort_if(Gate::denies('event_create') && Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Event();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}