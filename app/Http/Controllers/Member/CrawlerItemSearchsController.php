<?php

namespace App\Http\Controllers\Member;

use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CrawlerItemSearchsController extends MemberCoreController
{
    public function __construct()
    {
//        $actions = [
//            '*',
//            'index',
//            'show', 'edit','update',
//            'create', 'store',
//            'destroy',
//            'show'];
//        $this->coreMiddleware('CrawlerTasksController',$guard='member', $route="crawlerTask", $actions);
    }

    public function index()
    {
        $query = CrawlerItem::with(['crawlerTask'])->where('member_id', 1);
        $crawlerItem_total = $query->count();
        $crawlerItems = $query->paginate(50);

        return view(config('theme.member.view').'crawlerItemSearch.index',
            [
                'crawlerItems' => $crawlerItems,
                'crawlerItem_total' => $crawlerItem_total,
                'filters' => [
                ]
            ]);
    }
}
