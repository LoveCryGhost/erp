<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_departments', function (Blueprint $table) {
            $table->bigIncrements('d_id')->unsigned();
            $table->bigInteger('parent_id')->nullable()->default(0);

            $table->tinyInteger('sort_order')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->string('id_code')->nullable();
            $table->string('processes');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('local')->default('zh-cn');
            $table->timestamps();
        });

        Schema::create('staffs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            //修改者
            $table->bigInteger('pic')->nullable()->unsigned();
            $table->string('staff_code')->nullable();
            $table->string('id_code')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_block')->default(0);

            $table->string('name');
            $table->tinyInteger('sex')->nullable();
            $table->string('identify_code')->nullable()->unique();
            $table->string('avatar')->nullable();

            $table->date('birthday')->nullable(); //生日
            $table->date('interview_at')->nullable(); //面試日期
            $table->date('join_at')->nullable(); //入職日期
            $table->date('social_security_at')->nullable(); //社保
            $table->date('apply_for_leave_at')->nullable(); //申請離職日期
            $table->date('leave_at')->nullable(); //離職日期

            $table->string('email')->unique();  //郵箱

            //聯繫方式
            $table->string('tel1')->nullable();
            $table->string('phone1')->nullable();
            $table->string('address_fix')->nullable();
            $table->string('tel2')->nullable();
            $table->string('phone2')->nullable();
            $table->string('address_current')->nullable();

            $table->string('note')->nullable();
            $table->bigInteger('introduced_by')->nullable()->unsigned();
            $table->bigInteger('interviewed_by')->nullable()->unsigned();

            //聯繫人
            $table->string('contact1')->nullable();
            $table->string('contact_tel1')->nullable();
            $table->string('contact_phone1')->nullable();
            $table->string('contact2')->nullable();
            $table->string('contact_tel2')->nullable();
            $table->string('contact_phone2')->nullable();

            //宿舍
            $table->string('dorm_number')->nullable();
            $table->tinyInteger('level')->default(0)->nullable();

            $table->string('photo_id1')->nullable();
            $table->string('photo_id2')->nullable();
            $table->string('medical_check')->nullable();

            //部門
            $table->bigInteger('d_id')->nullable()->unsigned();

            //education
            $table->date('education1_from')->nullable();
            $table->date('education1_to')->nullable();
            $table->string('education1_level')->nullable();
            $table->string('school1_name')->nullable();

            $table->date('education2_from')->nullable();
            $table->date('education2_to')->nullable();
            $table->string('education2_level')->nullable();
            $table->string('school2_name')->nullable();

            //經歷
            $table->date('experience1_from')->nullable();
            $table->date('experience1_to')->nullable();
            $table->string('company1_name')->nullable();
            $table->integer('salary1')->nullable();

            $table->date('experience2_from')->nullable();
            $table->date('experience2_to')->nullable();
            $table->string('company2_name')->nullable();
            $table->integer('salary2')->nullable();

            $table->string('local')->nullable();
            $table->foreign('d_id')->references('d_id')->on('staff_departments')->onDelete('cascade');
            $table->foreign('pic')->references('id')->on('staffs')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('staffs_departments', function (Blueprint $table) {
            $table->bigIncrements('sd_id')->unsigned();
            $table->bigInteger('d_id')->unsigned();
            $table->bigInteger('st_id')->unsigned();
            $table->date('start_at')->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('modified_by')->unsigned();
            $table->integer('bonus')->nullable();
            $table->text('note')->nullable();

            $table->foreign('modified_by')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('staffs')->onDelete('cascade');

            $table->foreign('st_id')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('d_id')->references('d_id')->on('staff_departments')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('staff_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip');
            $table->timestamp('login_at');
            $table->bigInteger('staff_id')->unsigned();

            $table->string('address')->nullable(); // zhuzhichao/ip-location-zh 包含的方法獲取ip地理位置
            $table->string('browser')->nullable();
            $table->string('platform')->nullable(); //作業系統

            // jenssegers/agent 的方法來提取agent資訊
            $table->string('device')->nullable(); //裝置名稱
            $table->string('device_type')->nullable(); //裝置型別
            $table->string('language')->nullable(); //裝置型別


            $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('cascade');
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
        Schema::dropIfExists('staff_logs');
        Schema::dropIfExists('staffs_departments');
        Schema::dropIfExists('staffs');
        Schema::dropIfExists('staff_departments');

    }
}
