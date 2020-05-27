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

                        'length_pcs' => ['numeric'],
                        'width_pcs' => ['numeric'],
                        'heigth_pcs' => ['numeric'],
                        'weight_pcs' => ['numeric'],
                        'pcs_per_box' => ['numeric'],
                        'length_box' => ['numeric'],
                        'width_box' => ['numeric'],
                        'heigth_box' => ['numeric'],
                        'weight_box' => ['numeric']
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

            'length_pcs.numeric' =>  __('member/validations.product.sku.length_pcs.numeric'), //'售價必須為數字',
            'width_pcs.numeric' =>  __('member/validations.product.sku.width_pcs.numeric'), //'售價必須為數字',
            'heigth_pcs.numeric' =>  __('member/validations.product.sku.heigth_pcs.numeric'), //'售價必須為數字',
            'weight_pcs.numeric' =>  __('member/validations.product.sku.weight_pcs.numeric'), //'售價必須為數字',
            'pcs_per_box.numeric' =>  __('member/validations.product.sku.pcs_per_box.numeric'), //'售價必須為數字',
            'length_box.numeric' =>  __('member/validations.product.sku.length_box.numeric'), //'售價必須為數字',
            'width_box.numeric' =>  __('member/validations.product.sku.width_box.numeric'), //'售價必須為數字',
            'heigth_box.numeric' =>  __('member/validations.product.sku.heigth_box.numeric'), //'售價必須為數字',
            'weight_box.numeric' =>  __('member/validations.product.sku.weight_box.numeric'), //'售價必須為數字',



        ];
    }
}
