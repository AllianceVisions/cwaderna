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
        $events = Event::orderBy('created_at','desc')->paginate(10);
        $new = EventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    }

    public function join(Request $request){ 
        $event = Event::find($request->event_id);
        if(!$event){
            return $this->returnError('404',('Not Found !!!'));
        }else{
            $cader = Cader::where('user_id',Auth::id())->first();
            
            $event->caders()->syncWithoutDetaching([
                $cader->id => [ 
                    'specialization_id' => $request->specialization_id,
                    'status' => 'pending',
                    'request_type' => 'by_cader',
                ],
            ]);
            return $this->returnSuccessMessage(__('Request Sent Succeessfully')); 
        }
    }
    
}
