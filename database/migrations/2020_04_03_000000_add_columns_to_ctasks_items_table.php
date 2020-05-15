<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCtasksItemsTable extends Migration
{
    public function up()
    {
        Schema::table('ctasks_items', function (Blueprint $table) {
            $table->boolean('is_active')->default(1);
        });
    }

    public function down()
    {
        Schema::table('ctasks_items', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
