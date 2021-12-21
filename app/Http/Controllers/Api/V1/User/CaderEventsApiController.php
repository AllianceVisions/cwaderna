<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\Event; 
use App\Models\Cader; 
use Validator;
use Auth;
use App\Events\ChangeLocation;
use App\Http\Resources\V1\User\CaderEventsResource;
use App\Http\Resources\V1\User\EventsResource;
use App\Traits\push_notification;

class CaderEventsApiController extends Controller
{
    use api_return;
    use push_notification; 

    public function find($id){
        $cader = Cader::where('user_id',Auth::id())->first();
        $event = $cader->events()->where('id',$id)->first(); 
        if(!$event){
            return $this->returnError('404',('Not Found !!!'));
        }
        $new = new CaderEventsResource($event);
        return $this->returnData($new,'success');
    } 

    public function index(){
        $cader = Cader::where('user_id',Auth::id())->first();
        $events = $cader->events()->paginate(10); 
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
            'type' => 'in:attend,leave,stream', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }
        
        $event = Event::find($request->event_id); 

        $distance = $this->twopoints_on_earth($event->latitude,$event->longitude,
                                            $request->latitude,$request->longitude);
        
        $cader = Cader::where('user_id',Auth::id())->first();

        if($request->type != 'stream'){ 

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
        }else{

            // check existance of cader .....
            //  before  => in  out in out 
            //  now     => out in  in out 
            //  result  => 1   1   0  0
            // -------------------------------

            //              before(in)             now(out)                       before(out)              now(in)
            $insert = (!$cader->out_of_zone && $distance > $event->area) || ($cader->out_of_zone && $distance < $event->area);

            $alert = !$cader->out_of_zone && $distance > $event->area;
            if($insert){
                
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

                if($alert){ 
                    $this->send_notification('خارج نطاق الفعالية' , 'برجاء الرجوع لمنطفة الفعالية' , '' , '' , 'warning' , $cader->user_id, false);
                }
            }
        }

        $cader->latitude = $request->latitude;
        $cader->longitude = $request->longitude;
        $cader->out_of_zone = $distance > $event->area ? 1 : 0; 
        $cader->save();
        
        $first_name = $cader->user->first_name ?? '';
        $last_name = $cader->user->last_name ?? '';
        
        $data = [
            'user_id' => Auth::id(), 
            'name' => $first_name . ' ' . $last_name,
            'event_id' => $request->event_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'alert_out_of_zone' => $alert ? 1 : 0,
            'refresh' => $insert ? 1 : 0, 
        ];
        event(new ChangeLocation($data));

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
