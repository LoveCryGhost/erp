<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkusTable extends Migration
{
    public function up()
    {
        Schema::create('skus', function (Blueprint $table) {
            $table->bigIncrements('sku_id');
            $table->string('id_code')->unique()->nullable();
            $table->boolean('is_active')->default(0);
            $table->string('sku_name');
            $table->string('thumbnail')->nullable();
            $table->decimal('price',15,1)->default(999999999);
            $table->bigInteger('p_id')->unsigned();
            $table->bigInteger('member_id')->unsigned();
            $table->foreign('p_id')->references('p_id')->on('products')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });


    }

    public function down()
    {
        Schema::dropIfExists('skus');


    }
}
