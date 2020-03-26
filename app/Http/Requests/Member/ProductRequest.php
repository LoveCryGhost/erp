<?php

namespace App\Http\Requests\Member;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends Request
{
    public function rules()
    {
        $product=$this->product;
        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'p_name' => ['required', 'min:2', Rule::unique('products')],
                        't_id' => ['required','integer']
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'p_name' => ['required', 'min:2', Rule::unique('products')->ignore($product->p_id,'p_id')],
                        't_id' => ['required']
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

            'p_name.min' => '產品名稱不能少於2個字元',
            'p_name.required' => '產品名稱不能為空',
            'p_name.unique' => '產品名稱不能重複',
            't_id.required' => '產品型態不能為空',
            't_id.integer' => '產品型態必須為數字格式',
        ];
    }
}
