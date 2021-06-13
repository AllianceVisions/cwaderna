<?php

namespace App\Http\Controllers\EventsOrganizer;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;

class HomeController
{
    public function index(Request $request)
    { 
        return view('events_organizer.dashboard');
    }
}