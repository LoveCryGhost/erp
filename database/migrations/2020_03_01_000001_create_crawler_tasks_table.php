<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrawlerTasksTable extends Migration
{

    public function up()
    {
        Schema::create('crawler_tasks', function (Blueprint $table) {
            $table->bigIncrements('ct_id');
            $table->string('id_code')->unique()->nullable();
            $table->boolean('is_active')->default(1);
            $table->tinyInteger('sort_order')->default(0);
            $table->string('ct_name');
            $table->string('url',500);
            $table->string('domain_name')->nullable();
            $table->string('pages')->default(2);
            $table->string('category')->nullable();
            $table->string('subcategory')->nullable();
            $table->string('keyword')->nullable();
            $table->string('order')->nullable();
            $table->string('sort_by')->nullable();
            $table->string('locations')->nullable();
            $table->string('ratingFilter')->nullable();
            $table->string('wholesale')->nullable();
            $table->string('shippingOptions')->nullable();
            $table->string('facet')->nullable();
            $table->string('officialMall')->nullable();
            $table->string('local')->nullable();
            $table->text('description')->nullable();

            $table->bigInteger('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamps();
        });


    }

    public function down()
    {
        Schema::dropIfExists('crawler_tasks');
    }
}
