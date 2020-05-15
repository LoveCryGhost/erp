<?php

namespace App\Repositories\Member;


use App\Models\CrawlerCategory;
use App\Models\CrawlerTask;

class CrawlerCategoryRepository extends MemberCoreRepository implements RepositoryInterface
{

    public $crawlerCategory;

    public function __construct(CrawlerCategory $crawlerCategory)
    {
        $this->crawlerCategory = new CrawlerCategory();
    }

    public function builder()
    {
        return $this->crawlerCategory ;
    }


    public function getById($id)
    {
        return $this->crawlerCategory->find($id);
    }
}
