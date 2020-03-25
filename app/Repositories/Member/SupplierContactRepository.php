<?php

namespace App\Repositories\Member;


use App\Models\Supplier;
use App\Models\SupplierContact;

class SupplierContactRepository extends MemberCoreRepository implements RepositoryInterface
{

    private $supplierContact;

    public function __construct(SupplierContact $supplierContact)
    {
        $this->supplierContact = new SupplierContact();
    }

    public function builder()
    {
        return $this->supplierContact ;
    }


    public function getById($id)
    {
        return $this->supplierContact->find($id);
    }

    public function update($supplierContact, $data){
        return $supplierContact->update($data);
    }

    public function destroy($supplierContact, $data){
        return $supplierContact->delete();
    }


}
