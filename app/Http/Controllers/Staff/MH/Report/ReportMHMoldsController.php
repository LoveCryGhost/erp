<?php

namespace App\Http\Controllers\Staff\MH\Report;


use App\Exports\ShoesOrderWithSizeExport;
use App\Http\Controllers\Controller;
use App\Models\Shoes\ShoesMold;
use App\Models\Shoes\ShoesOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use function array_values;
use function compact;
use function config;
use function dd;
use function explode;
use function implode;
use function request;
use function trim;
use function view;

class ReportMHMoldsController extends Controller
{
    public $filters;

    public function __construct()
    {
        $actions = [
            'analysis'];
        $this->coreMiddleware('ReportMHMoldsController',$guard='staff', $route="reportMHMold", $actions);
    }

    public function analysis(){

        //判別方法
        if(isset(request()->submit)){
            $case = array_values(request()->submit)[0];
        }else{
            $case = "submit_clear";
        }

        $this->filters = [
//            'model_names' => request()->model_names,
//            'order_types' => request()->order_types,
//            'departments' => request()->departments,
//            'order_conditions' => request()->order_conditions,
//            'colors' => request()->colors,
//            'mh_order_codes' => request()->mh_order_codes,
//            'c_order_codes' => request()->c_order_codes,
//            'c_purchase_codes' => request()->c_purchase_codes,
//            'c_names' => request()->c_names,
//            'orderbys' => request()->orderbys,
//            'received_start_at' => request()->received_start_at,
//            'received_end_at' => request()->received_end_at
        ];



        $size_oders = config('shoes.size');
        $query = ShoesMold::with(['department']);

        //$query = $this->analysis_filter($query, $this->filters);
        //$query = $this->analysis_orderby($query, $this->filters);


        switch ($case) {
            case "download_shoes_order_with_sizes":
                return $this->download_shoes_order_with_sizes($query, $size_oders);
                break;

            default: //submit_get & submit_clear
                $shoes_molds = $query->get();
                return view(config('theme.staff.view').'mh.reports.mold.analysis',
                    [
                        'shoes_molds' => $shoes_molds,
                        'size_oders' => $size_oders,
                        'filters' => $this->filters
                    ]);
                break;
        }
    }



    public function analysis_filter($query, $filters)
    {

//        //搜尋
//        //部門 department
//        $departments = explode(',',$filters['departments']);
//        $query = $query->where(function($query) use($departments){
//            $index=1;
//            foreach($departments as $department){
//                $department= trim($department);
//                if( $department!= "" and $index==1) {
//                    $query = $query->where('department', 'LIKE', '%' . $department . '%');
//                }elseif($department!= "" ){
//                    $query->orwhere(function($q) use($department) {
//                        $q->where('department', 'LIKE', '%' . $department .'%');
//                    });
//                }
//                $index++;
//            }
//            return $query;
//        });
//
//        //型體 model_name
//        $model_names = explode(',',$filters['model_names']);
//        $query = $query->where(function($query) use($model_names){
//            $index=1;
//            foreach($model_names as $model_name){
//                $model_name = trim($model_name);
//                if( $model_name!= "" and $index==1) {
//                    $query = $query->where('model_name', 'LIKE', '%' . $model_name . '%');
//                }elseif($model_name!= "" ){
//                    $query->orwhere(function($q) use($model_name) {
//                        $q->where('model_name', 'LIKE', '%' . $model_name .'%');
//                    });
//                }
//                $index++;
//            }
//            return $query;
//        });

//        //訂單類型 order_types
//        $order_types = explode(',',$filters['order_types']);
//        $query = $query->where(function($query) use($order_types){
//            $index=1;
//            foreach($order_types as $order_type){
//                $order_type = trim($order_type);
//                if( $order_type!= "" and $index==1) {
//                    $query = $query->where('order_type', 'LIKE', '%' . $order_type . '%');
//                }elseif($order_type!= "" ){
//                    $query->orwhere(function($q) use($order_type) {
//                        $q->where('order_type', 'LIKE', '%' . $order_type .'%');
//                    });
//                }
//                $index++;
//            }
//            return $query;
//        });
//
//        //訂單狀態 order_conditions
//        $order_conditions = explode(',',$filters['order_conditions']);
//        $query = $query->where(function($query) use($order_conditions){
//            $index=1;
//            foreach($order_conditions as $order_condition){
//                $order_condition = trim($order_condition);
//                if( $order_condition!= "" and $index==1) {
//                    $query = $query->where('order_condition', 'LIKE', '%' . $order_condition . '%');
//                }elseif($order_condition!= "" ){
//                    $query->orwhere(function($q) use($order_condition) {
//                        $q->where('order_condition', 'LIKE', '%' . $order_condition .'%');
//                    });
//                }
//                $index++;
//            }
//            return $query;
//        });
//
//
//        $mh_order_codes = explode(',',$filters['mh_order_codes']);
//        $query = $query->where(function($query) use($mh_order_codes){
//            $index=1;
//            foreach($mh_order_codes as $mh_order_code){
//                $mh_order_code = trim($mh_order_code);
//                if( $mh_order_code!= "" and $index==1) {
//                    $query->where('mh_order_code', 'LIKE', '%' . $mh_order_code . '%');
//                }elseif($mh_order_code!= ""){
//                    $query->orwhere(function($q) use($mh_order_code) {
//                        $q->where('mh_order_code', 'LIKE', '%' . $mh_order_code .'%');
//                    });
//                }
//                $index++;
//            }
//            return $query;
//        });
//
//        //客戶訂單號
//        $c_order_codes = explode(',',$filters['c_order_codes']);
//        $query = $query->where(function($query) use($c_order_codes){
//            $index=1;
//            foreach($c_order_codes as $c_order_code){
//                $c_order_code = trim($c_order_code);
//                if( $c_order_code!= "" and $index==1) {
//                    $query = $query->where('c_order_code', 'LIKE', '%' . $c_order_code . '%');
//                }elseif($c_order_code!= ""){
//                    $query->orwhere(function($q) use($c_order_code) {
//                        $q->where('c_order_code', 'LIKE', '%' . $c_order_code .'%');
//                    });
//                }
//                $index++;
//            }
//            return $query;
//        });
//
//        $c_purchase_codes = explode(',', $filters['c_purchase_codes']);
//        $query = $query->where(function($query) use($c_purchase_codes){
//            $index=1;
//            foreach($c_purchase_codes as $c_purchase_code){
//                $c_purchase_code = trim($c_purchase_code);
//                if( $c_purchase_code!= ""  and $index==1) {
//                    $query = $query->where('c_purchase_code', 'LIKE', '%' . $c_purchase_code . '%');
//                }elseif($c_purchase_code!= ""){
//                    $query->orwhere(function($q) use($c_purchase_code) {
//                        $q->where('c_purchase_code', 'LIKE', '%' . $c_purchase_code .'%');
//                    });
//                }
//                $index++;
//            }
//            return $query;
//        });
//
//        //顏色
//        $colors = explode(',', $filters['colors']);
//        $query = $query->where(function($query) use($colors){
//            $index=1;
//            foreach($colors as $color){
//                $color = trim($color);
//                if( $color!= ""  and $index==1) {
//                    $query = $query->where('color', 'LIKE', '%' . $color . '%');
//                }elseif($color!= ""){
//                    $query->orwhere(function($q) use($color) {
//                        $q->where('color', 'LIKE', '%' . $color .'%');
//                    });
//                }
//                $index++;
//            }
//            return $query;
//        });
//
//        //客戶名稱
//        $c_names = explode(',', $filters['c_names']);
//        $query = $query->where(function($query) use($c_names){
//            $index=1;
//            foreach($c_names as $c_name){
//                $c_name = trim($c_name);
//                if( $c_name!= ""  and $index==1) {
//                    $query = $query->where('c_name', 'LIKE', '%' . $c_name . '%');
//                }elseif($c_name!= ""){
//                    $query->orwhere(function($q) use($c_name) {
//                        $q->where('c_name', 'LIKE', '%' . $c_name .'%');
//                    });
//                }
//                $index++;
//            }
//            return $query;
//        });
//
//        //訂單接收日期
//        if(isset($filters['received_start_at']) and isset($filters['received_end_at']) ){
//            //dd(1,2,$filters['received_start_at'],$filters['received_end_at']);
//            $query->whereBetween('received_at', array($filters['received_start_at'], $filters['received_end_at']))->get();
//        }elseif($filters['received_start_at']){
//            //dd(1);
//            $query->where('received_at', '>=', $filters['received_start_at'])->get();
//        }elseif(isset($filters['received_end_at'])){
//            //dd(2);
//            $query->where('received_at', '<=', $filters['received_end_at'])->get();
//        }


        return $query;
    }

    public function analysis_orderby($query)
    {

//        //預設排序
//        if(!isset($this->filters['orderbys']) or count($this->filters['orderbys'])==0 or $this->filters['orderbys']===null){
//            $this->filters['orderbys'][1]="";
//            $this->filters['orderbys'][2]="";
//            return $query = $query->orderBy('received_at', 'DESC');
//        }else{
//            foreach ($this->filters['orderbys'] as $key => $value){
//                $value_arr = explode("@", $value); //Select欄位, ASC or DESC
//                if($value!=""){
//                    $query = $query->orderBy($value_arr[0], $value_arr[1]);
//                }
//            }
//
//            //避免錯誤
//            if(!isset( $this->filters['orderbys'][1])){ $this->filters['orderbys'][1]="";};
//            if(!isset( $this->filters['orderbys'][2])){ $this->filters['orderbys'][2]="";};
//
//        }

        return $query;
    }




}
