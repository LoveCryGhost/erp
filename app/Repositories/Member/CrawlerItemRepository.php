<?php

namespace App\Repositories\Member;


use App\Models\CrawlerItem;

class CrawlerItemRepository extends MemberCoreRepository implements RepositoryInterface
{

    public $crawlerItem;

    public function __construct(CrawlerItem $crawlerItem)
    {
        $this->crawlerItem = new CrawlerItem();
    }

    public function builder()
    {
        return $this->crawlerItem ;
    }

    public function getById($id)
    {
        return $this->crawlerItem->find($id);
    }
}
