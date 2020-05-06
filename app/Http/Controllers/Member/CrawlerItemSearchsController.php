<?php

namespace App\Http\Controllers\Member;

use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerItemService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function request;

class CrawlerItemSearchsController extends MemberCoreController
{
    public $filters;
    public function __construct()
    {
        $actions = [
            '*',
            'index',
            'show', 'edit','update',
            'create', 'store',
            'destroy',
            'show'];
        $this->coreMiddleware('CrawlerItemSearchsController',$guard='member', $route="crawlerItemSearch", $actions);
    }

    public function index()
    {
        $query = CrawlerItem::with(['crawlerShop','crawlerItemSKUs'])
            ->where('member_id', 1);

        $this->filters = [
            'name' => request()->name,
            'price_min' => request()->price_min,
            'price_max' => request()->price_max,
            'sold' => request()->sold, //月銷量
            'historical_sold' => request()->historical_sold, //歷史銷量
        ];
        $query = $this->index_filters($query, $this->filters);

        $crawlerItems =$query->paginate(20);
        $crawlerItem_total = $query->count();
        $crawlerItem_total_waiting_update = $query->whereDate('updated_at','<>',Carbon::today())->orWhereNull('updated_at')->count();

        return view(config('theme.member.view').'crawlerItemSearch.index',
            [
                'crawlerItems' => $crawlerItems,
                'crawlerItem_total' => $crawlerItem_total,
                'crawlerItem_total_waiting_update' => $crawlerItem_total_waiting_update,
                'filters' => [
                    'name' => request()->name,
                ]
            ]);
    }

    public function index_filters($query, $filters)
    {
        $query = $this->filter_like($query,'name', $filters['name']);

        if($filters['sold']>0){
            $query = $query->where('crawler_items.sold' , '>=',  $filters['sold']);
        }
        if($filters['historical_sold']>0){
            $query = $query->where('historical_sold' , '>=',  $filters['historical_sold']);
        }
        return $query;
    }
}
