<?php

namespace App\Http\Requests;

use App\Models\Slider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSliderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'max:255',
                'required',
            ],
            'description' => [
                'string',
                'max:255',
                'required',
            ],
            'link' => [
                'string',
                'max:255',
                'required',
            ],
            'slider' => [
                'required',
            ],
        ];
    }
}