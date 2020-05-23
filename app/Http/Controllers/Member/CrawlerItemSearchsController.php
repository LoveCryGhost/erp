<?php

namespace App\Http\Controllers\Member;

use App\Models\CrawlerItem;
use App\Models\CrawlerTask;
use App\Services\Member\CrawlerItemService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function dd;
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

        $query = CrawlerItem::with(['crawlerShop','crawlerItemSKUs']);

        $this->filters = [
            'name' => request()->name,
            'price_min' => request()->price_min,
            'price_max' => request()->price_max,
            'sold_min' => request()->sold_min, //月銷量
            'sold_max' => request()->sold_max, //月銷量
            'historical_sold_min' => request()->historical_sold_min, //歷史銷量
            'historical_sold_max' => request()->historical_sold_max, //歷史銷量
            'locale' => request()->locale

        ];
        $query = $this->index_filters($query, $this->filters);

        $crawlerItems = $query->paginate(10);

        $crawlerItem_total_records = $query->count();
        $crawlerItem_total_updated = $query->whereDate('updated_at','=',Carbon::today())->whereNotNull('updated_at')->count();


        //$crawlerItem_total_updated/$crawlerItem_total_records
        return view(config('theme.member.view').'crawlerItemSearch.index',
            [
                'crawlerItems' => $crawlerItems,
                'crawlerItem_total_records' => $crawlerItem_total_records,
                'crawlerItem_total_updated' => $crawlerItem_total_updated,
                'filters' => [
                    'name' => request()->name,
                    'price_min' => request()->price_min,
                    'price_max' => request()->price_max,
                    'sold' => request()->sold, //月銷量
                    'historical_sold' => request()->historical_sold, //歷史銷量
                    'locale' => request()->locale
                ]
            ]);
    }

    public function index_filters($query, $filters)
    {
        $query = $this->filter_like($query,'name', $filters['name']);
        $query = $this->filter_checkbox($query, 'locale', $filters['locale']);

        if($filters['sold_min']>=0 and $filters['sold_max']>0 and $filters['sold_min'] < $filters['sold_max']){
            if($filters['sold_min']==null){
                $filters['sold_min']=0;
            }
            $query = $query->whereBetween('crawler_items.sold' ,  [ $filters['sold_min'],$filters['sold_max']]);
        }
        if($filters['historical_sold_min']>=0 and $filters['historical_sold_max']>0 and $filters['historical_sold_min'] < $filters['historical_sold_max']){
            if($filters['historical_sold_min']==null){
                $filters['historical_sold_min']=0;
            }
            $query = $query->where('historical_sold', [ $filters['historical_sold_min'],  $filters['historical_sold_max']]);
        }
        return $query;
    }
}
