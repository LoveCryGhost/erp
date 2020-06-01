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

class ReportSKUController extends MemberCoreController
{
    public function __construct()
    { $actions = [
        'crawlerItemAanalysis'];
        $this->coreMiddleware('ReportSKUController',$guard='member', $route="reportSKU", $actions);
    }


    //Product SKU 綁定 爬蟲產品分析
    public function crawlerItemAanalysis()
    {
        $skus = SKU::with([
            'product','crawlerTaskItemSKU', 'crawlerTaskItemSKU.crawlerItemSKUDetails',
            'skuSuppliers', 'skuSuppliers.supplierGroup'])
            ->where('member_id', Auth::guard('member')->user()->id)->paginate(5);

        $filters = [];
        return $view = view(config('theme.member.view').'reports.sku.crawleritem',compact(['skus','filters']));
    }

}
