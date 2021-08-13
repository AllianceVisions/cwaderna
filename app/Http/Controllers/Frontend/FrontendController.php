<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Cader;
use Auth;
use App\Models\GeneralSettings; 
use App\Models\Slider; 
use App\Models\ContactUs; 
use Alert;

class FrontendController extends Controller
{
    public function home(){
        $general_settings = GeneralSettings::first();
        $sliders = Slider::orderBy('created_at','desc')->get();
        $caders = Cader::with(['specializations','user'])->withCount('events')->orderBy('created_at','asc')->get()->take(8);
        return view('frontend.home',compact('caders','general_settings','sliders'));
    }
    public function aboutus(){
        $general_settings = GeneralSettings::first();
        return view('frontend.aboutus',compact('general_settings'));
    } 
    public function contact(){
        return view('frontend.contact');
    } 

    public function save_contactus(Request $request){
        ContactUs::create($request->all());
        Alert::success('تم الأرسال بنجاح','سيتم التواصل معك');
        return view('frontend.contact');
    }
}
