<?php

namespace App\Http\Requests\Member;



use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class SupplierRequest extends Request
{
    public function rules()
    {
        $supplier=$this->supplier;

        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        's_name' => ['required', 'min:2', Rule::unique('suppliers')],
                        'sg_id' => ['required'],

                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        's_name' => ['required', 'min:2', Rule::unique('suppliers')->ignore($supplier->s_id,'s_id')],
                        'sg_id' => ['required'],
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

            's_name.min' => '供應商名稱不能少於2個字元',
            's_name.required' => '供應商名稱不能為空',
            's_name.unique' => '供應商名稱不能重複',
            'sg_id.required' => '供應商群組不能為空',
        ];
    }
}
