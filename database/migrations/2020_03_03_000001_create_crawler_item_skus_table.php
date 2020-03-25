<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrawlerItemSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citem_skus', function (Blueprint $table) {
            $table->bigInteger('ci_id')->unsigned();
            $table->string('shopid');
            $table->string('itemid');
            $table->string('modelid');
            $table->primary(['shopid', 'itemid', 'modelid']);
            $table->string('name');
            $table->string('local')->nullable();
            $table->integer('sold')->default(0);
            $table->integer('stock')->default(0);
            $table->unsignedBigInteger('price')->default(0);

            $table->foreign('ci_id')->references('ci_id')->on('crawler_items')->onDelete('cascade');
            $table->timestamps();

            //$table->timestamp('created_at')->useCurrent();
            //$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('citem_sku_details', function (Blueprint $table) {
            $table->string('shopid');
            $table->string('itemid');
            $table->string('modelid');
            $table->primary(['shopid', 'itemid', 'modelid','created_at']);
            $table->decimal('price',20)->default(0);
            $table->decimal('price_before_discount',20)->default(0);
            $table->integer('sold')->default(0);
            $table->integer('stock')->default(0);
            $table->date('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citem_skus');
        Schema::dropIfExists('citem_sku_details');
    }
}
