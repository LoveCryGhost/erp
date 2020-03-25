<?php

namespace App\Http\Requests\Member;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class Product_SKU_SupplierRequest extends Request
{
    public function rules()
    {
        $skuSupplier=$this->product_sku_supplier;
        switch($this->method())
        {
            // CREATE
            case 'POST':
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'price' => ['required','numeric'],
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
        ];
    }
}
