<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductSkuCrawlerItemSkuTable extends Migration
{
    public function up()
    {
        Schema::create('psku_cskus', function (Blueprint $table) {
            $table->bigIncrements('pc_sku_id')->unsigned();
            $table->bigInteger('ct_i_id')->unsigned();
            $table->bigInteger('sku_id')->unsigned();
            $table->bigInteger('itemid')->unsigned();
            $table->bigInteger('shopid')->unsigned();
            $table->bigInteger('modelid')->unsigned();
            $table->bigInteger('member_id')->unsigned();

            $table->foreign('sku_id')->references('sku_id')->on('skus')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psku_cskus');
    }
}
