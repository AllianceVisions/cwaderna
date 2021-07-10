<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Event;
use App\Models\City;
use App\Models\User;
use App\Models\ProviderMan;
use App\Models\Nationality;
use Auth;

class ServicesController extends Controller
{
    public function all_services(){
        $events = Event::where('event_organizer_id',Auth::user()->events_organizer->id ?? 0)->where('status','pending')->orderBy('created_at','desc')->get();
        $items = Item::paginate(3);
        return view('frontend.services.all_services',compact('items','events'));
    }

    public function add_service_to_event(Request $request){
        $event = Event::findOrFail($request->event_id); 
        $start = $request->start_attendance ? date('Y-m-d H:i:s',strtotime($request->start_attendance)) : null;
        $end = $request->end_attendance ? date('Y-m-d H:i:s',strtotime($request->end_attendance)) : null;

        $event->items()->syncWithoutDetaching([ $request->item_id =>
                                    [
                                        'start_attendance' => $start,
                                        'end_attendance' => $end,
                                        'status' => 'pending',
                                    ]
                                ]);

        flash('تم اضاقة الخدمة للفعاية')->success();
        return back();
    }

    public function service_register(){
        $cities = City::get()->pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $nationalites = Nationality::get()->pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), ''); 
        return view('frontend.services.reg_sponser',compact('cities','nationalites'));
    }
    
    public function register_submit(Request $request){
        
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required',
            'city_id' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'nationality_id' => 'required',
            'identity_num' => 'required',
        ]);
        $validated_requests = $request->all();
        $validated_requests['password'] = bcrypt($request->password);
        $validated_requests['user_type'] = 'provider_man';
        $validated_requests['approved'] = 0;
        $user = User::create($validated_requests);
        $provider_man = ProviderMan::create([
            'user_id' => $user->id,
            'company_name' => $validated_requests['company_name'],
            'website' => $validated_requests['website'],
            'commerical_reg_num' => $validated_requests['commerical_reg_num'],
            'working_field' => $validated_requests['working_field'],
        ]);  
        
        flash('تم ارسال طلب الأنضمام بنجاح');
        return back();
    }
    public function services(){
        return view('frontend.services.services');
    }
    public function services_request(){
        return view('frontend.services.services_request');
    }
    public function tickets(){
        return view('frontend.services.tickets');
    }
}
