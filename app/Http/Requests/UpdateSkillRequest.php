<?php

namespace App\Http\Requests;


use App\Models\Skill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSkillRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('skill_edit');
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
