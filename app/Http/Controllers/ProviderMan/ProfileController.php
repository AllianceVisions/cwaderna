<?php

namespace App\Http\Controllers\ProviderMan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\City;
use Auth;
use App\Models\User;
use App\Http\Controllers\Traits\MediaUploadingTrait;  
use Spatie\MediaLibrary\Models\Media;
use Alert;

class ProfileController extends Controller
{
    use MediaUploadingTrait;

    public function edit()
    { 
        $cities = City::get()->pluck('name_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), ''); 
        return view('provder_man.profile',compact('cities'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $user->update($request->all());

        if ($request->input('photo', false)) {
            if (!$user->photo || $request->input('photo') !== $user->photo->file_name) {
                if ($user->photo) {
                    $user->photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($user->photo) {
            $user->photo->delete();
        }

        return redirect()->route('provider-man.profile.edit')->with('message', __('global.update_profile_success'));
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[ 
            'password'=>'required|min:6|confirmed', 
            'old_password'=> 'required'
        ]);

        $user = Auth::user();  
        
        $hashedPassword = $user->password;
        if(!\Hash::check($request->old_password, $hashedPassword)){ 
            Alert::error('Old Password Not Correct');
            return redirect()->route('provider-man.profile.edit');
        }else{
            $user->password = bcrypt($request->password);
            $user->save();
            Alert::success('Success Changed Password');
            return redirect()->route('provider-man.profile.edit');
        }
    }
    
    public function storeCKEditorImages(Request $request)
    { 

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}