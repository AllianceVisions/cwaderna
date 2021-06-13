<?php

namespace App\Http\Requests;

use App\Models\City;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('city_create');
    }

    public function rules()
    {
        return [
            'name_en' => [
                'string',
                'max:255',
                'required',
            ],
            'name_ar' => [
                'string',
                'max:255',
                'required',
            ],
        ];
    }
}