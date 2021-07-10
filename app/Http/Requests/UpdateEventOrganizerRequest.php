<?php

namespace App\Http\Requests;

use App\Models\EventOrganizer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventOrganizerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_organizer_edit');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'email'   => [
                'required',
                'unique:users,email,' . request()->user_id,
            ],
            'city_id'  => [
                'required',
            ],
            'gender'  => [
                'required',
            ],
            'phone'  => [
                'required',
            ],
            'identity_num'  => [
                'required',
            ],
            'nationality_id'  => [
                'required',
            ],
            'company_name' => [
                'string',
                'required',
            ],
        ];
    }
}