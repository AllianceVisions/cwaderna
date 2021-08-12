<?php

namespace App\Http\Controllers\ProviderMan;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\ProviderMan;
use Auth;

class OrdersController
{
    public function index(Request $request)
    { 
        $provider_man = ProviderMan::where('user_id',Auth::id())->first();
        $events = Event::with('items')->orderBy('created_at','desc')->get(); 
        return view('provider_man.orders.index',compact('events','provider_man'));
    }
}