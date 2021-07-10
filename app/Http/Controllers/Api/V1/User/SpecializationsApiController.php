<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\Cader; 
use App\Models\Specialization; 
use Validator;
use Auth;
use App\Http\Resources\V1\User\SpecializationResource;

class SpecializationsApiController extends Controller
{

    use api_return;

    public function index(){
        $specializations = Specialization::all();
        return $this->returnData(SpecializationResource::collection($specializations));
    }

    public function store(Request $request){
        
        $rules = [
            'specialization_id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $cader = Cader::where('user_id',Auth::id())->first();
        $cader->specializations()->syncWithoutDetaching([$request->specialization_id]); 

        return $this->returnSuccessMessage(__('Inserted Succeessfully'));
    } 

    public function delete($id){
        $cader = Cader::where('user_id',Auth::id())->first();
        $cader->specializations()->wherePivot('specialization_id','=',$id)->detach();
        return $this->returnSuccessMessage(__('Deleted Succeessfully')); 
    }
}
