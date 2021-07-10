<?php

namespace App\Http\Controllers\EventsOrganizer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait; 
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\City;
use App\Models\Specialization;
use App\Models\EventOrganizer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EventsController extends Controller
{
    use MediaUploadingTrait;

    public function change_status($id, $status){
        $event = Event::findOrFail($id);
        $event->load(['items']); 
        if($status == 'accept'){
            $event->status = 'accept';
            foreach($event->items as $item){
                $item->pivot->status = 'ordered';
                $item->pivot->save();
            }
        }elseif($status == 'refused'){ 
            $event->status = 'refused';
        }else{
            flash('حدث خطأ')->error();
            return redirect()->route('events-organizer.events.show',$id);
        }
        $event->save();
        
        flash('تم التغديل')->success();
        return redirect()->route('events-organizer.events.show',$id);
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
                        asset($photo->url),
                        asset($photo->thumbnail)
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

        $event->specializations()->sync($this->mapSpecializations($data['specializations']));

        if ($request->input('photo', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        return redirect()->route('events-organizer.events.index');
    }

    private function mapSpecializations($specializations)
    {
        return collect($specializations)->map(function ($i) {
            return ['num_of_caders' => $i];
        });
    }

    public function edit(Event $event)
    { 

        $event_organizers = EventOrganizer::all()->pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 

        $event->load(['event_organizer','specializations']); 
        $specializations = Specialization::get()->map(function($specialize) use ($event) {
            $specialize->value = data_get($event->specializations->firstWhere('id', $specialize->id), 'pivot.num_of_caders') ?? null;
            return $specialize;
        }); 
        
        return view('events_organizer.events.edit', compact('event_organizers', 'event','cities','specializations'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $data = $request->validated();

        $event->update($data);

        $event->specializations()->sync($this->mapSpecializations($data['specializations']));

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

        return redirect()->route('events-organizer.events.index');
    }

    public function show(Event $event)
    { 

        $event->load(['event_organizer','specializations']); 
        
        return view('events_organizer.events.show', compact('event'));
    }

    public function destroy(Event $event)
    { 

        $event->delete();

        return back();
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