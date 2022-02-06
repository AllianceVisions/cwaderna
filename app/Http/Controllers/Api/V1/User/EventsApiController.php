<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\Event; 
use App\Models\Cader; 
use Validator;
use Auth;
use App\Http\Resources\V1\User\EventsResource;

class EventsApiController extends Controller
{
    use api_return;

    public function index(){

        $now_date = date('Y-m-d',strtotime('now'));  
        $cader = Cader::where('user_id',Auth::id())->first(); 
        global $my_specialization;
        $events_already_joined = $cader->events()->get()->pluck('id');
        $my_specialization = $cader->specializations()->get()->pluck('id'); 
        
        $events = Event::with('caders')->whereNotIn('id',$events_already_joined)
                        ->whereIn('status',['pending','request_to_pricing'])
                        ->where('start_date','<=',$now_date)->where('end_date','>=',$now_date)
                        ->whereHas('specializations',function ($query) {
                            $query->whereIn('id',$GLOBALS['my_specialization']);
                        })
                        ->orderBy('created_at','desc')->paginate(10);
        $new = EventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    }

    public function search($search){ 
        global $searching, $local;
        $searching = $search; 
        $local = 'name_' . app()->getLocale();
        $events = Event::whereIn('status',['pending','request_to_pricing'])->with(['city','specializations'])->whereHas('city',function ($query) {
                                    $query->where($GLOBALS['local'], 'like', '%'.$GLOBALS['searching'].'%');
                                })->orWhereHas('specializations',function ($query) {
                                    $query->where($GLOBALS['local'], 'like', '%'.$GLOBALS['searching'].'%');
                                })->orderBy('created_at','desc')->paginate(10); 
        $new = EventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    }

    public function join(Request $request){ 
        $event = Event::find($request->event_id); 
        $cader = Cader::where('user_id',Auth::id())->first();

        $collection0 = collect($event->specializations);
        if (!$collection0->contains('id', $request->specialization_id)) {  
            return $this->returnError('401',('لا تتضمن هذه الفعالية هذا التخصص'));
        }

        if(!$event){
            return $this->returnError('404',('Not Found !!!'));
        }else{
            $collection = collect($cader->specializations);
            
            $collection2 = collect($event->caders()->wherePivot('cader_id',$cader->id)->get()); // prevent requrest join if organizer or admin requested him before
            
            if (!$collection->contains('id', $request->specialization_id)) {  
                return $this->returnError('401',('لا تتضمن تخصصاتك هذا التخصص'));
            } elseif ($collection2->contains('pivot.cader_id', $cader->id) && !$collection2->contains('pivot.request_type', 'by_cader')) {
                return $this->returnError('401',('انت بالفعل مطلوب في هذه الفعالية'));
            } else { 
                
                $event->caders()->syncWithoutDetaching([
                    $cader->id => [ 
                        'specialization_id' => $request->specialization_id,
                        'status' => 'request',
                        'request_type' => 'by_cader',
                    ],
                ]);
                return $this->returnSuccessMessage(__('تم أرسال طلبك بنجاح'));
            } 
        }
    }

    public function response(Request $request){
        $rules = [
            'event_id' => 'required|integer',
            'type' => 'in:accepted,refused', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $event = Event::find($request->event_id); 
        $cader = Cader::where('user_id',Auth::id())->first();
        $event->caders()->syncWithoutDetaching([
            $cader->id => [ 
                'status' => $request->response, 
            ],
        ]);
        return $this->returnSuccessMessage(__('Response Sent Succeessfully'));
    }
    
}
