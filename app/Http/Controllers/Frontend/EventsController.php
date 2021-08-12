<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Cader;
use App\Models\User;
use App\Models\UserAlert;
use Auth;
use Alert;

class EventsController extends Controller
{
    public function my_list(){
        $events = Event::with(['caders.user','items','city']) 
                        ->where('status','pending')
                        ->where('event_organizer_id',Auth::user()->events_organizer->id ?? 0)
                        ->orderBy('created_at','desc')
                        ->paginate(5);
        return view('frontend.events.my_list',compact('events'));
    }

    public function cader_destroy(Request $request){
        $event = Event::findOrFail($request->event_id);
        $event->caders()->wherePivot('cader_id','=',$request->cader_id)->detach();
        Alert::success('تم حذف الكادر من الفعالية');
        return redirect()->route('frontend.my_list');
    }

    public function service_destroy(Request $request){
        $event = Event::findOrFail($request->event_id);
        $event->items()->wherePivot('item_id','=',$request->item_id)->detach(); 
        Alert::success('تم حذف الخدمة من الفعالية');
        return redirect()->route('frontend.my_list');
    }

    public function event_request($id){
        
        $event = Event::findOrFail($id);
        $event->status = 'request_to_pricing';
        $event->save(); 

        $users = User::where('user_type','staff')->get()->pluck('id');

        $userAlert = UserAlert::create([
            'alert_text' => 'طلب تسعيرة جديدة من ' . $event->event_organizer->company_name . ' للفعالية ' . $event->title ,
            'alert_link' => $event->id,
            'type' => 'event',
        ]);
        $userAlert->users()->sync($users);
        Alert::success('تم طلب التسعير','سيتم الرد خلال 24 ساعة');
        return redirect()->route('frontend.my_list');
    }
}
