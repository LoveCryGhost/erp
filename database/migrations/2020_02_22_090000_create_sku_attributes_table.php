<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkuAttributesTable extends Migration
{
    public function up()
    {
        //產品SKU - 產品屬性值
        Schema::create('sku_attributes', function (Blueprint $table) {
            $table->BigIncrements('sa_id');
            $table->bigInteger('sku_id')->unsigned();
            $table->bigInteger('a_id')->unsigned();
            $table->string('a_value')->nullable();
            $table->foreign('a_id')->references('a_id')->on('attributes')->onDelete('cascade');
            $table->foreign('sku_id')->references('sku_id')->on('skus')->onDelete('cascade');

            //多國語言
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('sku_attributes');
    }
}
