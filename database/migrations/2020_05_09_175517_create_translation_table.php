<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{

    public function up()
    {
        Schema::create('product_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('p_id')->unsigned();
            $table->string('p_name');
            $table->string('locale')->index();
            $table->unique(['p_id','locale']);
            $table->foreign('p_id')->references('p_id')->on('products')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('product_translation');
    }
}
