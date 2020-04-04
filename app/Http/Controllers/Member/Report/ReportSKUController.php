<?php

namespace App\Http\Controllers\Member\Report;

use App\Http\Controllers\Member\MemberCoreController;
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

        return $view = view(config('theme.member.view').'reports.sku.crawleritem',compact([]));
    }
}
