<?php

namespace App\Http\Controllers\Cader;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;

class HomeController
{
    public function index(Request $request)
    { 
        return view('cader.dashboard');
    }
}