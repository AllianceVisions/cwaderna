<?php

namespace App\Http\Requests;

use App\Models\BreakType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBreakTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('break_type_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'time' => [
                'required', 
            ],
        ];
    }
}
