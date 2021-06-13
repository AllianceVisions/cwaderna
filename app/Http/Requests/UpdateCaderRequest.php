<?php

namespace App\Http\Requests;

use App\Models\Cader;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCaderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cader_edit');
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
            'nationality'  => [
                'required',
            ],
            'national_id'  => [
                'required',
            ],
            'description' => [
                'required',
            ], 
        ];
    }
}
