<?php

namespace App\Http\Requests;

use App\Models\Cader;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCaderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cader_create');
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
            'email'    => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
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
            'nationality'  => [
                'required',
            ],
            'national_id'  => [
                'required',
            ],
            'description' => [
                'required',
            ], 
            'photo' => [
                'required',
            ],
            'specializations.*' => [
                'integer',
            ],
            'specializations'   => [
                'required',
                'array',
            ],
            'skills.*' => [
                'integer',
            ],
            'skills'   => [
                'required',
                'array',
            ],

            // 'company_name' => [
            //     'string',
            // ],
            
            // 'job_type' => [
            //     'string',
            // ],

            // 'start_date' => [
            //     'date_format:' . config('panel.date_format'),
            // ],

            // 'end_date' => [
            //     'date_format:' . config('panel.date_format'),
            // ],
        ];
    }
}
