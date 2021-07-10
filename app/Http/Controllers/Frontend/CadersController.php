<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Cader;
use App\Models\User;
use App\Models\City;
use App\Models\Specialization;
use Auth;

class CadersController extends Controller
{
    public function cader_register()
    {
        $cities = City::get()
            ->pluck('name_' . app()->getLocale(), 'id')
            ->prepend(trans('global.pleaseSelect'), '');
        $specializations = Specialization::all();
        return view(
            'auth.cader_register',
            compact('cities', 'specializations')
        );
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
            'nationality' => 'required',
            'national_id' => 'required',
            'description' => 'required',
            'specializations' => 'required|array',
            'specializations.*' => 'integer',
            'date_of_birth' =>
                'required|date_format:' . config('panel.date_format'),
        ]);

        $validated_requests = $request->all();
        $validated_requests['password'] = bcrypt($request->password);
        $validated_requests['user_type'] = 'cader';
        $validated_requests['approved'] = 0;
        $user = User::create($validated_requests);
        $cader = Cader::create([
            'user_id' => $user->id,
            'description' => $validated_requests['description'],
        ]);

        $cader->specializations()->sync($request->input('specializations', []));

        flash('تم ارسال طلب الأنضمام بنجاح');
        return back();
    }

    public function cader_single($id)
    {
        $cader = Cader::findOrFail($id);
        $cader->load([
            'user.previous_experience',
            'user.academic_degree',
            'specializations',
            'skills',
            'events',
        ]);
        return view('frontend.caders.cader_single', compact('cader'));
    }

    public function cwaders()
    {
        $events = Event::where(
            'event_organizer_id',
            Auth::user()->events_organizer->id ?? 0
        )
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        $specializations = Specialization::all();
        $caders = Cader::with(['specializations', 'user'])
            ->withCount('events')
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        return view(
            'frontend.caders.cwaders',
            compact('events', 'caders', 'specializations')
        );
    }

    public function add_cader_to_event(Request $request)
    {
        $event = Event::findOrFail($request->event_id);
        $collection = collect($event->specializations);
        if (!$collection->contains('id', $request->specialization_id)) {
            flash('لا تتضمن الفعالية هدا التخصص اختر تخصص اخر للكادر')->error();
            return back();
        } else {
            $start = $request->start_attendance
                ? date('Y-m-d H:i:s', strtotime($request->start_attendance))
                : null;
            $end = $request->end_attendance
                ? date('Y-m-d H:i:s', strtotime($request->end_attendance))
                : null;

            $event->caders()->syncWithoutDetaching([
                $request->cader_id => [
                    'start_attendance' => $start,
                    'end_attendance' => $end,
                    'specialization_id' => $request->specialization_id,
                    'status' => 'pending',
                    'request_type' => 'by_event_organizer',
                ],
            ]);

            flash('تم اضاقة الكادر للفعالية')->success();
            return back();
        }
    }
}
