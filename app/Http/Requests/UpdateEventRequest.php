<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_edit') || auth()->user()->user_type == 'events_organizer';
    }

    public function rules()
    {
        return [
            'event_organizer_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'required',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'string',
                'required',
            ],
            'city_id'  => [
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            'conditions' => [
                'string',
                'required',
            ],
            'start_attendance' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'end_attendance' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'specializations.*' => [
                'integer',
            ],
            'specializations'   => [
                'required',
                'array',
            ],
        ];
    }
}
