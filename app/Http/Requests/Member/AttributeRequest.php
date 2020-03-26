<?php

namespace App\Http\Requests\Member;



use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class AttributeRequest extends Request
{
    public function rules()
    {
        $attribute=$this->attribute;

        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'a_name' => ['required', 'min:2', Rule::unique('attributes')],

                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'a_name' => ['required', 'min:2', Rule::unique('attributes')->ignore($attribute->a_id,'a_id')],
                    ];
                }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                }
        }
    }

    public function messages()
    {
        return [

            'a_name.min' => '產品屬性名稱不能少於2個字元',
            'a_name.required' => '產品屬性不能為空',
            'a_name.unique' => '產品屬性不能重複',
        ];
    }
}
