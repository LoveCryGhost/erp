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
            $table->string('thumbnail')->nullable();


            //長寬高重量_pcs
            $table->decimal('length_pcs',10,1)->nullable()->default(999999);
            $table->decimal('width_pcs',10,1)->nullable()->default(999999);
            $table->decimal('heigth_pcs',10,1)->nullable()->default(999999);
            $table->decimal('weight_pcs',10,1)->nullable()->default(999999);

            //長寬高重量_box
            $table->decimal('length_box',10,1)->nullable()->default(999999);
            $table->decimal('width_box',10,1)->nullable()->default(999999);
            $table->decimal('heigth_box',10,1)->nullable()->default(999999);
            $table->decimal('weight_box',10,1)->nullable()->default(999999);
            $table->integer('pcs_per_box')->nullable()->default(999999);


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
