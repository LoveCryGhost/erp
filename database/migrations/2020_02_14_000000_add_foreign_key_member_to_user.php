<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyMemberToUser extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->BigInteger('member_id')->unsigned()->nullable();
            $table->foreign('member_id')->references('id')->on('members');

        });
    }

    public function down()
    {
        Schema::dropIfExists('user_logs');
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_member_id_foreign');
        });
    }
}
