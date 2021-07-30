<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\Event; 
use App\Models\Cader; 
use Validator;
use Auth;
use App\Http\Resources\V1\User\CaderEventsResource;

class CaderEventsApiController extends Controller
{
    use api_return;

    public function index(){
        $cader = Cader::where('user_id',Auth::id())->first();
        $events = $cader->events()
                        ->wherePivotIn('status',['accepted','refused','request']) // حالة الكادر في الفعالية نم الموافقة عليها او رفضها او لم يتم اتخاذ اجراء لها
                        ->where('events.status','!=','refused') // حالة الفعالية لابد تكون غير مرفوضة
                        ->paginate(10); 
        $new = CaderEventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    } 

    public function accepted(){
        $cader = Cader::where('user_id',Auth::id())->first();
        $events = $cader->events()
                        ->wherePivot('status','accepted')
                        ->where('events.status','!=','refused') // حالة الفعالية لابد تكون غير مرفوضة
                        ->paginate(10); 
        $new = CaderEventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    } 

    public function refused(){
        $cader = Cader::where('user_id',Auth::id())->first();
        $events = $cader->events()
                        ->wherePivot('status','refused')
                        ->where('events.status','!=','refused') // حالة الفعالية لابد تكون غير مرفوضة
                        ->paginate(10); 
        $new = CaderEventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    } 

    public function pending(){
        $cader = Cader::where('user_id',Auth::id())->first();
        $events = $cader->events()
                        ->wherePivot('status','request')
                        ->where('events.status','!=','refused') // حالة الفعالية لابد تكون غير مرفوضة
                        ->paginate(10); 
        $new = CaderEventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    } 

    public function incoming(){
        $cader = Cader::where('user_id',Auth::id())->first();
        $events = $cader->events()
                        ->wherePivot('status','send_pricing')
                        ->where('events.status','!=','refused') // حالة الفعالية لابد تكون غير مرفوضة
                        ->paginate(10); 
        $new = CaderEventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    } 

    public function canceled(){
        $cader = Cader::where('user_id',Auth::id())->first();
        $events = $cader->events()
                        ->wherePivot('status','!=','pending')
                        ->where('events.status','refused')
                        ->paginate(10); 
        $new = CaderEventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    } 

    public function response(Request $request){
        $event = Event::find($request->event_id); 
        $cader = Cader::where('user_id',Auth::id())->first();
        $event->caders()->syncWithoutDetaching([
            $cader->id => [ 
                'status' => $request->response, 
            ],
        ]);
        return $this->returnSuccessMessage(__('Response Sent Succeessfully'));
    }
    

    public function attend(Request $request){
        $rules = [
            'event_id' => 'required|integer', 
            'latitude' => 'required', 
            'longitude' => 'required', 
            'type' => 'in:attend,leave', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $event = Event::find($request->event_id); 
        $cader = Cader::where('user_id',Auth::id())->first();
        $distance = $this->twopoints_on_earth($event->latitude,$event->longitude,$request->latitude,$request->longitude);
        $event->attendance()->attach([
            $cader->id => [ 
                'out_of_zone' => $distance > $event->area ? 1 : 0, 
                'type' => $request->type,
                'attendance1' => date('Y-m-d',time()),
                'attendance2' => date('H:i:s',time()),
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'distance' => $distance, 
            ],
        ]);
        return $this->returnSuccessMessage(__('Response Sent Succeessfully'));
    }

    // calculate distance between twopoints_on_earth
    function twopoints_on_earth($latitudeFrom, $longitudeFrom, $latitudeTo,  $longitudeTo)
    {
        $long1 = deg2rad($longitudeFrom);
        $long2 = deg2rad($longitudeTo);
        $lat1 = deg2rad($latitudeFrom);
        $lat2 = deg2rad($latitudeTo);
            
        //Haversine Formula
        $dlong = $long2 - $long1;
        $dlati = $lat2 - $lat1;
            
        $val = pow(sin($dlati/2),2)+cos($lat1)*cos($lat2)*pow(sin($dlong/2),2);
            
        $res = 2 * asin(sqrt($val));
            
        $radius = 3958.756;
        
        //transform to meter
        $transform = (1.609344 * 1000);
        return ($res*$radius) * $transform;
    }

}
