<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\Request;
use App\Services\Member\CrawlerItemSKUService;

class CrawlerItemSKUsController extends MemberCoreController
{
    private $crawlerItemSKUService;
    public function __construct(CrawlerItemSKUService $crawlerItemSKUService)
    {
        $this->middleware('auth:member');
        $this->crawlerItemSKUService = $crawlerItemSKUService;
    }

    public function index()
    {
        $data = request()->all();
        $crawlerItem = $this->crawlerItemSKUService->crawlerItemRepo->getById($data['ci_id']);

        foreach($crawlerItem->crawlerItemSKUs as $crawlerItemSKU){
            $amCharProvider[] = [
                "year" => $crawlerItemSKU->name,
                'sold' => $crawlerItemSKU->sold
            ];
        }

        $view = view(config('theme.member.view').'crawlerItemSKU.index',compact('data', 'crawlerItem', 'amCharProvider'))->render();
        return [
            'errors' => '',
            'models'=> [
                'crawlerItem' => $crawlerItem,
            ],
            'request' => request()->all(),
            'view' => $view,
            'options'=>[]
        ];
    }
}
