<?php

namespace App\Http\Requests\Member;



use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TypeRequest extends Request
{
    public function rules()
    {
        $type=$this->type;

        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        't_name' => ['required', 'min:2', Rule::unique('types')],

                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        't_name' => ['required', 'min:2', Rule::unique('types')->ignore($type->t_id,'t_id')],
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

            't_name.min' => '產品類型名稱不能少於2個字元',
            't_name.required' => '產品類型不能為空',
            't_name.unique' => '產品類型不能重複',
        ];
    }
}
