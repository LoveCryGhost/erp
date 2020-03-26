<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_code')->unique()->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('introduction')->nullable();
            $table->bigInteger('admin_id')->nullable()->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('member_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip');
            $table->timestamp('login_at');
            $table->bigInteger('member_id')->unsigned();

            $table->string('address')->nullable(); // zhuzhichao/ip-location-zh 包含的方法獲取ip地理位置
            $table->string('browser')->nullable();
            $table->string('platform')->nullable(); //作業系統

            // jenssegers/agent 的方法來提取agent資訊
            $table->string('device')->nullable(); //裝置名稱
            $table->string('device_type')->nullable(); //裝置型別
            $table->string('language')->nullable(); //裝置型別


            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
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

        Schema::dropIfExists('member_logs');
        Schema::dropIfExists('members');
    }
}
