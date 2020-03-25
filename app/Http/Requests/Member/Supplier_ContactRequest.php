<?php

namespace App\Http\Requests\Member;



use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class Supplier_ContactRequest extends Request
{
    public function rules()
    {
        $supplierContact=$this->supplier_contact;
        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'sc_name' => ['required', 'min:2', Rule::unique('supplier_contacts')],

                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'sc_name' => ['required', 'min:2', Rule::unique('supplier_contacts')->ignore($supplierContact->sc_id,'sc_id')],
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

            'sc_name.min' => '聯絡人名稱不能少於2個字元',
            'sc_name.required' => '聯絡人名稱不能為空',
            'sc_name.unique' => '聯絡人名稱不能重複',
        ];
    }
}
