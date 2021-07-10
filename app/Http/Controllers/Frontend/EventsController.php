<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Cader;
use Auth;

class EventsController extends Controller
{
    public function my_list(){
        $events = Event::with(['caders.user','items','city'])
                        ->where(function($query) {
                            $query->whereHas('caders')
                            ->orWhereHas('items');
                        })
                        ->where('status','pending')
                        ->where('event_organizer_id',Auth::user()->events_organizer->id ?? 0)
                        ->orderBy('created_at','desc')
                        ->paginate(5);
        return view('frontend.events.my_list',compact('events'));
    }

    public function cader_destroy(Request $request){
        $event = Event::findOrFail($request->event_id);
        $event->caders()->wherePivot('cader_id','=',$request->cader_id)->detach();
        flash('تم حذف الكادر من الفعالية');
        return redirect()->route('frontend.my_list');
    }

    public function service_destroy(Request $request){
        $event = Event::findOrFail($request->event_id);
        $event->items()->wherePivot('item_id','=',$request->item_id)->detach();
        flash('تم حذف الخدمة من الفعالية');
        return redirect()->route('frontend.my_list');
    }

    public function event_request($id){
        $event = Event::findOrFail($id);
        $event->status = 'request_to_pricing';
        $event->save();
        flash('تم طلب التسعير');
        return redirect()->route('frontend.my_list');
    }
}
