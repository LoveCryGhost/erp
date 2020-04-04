<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->string('introduction')->nullable();
            $table->string('id_code')->unique()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('user_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip');
            $table->timestamp('login_at');
            $table->bigInteger('user_id')->unsigned();

            $table->string('address')->nullable(); // zhuzhichao/ip-location-zh 包含的方法獲取ip地理位置
            $table->string('browser')->nullable();
            $table->string('platform')->nullable(); //作業系統

            // jenssegers/agent 的方法來提取agent資訊
            $table->string('device')->nullable(); //裝置名稱
            $table->string('device_type')->nullable(); //裝置型別
            $table->string('language')->nullable(); //裝置型別


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {

        Schema::dropIfExists('user_logs');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('avatar');
            $table->dropColumn('birthday');
            $table->dropColumn('introduction');
        });


    }
}
