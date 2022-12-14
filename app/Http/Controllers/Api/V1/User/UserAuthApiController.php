<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\User;
use App\Models\Cader;
use Validator;
use Auth;
use App\Http\Controllers\Traits\MediaUploadingTrait; 


class UserAuthApiController extends Controller
{ 
    use api_return;
    use MediaUploadingTrait;

    public function register(Request $request){

        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:20',
            'city_id' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'nationality_id' => 'required',
            'identity_num' => 'required',
            'description' => 'required',
            'specializations' => 'required|array',
            'specializations.*' => 'integer',
            'date_of_birth' =>
            'required|date_format:' . config('panel.date_format'),
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  

        $validated_requests = $request->all();
        $validated_requests['password'] = bcrypt($request->password);
        $validated_requests['user_type'] = 'cader';
        $validated_requests['approved'] = 0;
        $user = User::create($validated_requests);
        if (request()->hasFile('photo') && request('photo') != ''){

            $validator = Validator::make($request->all(), [
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            } 

            $user->addMedia(request('photo'))->toMediaCollection('photo'); 
        }
        
        if (request()->has('certificates')){
            $validator = Validator::make($request->all(), [
                'certificates' => 'required|array',
                'certificates.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            } 
            foreach ($request->input('certificates', []) as $file) {
                $user->addMedia($file)->toMediaCollection('certificates');
            } 
        }
        if (request()->hasFile('cv') && request('cv') != ''){  
            $validator = Validator::make($request->all(), [
                'cv' => 'required|max:2048',
            ]);

            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            } 

            $user->addMedia(request('cv'))->toMediaCollection('cv'); 
        }
        
        $cader = Cader::create([
            'user_id' => $user->id,
            'description' => $validated_requests['description'],
        ]);

        $cader->specializations()->sync($request->input('specializations', []));  

        return $this->returnSuccessMessage('???? ?????????? ?????? ?????????????? ??????????');

    }

    // -----------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------

    public function login(Request $request){

        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if(Auth::user()->user_type == 'cader' || Auth::user()->approved == 1){
                $token = Auth::user()->createToken('user_token')->plainTextToken; 
                $cader = Cader::where('user_id',Auth::id())->first();
                return $this->returnData(
                    [
                        'user_token' => $token,
                        'user_id '=> Auth::id(),
                        'cader_id' => $cader->id,
                    ]
                );
            }else{
                return $this->returnError('500',__('Not Authenticated to use this app'));
            }
        } else {
            return $this->returnError('500',__('invalid username or password'));
        }
    }
}
