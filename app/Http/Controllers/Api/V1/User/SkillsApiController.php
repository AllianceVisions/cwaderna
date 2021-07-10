<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\Cader; 
use App\Models\Skill; 
use Validator;
use Auth;
use App\Http\Resources\V1\User\SkillsResource;

class SkillsApiController extends Controller
{
    use api_return;

    public function index(){
        $skills = Skill::all();
        return $this->returnData(SkillsResource::collection($skills));
    }

    public function store(Request $request){
        
        $rules = [
            'skill_id' => 'required|integer',
            'progress' => 'required|integer', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $cader = Cader::where('user_id',Auth::id())->first();
        $cader->skills()->syncWithoutDetaching([$request->skill_id => ['progress' => $request->progress]]); 

        return $this->returnSuccessMessage(__('Changed Succeessfully'));
    } 

    public function delete($id){
        $cader = Cader::where('user_id',Auth::id())->first();
        $cader->skills()->wherePivot('skill_id','=',$id)->detach();
        return $this->returnSuccessMessage(__('Deleted Succeessfully')); 
    }
}
