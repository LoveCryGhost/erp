<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\SupplierGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplierGroupPolicy
{
    use HandlesAuthorization;

    /*
     * 两个参数，
     * 第一个参数默认为当前登录用户实例，
     * 第二个参数则为要进行授权的用户实例
     * */
    public function update(Member $currentMember, SupplierGroup $supplierGroup)
    {
        return $currentMember->isAuthorOf($supplierGroup);
    }

    public function destroy(Member $currentMember, SupplierGroup $supplierGroup)
    {
        return $currentMember->isAuthorOf($supplierGroup);
    }
}
