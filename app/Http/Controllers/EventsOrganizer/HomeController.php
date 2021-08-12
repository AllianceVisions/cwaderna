<?php

namespace App\Http\Controllers\EventsOrganizer;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use App\Models\EventOrganizer;
use Auth;

class HomeController
{public $sources = [
        [
            'model'      => '\App\Models\Event',
            'date_field' => 'start_date',
            'field'      => 'title',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.events.edit',
        ],
    ];
    public function index(Request $request)
    { 
        $event_organizer = EventOrganizer::where('user_id',Auth::id())->first();
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::where('event_organizer_id',$event_organizer->id)->get() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];
                $crudFieldValue2 = $model->getAttributes()['start_attendance'];
                $crudFieldValue3 = $model->getAttributes()['end_date'];
                $crudFieldValue4 = $model->getAttributes()['end_attendance'];

                if (!$crudFieldValue) {
                    continue;
                }

                if (!$crudFieldValue2) {
                    continue;
                }

                if (!$crudFieldValue3) {
                    continue;
                }
                if (!$crudFieldValue4) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue . " " . $crudFieldValue2, 
                    'end' => $crudFieldValue3 . " " . $crudFieldValue4, 
                    'url'   => route($source['route'], $model->id),
                    'color' => '#922B21',
                ];
            }
        }
        return view('events_organizer.dashboard',compact('events'));
    }
}