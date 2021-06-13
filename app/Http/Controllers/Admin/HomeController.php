<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;

class HomeController
{
    public function index(Request $request)
    { 
        return view('admin.dashboard');
    }
}