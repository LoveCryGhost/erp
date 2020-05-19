<?php

namespace App\Http\Requests\Member;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use function __;

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

            'price.required' => __('member/validations.product.sku.price.required'),
            'price.numeric' =>  __('member/validations.product.sku.price.numeric'), //'售價必須為數字',
            'sku_name.required' =>  __('member/validations.product.sku.sku_name.required'), //'SKU 名稱不能為空'
        ];
    }
}
