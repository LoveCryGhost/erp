<?php

use App\Models\Shoes\ShoesCustomer;
use App\Models\Shoes\ShoesEE;
use App\Models\Shoes\ShoesMaterial;
use App\Models\Shoes\ShoesModel;
use App\Models\Shoes\ShoesOrder;
use App\Models\Shoes\ShoesSupplier;

Route::get('/mh_erp', function () {

    for($i=1; $i<=100; $i++) {
        /*
         * 搜尋mh_shoes_ee
         * 用mh_order_code排序
         * */
        $shoes_ee = ShoesEE::whereNotNull('mh_order_code')->first();
        if($shoes_ee==null){
            return false;
        }

        $shoes_ees_query = ShoesEE::where('c_purhcase_code', $shoes_ee->c_purhcase_code) //採購單號
        ->where('c_name', $shoes_ee->c_name) //客戶名稱
        ->where('c_order_code', $shoes_ee->c_order_code) //客戶訂單號
        ->where('order_type', $shoes_ee->order_type);
        if(count($shoes_ees_query->get())==0){
            dd('break');
            break;
        }

        $shoes_ee = $shoes_ees_query->get()->last();

        //mh指令號
        if (empty($shoes_ee->mh_order_code)) {
            $shoes_ee->delete();
            return false;
        } else {
            $department = substr($shoes_ee->mh_order_code, 1, 1);
            if ($department == "A") {
                $department = "IP";
            } else {
                $department = "SP";
            };
        }

        //新增型體
        if (!empty($shoes_ee->model_name)) {
            $shoes_model = ShoesModel::updateOrCreate([
                'model_name' => $shoes_ee->model_name,
            ], [
                'department' => $department
            ]);
        }

        //新增客戶
        if (!empty($shoes_ee->c_name)) {
            $shoes_customer = ShoesCustomer::updateOrCreate([
                'c_name' => $shoes_ee->c_name,
            ], [
            ]);
        }

        //新增供應商
        if (!empty($shoes_ee->supplier_name)) {
            $shoes_supplier = ShoesSupplier::updateOrCreate([
                'supplier_name' => $shoes_ee->supplier_name,
            ], [

            ]);
        }

        //新增材料
        if (!empty($shoes_ee->c_name)) {
            $shoes_material = ShoesMaterial::updateOrCreate([
                'material_code' => $shoes_ee->material_code,
            ], [
                'material_name' => $shoes_ee->material_name,
                'material_unit' => $shoes_ee->material_unit,
                'material_price' => $shoes_ee->material_price,
                's_id' => isset($shoes_supplier) ? $shoes_supplier->s_id : null,
                'supplier_name' => $shoes_ee->material_code,
            ]);
        }

        //新增訂單
        ShoesOrder::updateOrCreate([
            'mh_order_code' => $shoes_ee->mh_order_code,
        ], [
            'department' => $department,
            'received_at' => $shoes_ee->received_at,
            'outbound_condition' => $shoes_ee->outbound_condition,
            'c_purhcase_code' => $shoes_ee->c_purhcase_code,
            'order_condition' => $shoes_ee->order_condition,
            'c_order_code' => $shoes_ee->c_order_code,
            'c_id' => $shoes_customer->c_id,
            'c_name' => $shoes_ee->c_name,
            'm_id' => $shoes_model->m_id,
            'model_name' => $shoes_model->model_name,
            'order_type' => $shoes_ee->order_type,
        ]);


        //新增採購單
        //新增訂單明細

        $shoes_ees_query->delete();
    };
});


