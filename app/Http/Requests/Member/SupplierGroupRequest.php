<?php

namespace App\Http\Requests\Member;



use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class SupplierGroupRequest extends Request
{
    public function rules()
    {
        $supplierGroup=$this->supplierGroup;

        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'sg_name' => ['required', 'min:2', Rule::unique('supplier_groups')],

                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'sg_name' => ['required', 'min:2', Rule::unique('supplier_groups')->ignore($supplierGroup->sg_id,'sg_id')],
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

            'sg_name.min' => '供應商群組名稱不能少於2個字元',
            'sg_name.required' => '供應商群組名稱不能為空',
            'sg_name.unique' => '供應商群組名稱不能重複',
        ];
    }
}
