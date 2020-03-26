<?php

namespace App\Repositories\Member;


use App\Models\SupplierGroup;

class SupplierGroupRepository extends MemberCoreRepository implements RepositoryInterface
{

    private $supplierGroup;

    public function __construct(SupplierGroup $supplierGroup)
    {
        $this->supplierGroup = new SupplierGroup();
    }

    public function builder()
    {
        return $this->supplierGroup ;
    }


    public function getById($id)
    {
        return $this->supplierGroup->find($id);
    }
}
