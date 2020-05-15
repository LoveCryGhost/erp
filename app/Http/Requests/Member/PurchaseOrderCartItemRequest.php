<?php

namespace App\Http\Requests\Member;

use App\Http\Requests\Request;

class PurchaseOrderCartItemRequest extends Request
{
    public function rules()
    {

        return [
                'sku_id' => ['required'],
                'amount' => ['required', 'integer', 'min:1']
            ];
    }

    public function messages()
    {
        return [

            'sku_id.required' => 'sku_id',
            'amount.required' => 'amount',
            'amount.integer' => 'amount',
            'amount.min' => 'amount',
        ];
    }

}
