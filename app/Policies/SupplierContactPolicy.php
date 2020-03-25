<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\Supplier;
use App\Models\SupplierContact;
use App\Models\SupplierGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupplierContactPolicy
{
    use HandlesAuthorization;

    /*
     * 两个参数，
     * 第一个参数默认为当前登录用户实例，
     * 第二个参数则为要进行授权的用户实例
     * */
    public function update(Member $currentMember, SupplierContact $supplierContact)
    {
        return $currentMember->isAuthorOf($supplierContact);
    }

    public function destroy(Member $currentMember, SupplierContact $supplierContact)
    {
        return $currentMember->isAuthorOf($supplierContact);
    }
}
