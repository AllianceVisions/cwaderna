<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home(){
        return view('frontend.home');
    }
    public function aboutus(){
        return view('frontend.aboutus');
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function cader_register(){
        return view('frontend.cader_register');
    }
    public function cader_single(){
        return view('frontend.cader_single');
    }
    public function cwaders(){
        return view('frontend.cwaders');
    }
    public function services(){
        return view('frontend.services');
    }
    public function services_request(){
        return view('frontend.services_request');
    }
    public function tickets(){
        return view('frontend.tickets');
    }
    public function organizers(){
        return view('frontend.organizers');
    }
    public function organizers_register(){
        return view('frontend.organizers_register');
    }
    
}
