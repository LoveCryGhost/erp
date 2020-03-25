<?php

namespace App\Services\Member;

use App\Handlers\ImageUploadHandler;
use App\Repositories\Member\CrawlerItemRepository;
use App\Repositories\Member\CrawlerItemSKURepository;
use App\Repositories\Member\SupplierContactRepository;
use App\Repositories\Member\SupplierRepository;
use Illuminate\Support\Facades\Auth;

class CrawlerItemSKUService extends MemberCoreService implements MemberServiceInterface
{

    public $crawlerItemSKURepo;
    public $crawlerItemRepo;

    public function __construct(CrawlerItemSKURepository $crawlerItemSKURepository, CrawlerItemRepository $crawlerItemRepository)
    {
        $this->crawlerItemSKURepo = $crawlerItemSKURepository;
        $this->crawlerItemRepo = $crawlerItemRepository;
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

    public function save_name_card($data)
    {

    }

    public function destroy($model, $data)
    {

    }


}
