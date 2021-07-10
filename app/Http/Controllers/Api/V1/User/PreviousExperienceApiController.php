<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\PreviousExperience;
use Validator;
use Auth;

class PreviousExperienceApiController extends Controller
{
    use api_return;

    public function store(Request $request){
        
        $rules = [
            'company_name' => 'required|string',
            'job_type' => 'required|string',
            'start_date' => 'required|date_format:' . config('panel.date_format'),
            'end_date' => 'required|date_format:' . config('panel.date_format'),
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $validated_request = $request->all();
        $validated_request['user_id'] = Auth::id();
        $previous_experience = PreviousExperience::create($validated_request);  

        return $this->returnSuccessMessage(__('Inserted Succeessfully'));
    }

    public function update(Request $request){
        
        $rules = [
            'previous_experience_id' => 'required|integer',
            'company_name' => 'required|string',
            'job_type' => 'required|string',
            'start_date' => 'required|date_format:' . config('panel.date_format'),
            'end_date' => 'required|date_format:' . config('panel.date_format'),
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $previous_experience = PreviousExperience::find($request->previous_experience_id);
        
        if(!$previous_experience){
            return $this->returnError('404',('Not Found !!!'));
        }else{
            $previous_experience->update($request->all());
            return $this->returnSuccessMessage(__('Updated Succeessfully')); 
        }

        return $this->returnSuccessMessage(__('Inserted Succeessfully'));
    }

    public function delete($id){
        $previous_experience = PreviousExperience::find($id);

        if(!$previous_experience){
            return $this->returnError('404',('Not Found !!!'));
        }else{
            $previous_experience->delete();
            return $this->returnSuccessMessage(__('Deleted Succeessfully')); 
        }
    }
}
