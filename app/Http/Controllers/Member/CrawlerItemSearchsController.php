<?php

namespace App\Http\Controllers\Member;

use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function request;

class CrawlerItemSearchsController extends MemberCoreController
{
    public $filters;
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
        $this->filters = [
            'name' => request()->name,
            'price_min' => request()->price_min,
            'price_max' => request()->price_max,
        ];

        $filters = $this->filters;
        $query = CrawlerItem::with(['crawlerShop', 'crawlerItemSKUs'])
                    ->where('member_id', 1);

        $query = $this->index_filters($query, $this->filters);

        $crawlerItem_total = $query->count();
        $crawlerItems = $query->paginate(20);

        return view(config('theme.member.view').'crawlerItemSearch.index',
            [
                'crawlerItems' => $crawlerItems,
                'crawlerItem_total' => $crawlerItem_total,
                'filters' => [
                    'name' => request()->name,
                ]
            ]);
    }

    public function index_filters($query, $filters)
    {
        $query = $this->filter_like($query,'crawler_items.name', $filters['name']);
//        $query = $this->filter_relation_between($query, $relations='crawlerItemSKUs', 'price', array($filters['price_min'],$filters['price_max']));
        return $query;
    }
}
