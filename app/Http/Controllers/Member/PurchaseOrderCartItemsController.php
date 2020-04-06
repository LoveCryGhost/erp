<?php

namespace App\Http\Controllers\Member;

use App\Models\PurchaseOrderCartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PurchaseOrderCartItemsController extends MemberCoreController
{

    public function __construct()
    {
        $this->middleware('auth:member');
    }

    public function purchaseOrderCartItem_add(Request $request)
    {
        $data = $request->all();
        $member   = Auth::guard('member')->user();;
        $skuId  = $request->input('sku_id');
        $amount = $request->input('amount')>0? $request->input('amount'): 1;

        // 从数据库中查询该商品是否已经在购物车中
        if ($cart = $member->purchaseOrderCartItems()->where('sku_id', $skuId)->first()) {

            // 如果存在则直接叠加商品数量
            $cart->update([
                'amount' => $cart->amount + $amount,
            ]);
        } else {
            // 否则创建一个新的购物车记录
            $purchaseOrderCart = new PurchaseOrderCartItem(['amount' => $amount]);
            $purchaseOrderCart->member()->associate($member);
            $purchaseOrderCart->sku()->associate($skuId);
            $purchaseOrderCart->save();
        }

        return [
            'errors' => '',
            'models'=> [
            ],
            'request' => request()->all(),
            'view' => "",
            'options'=>[]
        ];
    }
}
