<?php

namespace App\Repositories\Member;


use App\Models\SKU;

class SKURepository extends MemberCoreRepository implements RepositoryInterface
{

    private $sku;

    public function __construct(SKU $sku)
    {
        $this->sku = new SKU();
    }

    public function builder()
    {
        return $this->sku ;
    }


    public function getById($id)
    {
        return $this->sku->find($id);
    }

    public function create($data){
        return $this->sku->create($data);
    }
}
