<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    public function up()
    {
        Schema::create('supplier_groups', function (Blueprint $table) {
            $table->bigIncrements('sg_id');
            $table->string('id_code')->unique()->nullable();
            $table->boolean('is_active')->default(0);
            $table->string('sg_name');
            $table->string('name_card')->nullable();
            $table->string('add_company')->nullable();
            $table->string('wh_company')->nullable();
            $table->string('tel')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_id')->nullable(); //統編
            $table->string('website')->nullable();
            $table->text('introduction')->nullable();

            $table->bigInteger('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });



        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('s_id');
            $table->bigInteger('sg_id')->unsigned();
            $table->string('id_code')->unique()->nullable();
            $table->boolean('is_active')->default(0);
            $table->string('s_name');
            $table->string('name_card')->nullable();
            $table->string('add_company')->nullable();
            $table->string('wh_company')->nullable();
            $table->string('tel')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_id')->nullable();
            $table->string('website')->nullable();
            $table->text('introduction')->nullable();

            $table->bigInteger('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('sg_id')->references('sg_id')->on('supplier_groups')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('supplier_groups');
    }
}
