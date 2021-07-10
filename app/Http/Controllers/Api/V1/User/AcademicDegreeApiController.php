<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\AcademicDegree;
use Validator;
use Auth;

class AcademicDegreeApiController extends Controller
{
    use api_return;

    public function store(Request $request){
        
        $rules = [
            'university_name' => 'required|string',
            'degree' => 'required|string',
            'start_date' => 'required|date_format:' . config('panel.date_format'),
            'end_date' => 'required|date_format:' . config('panel.date_format'),
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $validated_request = $request->all();
        $validated_request['user_id'] = Auth::id();
        $acadmeic_degree = AcademicDegree::create($validated_request); 

        return $this->returnSuccessMessage(__('Inserted Succeessfully'));
    }

    
    public function update(Request $request){
        
        $rules = [
            'academic_degree_id' => 'required|integer',
            'university_name' => 'required|string',
            'degree' => 'required|string',
            'start_date' => 'required|date_format:' . config('panel.date_format'),
            'end_date' => 'required|date_format:' . config('panel.date_format'),
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $acadmeic_degree = AcademicDegree::find($request->academic_degree_id);
        
        if(!$acadmeic_degree){
            return $this->returnError('404',('Not Found !!!'));
        }else{
            $acadmeic_degree->update($request->all());
            return $this->returnSuccessMessage(__('Updated Succeessfully')); 
        }

    }

    public function delete($id){
        $acadmeic_degree = AcademicDegree::find($id);

        if(!$acadmeic_degree){
            return $this->returnError('404',('Not Found !!!'));
        }else{
            $acadmeic_degree->delete();
            return $this->returnSuccessMessage(__('Deleted Succeessfully')); 
        }
    }
}
