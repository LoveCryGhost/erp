<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkuSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skus_suppliers', function (Blueprint $table) {
            $table->bigIncrements('ss_id');
            $table->boolean('is_active')->default(0);
            $table->tinyInteger('sort_order')->default(0);
            $table->bigInteger('sku_id')->unsigned();
            $table->bigInteger('s_id')->unsigned();
            $table->decimal('price',15,1)->unsigned()->default(999999999);
            $table->string('url')->nullable();
//            $table->foreign('s_id')->references('s_id')->on('suppliers')->onDelete('cascade');
            $table->foreign('sku_id')->references('sku_id')->on('skus')->onDelete('cascade');
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
        Schema::dropIfExists('skus_suppliers');
    }
}
