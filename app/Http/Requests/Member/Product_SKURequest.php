<?php

namespace App\Http\Requests\Member;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class Product_SKURequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'price' => ['required','numeric'],
                        'sku_name' => ['required'],
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

            'price.required' => '售價不能為空',
            'price.numeric' => '售價必須為數字',
            'sku_name.required' => 'SKU 名稱不能為空'
        ];
    }
}
