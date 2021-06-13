<?php

namespace App\Http\Requests;

use App\Models\ProviderMan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProviderManRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('provider_man_create');
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
        ];
    }
}
