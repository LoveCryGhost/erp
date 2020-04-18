<?php

namespace App\Http\Controllers\Staff\MH\Report;


use App\Exports\ShoesOrderWithSizeExport;
use App\Http\Controllers\Controller;
use App\Models\Shoes\ShoesOrder;
use Maatwebsite\Excel\Facades\Excel;
use function array_values;
use function compact;
use function config;
use function dd;
use function explode;
use function implode;
use function request;
use function view;

class ReportMHOrderController extends Controller
{

    public function analysis(){

        //盤別方法
        if(isset(request()->submit)){
            $case = array_values(request()->submit)[0];
        }else{
            $case = "submit_clear";
        }





        $filters = [
            'model_names' => request()->model_names,
            'order_types' => request()->order_types,
            'departments' => request()->departments,
            'order_conditions' => request()->order_conditions,
            'colors' => request()->colors,
            'mh_order_codes' => request()->mh_order_codes,
            'c_order_codes' => request()->c_order_codes,
            'c_purchase_codes' => request()->c_purchase_codes,
            'c_names' => request()->c_names,
        ];



        $size_oders = config('shoes.size');
        $query = ShoesOrder::with(['shoesOrderDetails', 'shoesPurchases', 'shoesCustomer']);
        $query = $this->analysis_filter($filters, $query);
        $query= $this->analysis_get_query($query);

        switch ($case) {
            case "download_shoes_order_with_sizes":
                return $this->download_shoes_order_with_sizes($query, $size_oders);
                break;

            default: //submit_get & submit_clear
                $shoes_orders = $query->paginate(30);
                return view(config('theme.staff.view').'mh.reports.order.analysis',
                    [
                        'shoes_orders' => $shoes_orders,
                        'size_oders' => $size_oders,
                        'filters' => $filters
                    ]);
                break;
        }

    }



    public function analysis_filter($filters, $query)
    {

        //搜尋
        //部門 department
        $departments = explode(',',$filters['departments']);
        $query = $query->where(function($query) use($departments){
            foreach($departments as $department){
                if( $department!= "") {
                    $query = $query->Where('department', 'LIKE', '%' . $department . '%')
                        ->orWhere('department', 'LIKE', '%' . $department . '%')
                    ;
                }
            }
            return $query;
        });

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
                    $query = $query->where('order_type', 'LIKE', '%' . $order_type . '%');
                }
            }
            return $query;
        });

        //訂單狀態 order_conditions
        $order_conditions = explode(',',$filters['order_conditions']);
        $query = $query->where(function($query) use($order_conditions){
            foreach($order_conditions as $order_condition){
                if( $order_condition!= "") {
                    $query = $query->where('order_condition', 'LIKE', '%' . $order_condition . '%');
                }
            }
            return $query;
        });


        $mh_order_codes = explode(',',$filters['mh_order_codes']);
        $query = $query->where(function($query) use($mh_order_codes){
            $index=1;
            foreach($mh_order_codes as $mh_order_code){
                if( $mh_order_code!= "" and $index==1) {
                    $query->where('mh_order_code', 'LIKE', '%' . $mh_order_code . '%');
                }else{
                    $query->orwhere(function($q) use($mh_order_code) {
                        $q->where('mh_order_code', 'LIKE', '%' . $mh_order_code .'%');
                    });
                }
                $index++;
            }
            return $query;
        });

        //客戶訂單號
        $c_order_codes = explode(',',$filters['c_order_codes']);
        $query = $query->where(function($query) use($c_order_codes){
            $index=1;
            foreach($c_order_codes as $c_order_code){
                if( $c_order_code!= "" and $index==1) {
                    $query = $query->where('c_order_code', 'LIKE', '%' . $c_order_code . '%');
                }else{
                    $query->orwhere(function($q) use($c_order_code) {
                        $q->where('c_order_code', 'LIKE', '%' . $c_order_code .'%');
                    });
                }
                $index++;
            }
            return $query;
        });

        $c_purchase_codes = explode(',', $filters['c_purchase_codes']);
        $query = $query->where(function($query) use($c_purchase_codes){
            $index=1;
            foreach($c_purchase_codes as $c_purchase_code){
                if( $c_purchase_code!= ""  and $index==1) {
                    $query = $query->where('c_purchase_code', 'LIKE', '%' . $c_purchase_code . '%');
                }else{
                    $query->orwhere(function($q) use($c_purchase_code) {
                        $q->where('c_purchase_code', 'LIKE', '%' . $c_purchase_code .'%');
                    });
                }
                $index++;
            }
            return $query;
        });

        //顏色
        $colors = explode(',', $filters['colors']);
        $query = $query->where(function($query) use($colors){
            $index=1;
            foreach($colors as $color){
                if( $color!= ""  and $index==1) {
                    $query = $query->where('color', 'LIKE', '%' . $color . '%');
                }else{
                    $query->orwhere(function($q) use($color) {
                        $q->where('color', 'LIKE', '%' . $color .'%');
                    });
                }
                $index++;
            }
            return $query;
        });

        //客戶名稱
        $c_names = explode(',', $filters['c_names']);
        $query = $query->where(function($query) use($c_names){
            $index=1;
            foreach($c_names as $c_name){
                if( $c_name!= ""  and $index==1) {
                    $query = $query->where('c_name', 'LIKE', '%' . $c_name . '%');
                }else{
                    $query->orwhere(function($q) use($c_name) {
                        $q->where('c_name', 'LIKE', '%' . $c_name .'%');
                    });
                }
                $index++;
            }
            return $query;
        });
        return $query;
    }

    public function analysis_get_query($query){
        return $query = $query->orderBy('received_at', 'DESC');
    }

    public function download_shoes_order_with_sizes($records, $size_oders)
    {
        return Excel::download(new ShoesOrderWithSizeExport($records, $size_oders), 'users.xls');
    }

}
