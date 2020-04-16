<?php

namespace App\Http\Controllers\Staff\MH\Report;


use App\Http\Controllers\Controller;
use App\Models\Shoes\ShoesOrder;
use function array_values;
use function compact;
use function config;
use function explode;
use function implode;
use function request;
use function view;

class ReportMHOrderController extends Controller
{
    public function analysis(){
        $filters = [
            'model_names' => request()->model_names,
            'order_types' => request()->order_types
        ];

        //$size_oders = implode( ',', config('shoes.size') );
        $size_oders = config('shoes.size');
        $query = ShoesOrder::with(['ShoesOrderDetails', 'ShoesMaterials']);
        $query = $query->orderBy('received_at', 'DESC');

        //搜尋
        //型體 model_name
        $model_names = explode(',',$filters['model_names']);
        $query = $query->where(function($query) use($model_names){
                    foreach($model_names as $model_name){
                        if( $model_name!= "") {
                            $query = $query->orWhere('model_name', 'LIKE', '%' . $model_name . '%');
                        }
                    }
                    return $query;
                });
        //訂單類型 order_types
        $order_types = explode(',',$filters['order_types']);
        $query = $query->where(function($query) use($order_types){
            foreach($order_types as $order_type){
                if( $order_type!= "") {
                    $query = $query->orWhere('order_type', 'LIKE', '%' . $order_type . '%');
                }
            }
            return $query;
        });

        //材料名稱
        
        //頁數
        $shoes_orders = $query->paginate(200);

        return view(config('theme.staff.view').'mh.reports.order.analysis',
            [
                'shoes_orders' => $shoes_orders,
                'size_oders' => $size_oders,
                'filters' => [
                ]
            ]);
    }

    public function analysis_1(){
        //$size_oders = implode( ',', config('shoes.size') );
        $size_oders = config('shoes.size');
        $shoes_orders = ShoesOrder::with(['ShoesOrderDetails'])
            //->where('mh_order_code','MA01AA2000093')
            ->orderBy('received_at', 'DESC')
            ->paginate(200);

        return view(config('theme.staff.view').'mh.reports.order.analysis',
            [
                'shoes_orders' => $shoes_orders,
                'size_oders' => $size_oders,
                'filters' => [
                ]
            ]);
    }
}
