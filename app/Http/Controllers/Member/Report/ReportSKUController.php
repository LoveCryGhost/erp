<?php

namespace App\Http\Controllers\Member\Report;

use App\Http\Controllers\Member\MemberCoreController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use function compact;
use function config;
use function view;

class ReportSKUController extends MemberCoreController
{

    public function __construct()
    {
        $this->middleware('auth:member');
    }

    public function crawleritem_analysis()
    {

        $products = Product::with(['all_skus','all_skus.crawlerTaskItemSKU'])
            ->where('member_id', Auth::guard('member')->user()->id)->get();
        return $view = view(config('theme.member.view').'reports.sku.crawleritem',compact(['products']));
    }
}
