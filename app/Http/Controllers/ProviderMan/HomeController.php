<?php

namespace App\Http\Controllers\ProviderMan;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;

class HomeController
{
    public function index(Request $request)
    { 
        return view('provider_man.dashboard');
    }
}