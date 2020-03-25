<?php

namespace App\Repositories\Member;


use App\Models\CrawlerTask;

class CrawlerTaskRepository extends MemberCoreRepository implements RepositoryInterface
{

    public $crawlerTask;

    public function __construct(CrawlerTask $crawlerTask)
    {
        $this->crawlerTask = new CrawlerTask();
    }

    public function builder()
    {
        return $this->crawlerTask ;
    }


    public function getById($id)
    {
        return $this->crawlerTask->find($id);
    }
}
