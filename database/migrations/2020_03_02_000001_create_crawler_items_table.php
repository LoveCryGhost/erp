<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrawlerItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawler_items', function (Blueprint $table) {
            $table->bigIncrements('ci_id');
            $table->boolean('is_active')->default(1);
            $table->string('itemid')->unique()->index();
            $table->string('shopid')->nullable();
            $table->string('name')->nullable();
            $table->string('images')->nullable();
            $table->integer('sold')->default(0);
            $table->integer('historical_sold')->default(0);
            $table->string('local')->nullable();
            $table->string('domain_name')->nullable();
            $table->bigInteger('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamp('updated_at')->useCurrent()->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('crawler_shops', function (Blueprint $table) {
            $table->bigIncrements('cs_id');
            $table->string('shopid')->unique()->index();
            $table->string('username')->nullable();
            $table->string('shop_location')->nullable();
            $table->string('domain_name')->nullable();
            $table->string('local')->nullable();
//            $table->bigInteger('ci_id')->unsigned();
//            $table->foreign('ci_id')->references('ci_id')->on('crawler_items')->onDelete('cascade');
            $table->bigInteger('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('ctasks_items', function (Blueprint $table) {
            //$table->bigIncrements('ct_i_d');
            $table->integer('sort_order')->default(9999);
            $table->bigInteger('ct_id')->unsigned();
            $table->foreign('ct_id')->references('ct_id')->on('crawler_tasks')->onDelete('cascade');
            $table->bigInteger('ci_id')->unsigned();
            $table->foreign('ci_id')->references('ci_id')->on('crawler_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ctasks_items');
        Schema::dropIfExists('crawler_shops');
        Schema::dropIfExists('crawler_items');
    }
}
