<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMHTable extends Migration
{
    public function up()
    {
        Schema::create('mh_shoes_ee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mh_order_code'); //指令编号 - mh_shoes_orders
            $table->string('received_at'); //接单日期 - mh_shoes_orders
            $table->string('outbound_condition'); //出货状态 - mh_shoes_orders
            $table->string('m_purchase_code'); //茂弘采购单号 - mh_shoes_orders
            $table->string('order_condition'); //订单状态 - mh_shoes_orders
            $table->string('c_name'); //客户简称 - mh_shoes_customers
            $table->string('c_order_code'); //客户订单号 - mh_shoes_orders
            $table->string('model_name'); //型体编号 - mh_shoes_models
            $table->string('puchase_plan'); //计划编号 - mh_shoes_purchases
            $table->text('purchase_content'); //计划内容 - mh_shoes_purchases
            $table->string('material_code'); //物料编号 - mh_shoes_materials
            $table->string('material_name'); //物料名称 - mh_shoes_materials
            $table->string('material_unit'); //单位 - mh_shoes_materials
            $table->string('order_type'); //订单类型 - mh_shoes_orders
            $table->string('bom_type'); //BOM类型
            $table->string('purchase_a_qty'); //指令量正批 - mh_shoes_purchases
            $table->string('purchase_loss_qty'); //指令量损耗 - mh_shoes_purchases
            $table->string('purchase_plan_qty'); //计划采购 - mh_shoes_purchases
            $table->string('purchase_at'); //采购日期 - mh_shoes_purchases
            $table->string('purchase_qty'); //采购量 - mh_shoes_purchases
            $table->string('material_received_at'); //验收日期 - mh_shoes_purchases
            $table->string('inbound_qty'); //入库量 - mh_shoes_purchases
            $table->string('particle_qty'); //粒料指令 - mh_shoes_purchases
            $table->string('outbound_at'); //出库日期 - mh_shoes_purchases
            $table->string('material_a_outbound_qty'); //正批领料 - mh_shoes_purchases
            $table->string('material_o_outbound_qty'); //补料领料 - mh_shoes_purchases
            $table->string('material_fass_outbound_qty'); //快速领料 - mh_shoes_purchases
            $table->string('material_reprocess_outbound_qty'); //加工领料  - mh_shoes_purchases
            $table->string('supplier_name'); //厂商
            $table->string('material_price'); //单价- mh_shoes_materials
        });

        Schema::create('mh_shoes_db', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mh_order_code')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('c_purchase_code')->nullable();
            $table->string('c_order_code')->nullable();
            $table->string('c_model_type')->nullable();
            $table->string('model_name')->nullable();
            $table->string('qty')->nullable();
            $table->string('color')->nullable();
            $table->string('received_at')->nullable();
            $table->string('sizes')->nullable();
            $table->string('note')->nullable();
        });

        Schema::create('mh_shoes_models', function (Blueprint $table) {
            $table->bigIncrements('m_id');
            $table->string('model_name');
            $table->string('department');

            $table->timestamps();
        });

        Schema::create('mh_shoes_orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->string('mh_order_code'); //指令编号 - mh_shoes_orders
            $table->date('predict_at'); //預告日期
            $table->string('department');
            $table->date('received_at'); //接单日期 - mh_shoes_orders
            $table->string('outbound_condition')->nullable(); //出货状态 - mh_shoes_orders
            $table->string('c_purchase_code')->nullable(); //采购单号 - mh_shoes_orders
            $table->string('order_condition')->nullable(); //订单状态 - mh_shoes_orders
            $table->string('c_order_code')->nullable(); //客户订单号 - mh_shoes_orders

            $table->bigInteger('c_id')->nullable(); //客户简称
            $table->string('c_name')->nullable(); //客户简称

            $table->string('m_id')->nullable(); //型体编号
            $table->string('model_name')->nullable(); //型体编号
            $table->string('color')->nullable(); //---------------------------------
            $table->string('currency')->nullable(); //---------------------------------
            $table->string('price')->nullable(); //---------------------------------
            $table->string('qty')->nullable()->default(0); //---------------------------------
            $table->string('inbound_qyt')->nullable(); //---------------------------------
            $table->string('inbound_at')->nullable(); //---------------------------------
            $table->string('outbound_at')->nullable(); //---------------------------------


            $table->string('order_type')->nullable(); //订单类型 - mh_shoes_orders
            $table->string('pic')->nullable(); //---------------------------------
            $table->string('note')->nullable(); //---------------------------------
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('mh_shoes_order_details', function (Blueprint $table) {
            //$table->bigIncrements('od_id');
            $table->string('mh_order_code')->index(); //指令编号 - mh_shoes_orders
            $table->string('size'); //指令编号 - mh_shoes_orders
            $table->string('p_l_r'); //指令编号 - mh_shoes_orders
            $table->decimal('qty',7,1); //接单日期 - mh_shoes_orders
            $table->primary(['mh_order_code', 'size', 'p_l_r']);
            //$table->timestamps();
        });

        Schema::create('mh_shoes_customers', function (Blueprint $table) {
            $table->bigIncrements('c_id');
            $table->string('c_name');
            $table->timestamps();
        });

        Schema::create('mh_shoes_materials', function (Blueprint $table) {
            $table->bigIncrements('mt_id');
            $table->string('material_code'); //物料编号 - mh_shoes_materials
            $table->string('material_name'); //物料名称 - mh_shoes_materials
            $table->string('material_unit'); //单位 - mh_shoes_materials
            $table->string('material_price'); //单价- mh_shoes_materials
            $table->bigInteger('s_id')->nullable();
            $table->string('supplier_name');
            $table->timestamps();
        });

        Schema::create('mh_shoes_purchases', function (Blueprint $table) {
            $table->bigIncrements('p_id');
            $table->bigInteger('order_id');
            $table->bigInteger('mt_id');
            $table->string('material_name')->nullable();
            $table->string('puchase_plan'); //计划编号 - mh_shoes_purchases
            $table->string('purchase_content'); //计划内容 - mh_shoes_purchases
            $table->decimal('purchase_a_qty',6,0); //指令量正批 - mh_shoes_purchases
            $table->decimal('purchase_loss_qty',6,0); //指令量损耗 - mh_shoes_purchases
            $table->decimal('purchase_plan_qty',6,0); //计划采购 - mh_shoes_purchases
            $table->date('purchase_at'); //采购日期 - mh_shoes_purchases
            $table->decimal('purchase_qty',6,0); //采购量 - mh_shoes_purchases
            $table->date('material_received_at'); //验收日期 - mh_shoes_purchases
            $table->decimal('inbound_qty',6,0); //入库量 - mh_shoes_purchases
            $table->decimal('particle_qty',6,0); //粒料指令 - mh_shoes_purchases
            $table->date('outbound_at'); //出库日期 - mh_shoes_purchases
            $table->decimal('material_a_outbound_qty',6,0); //正批领料 - mh_shoes_purchases
            $table->decimal('material_o_outbound_qty',6,0); //补料领料 - mh_shoes_purchases
            $table->decimal('material_fass_outbound_qty',6,0); //快速领料 - mh_shoes_purchases
            $table->decimal('material_reprocess_outbound_qty',6,0); //加工领料  - mh_shoes_purchases
            $table->decimal('material_price',6,0); //单价- mh_shoes_materials
            $table->bigInteger('s_id')->nullable();
            $table->string('supplier_name');
            $table->timestamps();
        });

        Schema::create('mh_shoes_sizes', function (Blueprint $table) {
            $table->bigIncrements('size_id');
            $table->bigInteger('model_id');
            $table->string('size');
            $table->timestamps();
        });

        Schema::create('mh_shoes_model_usages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('model_id');
            $table->bigInteger('size_id');
            $table->decimal('usage',6,0);
            $table->timestamps();
        });

        Schema::create('mh_shoes_suppliers', function (Blueprint $table) {
            $table->bigIncrements('s_id');
            $table->string('supplier_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mh_shoes_ee');
        Schema::dropIfExists('mh_shoes_db');
        Schema::dropIfExists('mh_shoes_models');
        Schema::dropIfExists('mh_shoes_customers');
        Schema::dropIfExists('mh_shoes_materials');
        Schema::dropIfExists('mh_shoes_orders');
        Schema::dropIfExists('mh_shoes_order_details');
        Schema::dropIfExists('mh_shoes_suppliers');
        Schema::dropIfExists('mh_shoes_purchases');
        Schema::dropIfExists('mh_shoes_sizes');
        Schema::dropIfExists('mh_shoes_model_usages');
    }
}
