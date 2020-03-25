<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\Member;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /*
     * 两个参数，
     * 第一个参数默认为当前登录用户实例，
     * 第二个参数则为要进行授权的用户实例
     * */
    public function update(Member $member, Product $product)
    {
        return $member->isAuthorOf($product);
    }

    public function destroy(Member $member, Product $product)
    {
        return $member->isAuthorOf($product);
    }


}
