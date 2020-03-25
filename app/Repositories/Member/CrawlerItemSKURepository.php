<?php

namespace App\Repositories\Member;


use App\Models\CrawlerItemSKU;

class CrawlerItemSKURepository extends MemberCoreRepository implements RepositoryInterface
{

    public $crawlerItemSKU;

    public function __construct(CrawlerItemSKU $crawlerItemSKU)
    {
        $this->crawlerItemSKU = new CrawlerItemSKU();
    }

    public function builder()
    {
        return $this->crawlerItemSKU ;
    }


    public function getById($id)
    {
        return $this->crawlerItemSKU->find($id);
    }
}
