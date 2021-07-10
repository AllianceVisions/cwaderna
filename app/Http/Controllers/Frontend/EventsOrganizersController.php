<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventOrganizer;
use App\Models\City;
use App\Models\User;
use App\Models\Nationality;
use App\Http\Controllers\Traits\MediaUploadingTrait; 
use Spatie\MediaLibrary\Models\Media;

class EventsOrganizersController extends Controller
{
    use MediaUploadingTrait;

    public function organizers(){
        $eventorganizers = EventOrganizer::with('user')->withCount('events')->orderBy('created_at','desc')->paginate(9);
        return view('frontend.events_organizers.organizers',compact('eventorganizers'));
    }

    public function organizers_register(){
        $cities = City::get()->pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), ''); 
        $nationalites = Nationality::get()->pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), ''); 
        return view('frontend.events_organizers.organizers_register',compact('cities','nationalites'));
    }

    public function register_submit(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required',
            'city_id' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'nationality_id' => 'required',
            'identity_num' => 'required', 
            'identity' => 'required',
        ]);
        $validated_requests = $request->all();
        $validated_requests['password'] = bcrypt($request->password);
        $validated_requests['user_type'] = 'events_organizer';
        $validated_requests['approved'] = 0;
        $user = User::create($validated_requests);
        $event_organizer = EventOrganizer::create([
            'user_id' => $user->id,
            'company_name' => $validated_requests['company_name'],
        ]); 

        if ($request->input('identity', false)) {
            $event_organizer->addMedia(storage_path('tmp/uploads/' . basename($request->input('identity'))))->toMediaCollection('identity');
        }
        if ($request->input('commerical_reg', false)) {
            $event_organizer->addMedia(storage_path('tmp/uploads/' . basename($request->input('commerical_reg'))))->toMediaCollection('commerical_reg');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }
        
        flash('تم ارسال طلب الأنضمام بنجاح');
        return back();
    }

}
