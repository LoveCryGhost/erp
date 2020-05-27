<?php

namespace App\Http\Controllers\Member\Report;

use App\Http\Controllers\Member\MemberCoreController;
use App\Services\Member\Reports\MemberReportSkuAnalysisService;
use App\Models\Product;
use App\Models\SKU;
use Illuminate\Support\Facades\Auth;
use function compact;
use function config;
use function request;
use function view;

class _ReportSKUController extends MemberCoreController
{

    public $filters=[];
    public function __construct(MemberReportSkuAnalysisService $memberReportSkuAnalysisService)
    {
        $actions = [
            'crawlerItemAanalysis'];
        $this->coreMiddleware('ReportSKUController',$guard='member', $route="reportSKU", $actions);
        $this->MemberReportSkuAnalysisService = $memberReportSkuAnalysisService;
    }


    //Product SKU 綁定 爬蟲產品分析
    public function crawlerItemAanalysis()
    {
        $query = $this->MemberReportSkuAnalysisService->skuAnalysis();

        $this->filters = [
            'sku_translations_price_min' => request()->sku_translations_price_min,
            'sku_translations_price_max' => request()->sku_translations_price_max,
            'profit' => request()->profit,
            'totalSeller' => request()->seller,
            'monthlyProfit' => request()->monthlyProfit,
        ];
        $query = $this->index_filters($query, $this->filters);
        dd($query->get());
        $skus = $query->paginate(10);

        return $view = view(config('theme.member.view').'reports.sku.crawleritem',[
            'skus' => $skus,
            'filters' => $this->filters]);
    }

    public function index_filters($query, $filters)
    {
        $query = $this->filter_priceBetween($query, 'sku_translations.price', $arr_min_max=[$filters['sku_translations_price_min'],$filters['sku_translations_price_max']]);
//        $query = $query->where('profit', '>', $filters['profit']);
//        $query = $query->where('total_seller', '>', $filters['totalSeller']);
//        $query = $this->where('monthlyProfit', '>', $filters['monthlyProfit']);
        return $query;
    }
}
