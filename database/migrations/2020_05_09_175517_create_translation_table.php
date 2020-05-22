<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationTable extends Migration
{

    public function up()
    {
        Schema::create('type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('type_t_id')->unsigned();
            $table->string('t_name')->nullable();
            $table->string('t_description')->nullable();
            $table->string('locale')->index();
            $table->unique(['type_t_id','locale']);
            $table->foreign('type_t_id')->references('t_id')->on('types')->onDelete('cascade');
        });

        Schema::create('attribute_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('attribute_a_id')->unsigned();
            $table->string('a_name')->nullable();
            $table->string('a_description')->nullable();
            $table->string('locale')->index();
            $table->unique(['attribute_a_id','locale']);
            $table->foreign('attribute_a_id')->references('a_id')->on('attributes')->onDelete('cascade');
        });

        Schema::create('product_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('product_p_id')->unsigned();
            $table->string('p_name');
            $table->string('p_description')->nullable();

            $table->string('locale')->index();
            $table->unique(['product_p_id','locale']);
            $table->foreign('product_p_id')->references('p_id')->on('products')->onDelete('cascade');
        });

        Schema::create('sku_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('s_k_u_sku_id')->unsigned();
            $table->string('sku_name');
            $table->decimal('price',15,1)->default(999999999);

            $table->string('locale')->index();
            $table->unique(['s_k_u_sku_id','locale']);
            $table->foreign('s_k_u_sku_id')->references('sku_id')->on('skus')->onDelete('cascade');
        });

        Schema::create('sku_supplier_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('skus_suppliers_id')->unsigned();
            $table->decimal('price',15,1)->default(999999999);
            $table->string('locale')->index();
            $table->unique(['skus_suppliers_id','locale']);
            $table->foreign('skus_suppliers_id')->references('ss_id')->on('skus_suppliers')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('type_translations');
        Schema::dropIfExists('attribute_translations');
        Schema::dropIfExists('product_translations');
        Schema::dropIfExists('sku_translations');
        Schema::dropIfExists('sku_supplier_translations');
    }
}
