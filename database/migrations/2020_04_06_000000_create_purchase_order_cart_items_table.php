<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderCartItemsTable extends Migration
{
    public function up()
    {
        Schema::create('purchase_order_cart_items', function (Blueprint $table) {
            $table->bigIncrements('poci_id');
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->unsignedBigInteger('sku_id');
            $table->foreign('sku_id')->references('sku_id')->on('skus')->onDelete('cascade');
            $table->unsignedInteger('amount');
        });
    }

    public function down()
    {
            Schema::dropIfExists('purchase_order_cart_items');
    }
}
