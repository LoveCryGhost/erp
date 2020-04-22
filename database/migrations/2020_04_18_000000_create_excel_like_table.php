<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcelLikeTable extends Migration
{
    public function up()
    {
        Schema::create('staff_excel_likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_code')->nullable();
            $table->bigInteger('pic')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->boolean('showable')->nullable()->default(1);
            $table->boolean('editable')->nullable()->default(1);
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('jquery')->nullable();
            $table->mediumText('excel_content')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff_excel_likes');
    }
}
