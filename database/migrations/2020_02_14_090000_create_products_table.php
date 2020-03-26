<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->bigIncrements('t_id');
            $table->string('id_code')->unique()->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('t_name')->unique();
            $table->string('t_description')->nullable();
            $table->bigInteger('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('a_id');
            $table->string('id_code')->unique()->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('a_name')->unique();
            $table->string('a_description')->nullable();
            $table->bigInteger('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('types_attributes', function (Blueprint $table) {
            $table->bigIncrements('ta_id');
            $table->tinyInteger('sort_order')->default(0);
            $table->BigInteger('t_id')->unsigned();
            $table->BigInteger('a_id')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('t_id')->references('t_id')->on('types')->onDelete('cascade');
            $table->foreign('a_id')->references('a_id')->on('attributes')->onDelete('cascade');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('p_id');
            $table->string('id_code')->unique()->nullable();
            $table->boolean('is_active')->default(0); //是否販售
            $table->timestamp('publish_at')->nullable();
            $table->bigInteger('t_id')->unsigned()->nullable();
            $table->string('p_name');
            $table->decimal('m_price',15,1)->nullable();
            $table->decimal('t_price',15,1)->nullable();
            $table->bigInteger('member_id')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('t_id')->references('t_id')->on('types')->onDelete('cascade');
        });

        Schema::create('products_categories', function (Blueprint $table) {
            $table->bigIncrements('pc_id');
            $table->BigInteger('p_id')->unsigned();
            $table->BigInteger('c_id')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->foreign('p_id')->references('p_id')->on('products')->onDelete('cascade');
            $table->foreign('c_id')->references('c_id')->on('categories')->onDelete('cascade');
        });

        Schema::create('product_thumbnails', function (Blueprint $table) {
            $table->bigIncrements('pt_id');
            $table->bigInteger('p_id')->unsigned();
            $table->tinyInteger('sort_order')->default(0)->nullable();
            $table->string('path')->nullable();
            $table->foreign('p_id')->references('p_id')->on('products')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('products_categories');
        Schema::dropIfExists('product_thumbnails');
        Schema::dropIfExists('products');
        Schema::dropIfExists('types_attributes');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('types');

    }
}
