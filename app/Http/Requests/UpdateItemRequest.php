<?php

namespace App\Http\Requests;

use App\Models\Item;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('item_edit') || auth()->user()->user_type == 'provider_man';
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer',
            ],
            'provider_man_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            'price' => [
                'required',
            ],
        ];
    }
}