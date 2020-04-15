<?php

namespace App\Jobs;

use App\Console\Commands\MHShoesMaterialControlCron;
use App\Models\Shoes\ShoesCustomer;
use App\Models\Shoes\ShoesEE;
use App\Models\Shoes\ShoesMaterial;
use App\Models\Shoes\ShoesModel;
use App\Models\Shoes\ShoesOrder;
use App\Models\Shoes\ShoesPurchase;
use App\Models\Shoes\ShoesSupplier;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
//use function count;
//use function dispatch;
//use function substr;

class MHShoesMaterialControlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    //處理的工作
    public function handle()
    {

        //$ee = $this->getShoesEEQuery();
        $shoes_ee = ShoesEE::whereNotNull('mh_order_code')->first();
        if ($shoes_ee!=null) {
            //$shoes_ees_query = $ee['shoes_ees_query'];
            //$shoes_ee = $shoes_ees_query->get()->last();

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
            $shoes_order = ShoesOrder::updateOrCreate([
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
            ShoesPurchase::updateOrCreate([
                'order_id' => $shoes_order->order_id,
                'mt_id' => isset($shoes_material)? $shoes_material->mt_id:null,
                'puchase_plan' => $shoes_ee->puchase_plan ,
                'purchase_content'  => $shoes_ee->purchase_content,
                'purchase_a_qty'  => $shoes_ee->purchase_a_qty,
                'purchase_loss_qty'  => $shoes_ee->purchase_loss_qty,
                'purchase_plan_qty'  => $shoes_ee->purchase_plan_qty,
                'purchase_at'  => $shoes_ee->purchase_at,
                'purchase_qty'  => $shoes_ee->purchase_qty,
                'material_received_at'  => $shoes_ee->material_received_at,
                'inbound_qty'  => $shoes_ee->inbound_qty,
                'particle_qty'  => $shoes_ee->particle_qty,
                'outbount_at'  => $shoes_ee->outbount_at,
                'material_a_outbound_qty'  => $shoes_ee->material_a_outbound_qty,
                'material_o_outbound_qty'  => $shoes_ee->material_o_outbound_qty,
                'material_fass_outbound_qty'  => $shoes_ee->material_fass_outbound_qty,
                'material_reprocess_outbound_qty'  => $shoes_ee->material_reprocess_outbound_qty,
                'material_price'  => $shoes_ee->material_price,
                's_id'  => isset($shoes_supplier)? $shoes_supplier->s_id:null,
                'supplier_name'  => $shoes_ee->supplier_name,
            ],[

            ]);

            //新增訂單明細

            $shoes_ee->delete();

            //重新指派任務
            dispatch((new MHShoesMaterialControlJob())->onQueue('high'));
        }

    }

    /*
     * 搜尋mh_shoes_ee
     * 用mh_order_code排序
     * */
    public function getShoesEEQuery(){
        ShoesEE::whereNull('mh_order_code')->delete();
        $shoes_ee = ShoesEE::whereNotNull('mh_order_code')->first();
        if($shoes_ee==null){
            $shoes_ee = [];
            $shoes_ees_query = [];
        }else{
            $shoes_ees_query = ShoesEE::where('c_purhcase_code', $shoes_ee->c_purhcase_code) //採購單號
            ->where('c_name', $shoes_ee->c_name) //客戶名稱
            ->where('c_order_code', $shoes_ee->c_order_code) //客戶訂單號
            ->where('order_type', $shoes_ee->order_type);

            $shoes_ee = ['done'];
        }

        return ['shoes_ees_query'=> $shoes_ees_query, 'shoes_ee' =>$shoes_ee];
    }
}


