<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use Illuminate\Http\Request;
use App\Models\ContactUs; 
use Alert;

class ContactUsController extends Controller
{ 
    
    public function index()
    {  
        $contactus = ContactUs::all();

        return view('admin.contactus.index',compact('contactus'));
    }

    public function destroy(ContactUs $contactus)
    {  
        $contactus->delete();

        Alert::success( trans('global.flash.deleted'));
        return 1;
    }
}