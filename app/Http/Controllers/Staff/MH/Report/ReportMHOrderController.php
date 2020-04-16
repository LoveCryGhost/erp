<?php

namespace App\Http\Controllers\Staff\MH\Report;


use App\Http\Controllers\Controller;
use App\Models\Shoes\ShoesOrder;
use function compact;
use function config;
use function request;
use function view;

class ReportMHOrderController extends Controller
{
    public function analysis(){
        $shoes_orders = ShoesOrder::orderBy('received_at', 'DESC')
            ->paginate(10);

        return view(config('theme.staff.view').'mh.reports.order.analysis',
            [
                'shoes_orders' => $shoes_orders,
                'filters' => [
                ]
            ]);
    }
}
