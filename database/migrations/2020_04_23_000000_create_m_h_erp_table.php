<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMHErpTable extends Migration
{
    public function up()
    {
        Schema::create('mh_shoes_molds', function (Blueprint $table) {
            $table->bigIncrements('mold_id');
            $table->bigInteger('department_id')->nullable();
            $table->smallInteger('proccess_order')->nullable(); //工序序號
            $table->string('proccess')->nullable(); //工序
            //$table->enum('mold_type', ['量產模','樣品模'])->nullable();
            $table->string('mold_type')->nullable();
            $table->string('keep_vendor')->nullable(); //保管廠商
            $table->bigInteger('m_id')->nullable();
            $table->string('size')->nullable(); //保管廠商
            $table->string('series')->nullable(); //模號
            $table->string('vendor')->nullable(); //製造商
            $table->integer('qty')->nullable(); //製造商
            $table->integer('pairs')->nullable(); //製造商
            $table->integer('operation_time')->nullable(); //製造商
            $table->integer('cycle_time')->nullable(); //製造商
            $table->enum('condition',['使用中','報廢'])->nullable();
            $table->timestamps();
        });

        Schema::create('mh_material_usages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('model')->nullable();
            $table->string('size')->nullable();
            $table->decimal('usage',10,5)->nullable();
            $table->bigInteger('staff_id');
            $table->decimal('pair_per_unit',10,2)->nullable();
            $table->timestamps();
        });

        Schema::create('mh_fee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('model')->nullable();
            $table->string('size')->nullable(); //工序
            $table->decimal('usage',10,5)->nullable();
            $table->bigInteger('staff_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mh_shoes_molds');
        Schema::dropIfExists('mh_material_usages');
        Schema::dropIfExists('mh_fee');

    }
}
