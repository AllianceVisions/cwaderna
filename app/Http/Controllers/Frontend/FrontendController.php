<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Cader;
use Auth;

class FrontendController extends Controller
{
    public function home(){
        $caders = Cader::with(['specializations','user'])->withCount('events')->orderBy('created_at','asc')->get()->take(8);
        return view('frontend.home',compact('caders'));
    }
    public function aboutus(){
        return view('frontend.aboutus');
    } 
    public function contact(){
        return view('frontend.contact');
    } 
}
