<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrawlerCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('crawler_categories', function (Blueprint $table) {
            $table->integer('catid')->primary();
            $table->string('p_id')->nullable()->default(0);
            $table->string('display_name')->nullable();
            $table->string('image')->nullable();
            $table->string('locale')->default('tw');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crawler_categories');
    }
}
