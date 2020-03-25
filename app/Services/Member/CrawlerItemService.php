<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Repositories\Member\CrawlerItemRepository;
use App\Repositories\Member\CrawlerItemSKURepository;
use App\Repositories\Member\CrawlerTaskRepository;
use App\Repositories\Member\SupplierContactRepository;
use App\Repositories\Member\SupplierRepository;
use Illuminate\Support\Facades\Auth;

class CrawlerItemService extends MemberCoreService implements MemberServiceInterface
{
    public $crawlerItemRepo;
    public $crawlerTaskRepo;

    public function __construct(CrawlerItemRepository $crawlerItemRepository,
                                CrawlerTaskRepository $crawlerTaskRepository)
    {
        $this->crawlerItemRepo = $crawlerItemRepository;
        $this->crawlerTaskRepo = $crawlerTaskRepository;
    }

    public function index()
    {
    }

    public function create()
    {
    }



    public function edit()
    {

    }

    public function store($data)
    {

    }

    public function update($model, $data)
    {

    }



    public function destroy($model, $data)
    {

    }


}
