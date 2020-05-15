<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->date('date');
            $table->string('stock_code'); //0
            $table->string('name'); //1
            $table->bigInteger('volume')->default(0); //2
            $table->bigInteger('records')->default(0); //3
            $table->decimal('amount',15,2)->default(0); //4

            $table->decimal('price_start',10,2)->default(0);
            $table->decimal('price_top',10,2)->default(0);
            $table->decimal('price_low',10,2,2)->default(0);
            $table->decimal('price_close',10,2)->default(0);

            $table->decimal('last_bid_buy_price',10,2)->default(0);
            $table->bigInteger('last_bid_buy_records')->default(0);
            $table->decimal('last_bid_sell_price',10,2)->default(0);
            $table->bigInteger('last_bid_sell_records')->default(0);

            $table->string('type')->default('stock');
            $table->string('local')->default('tw');
            $table->primary(['date', 'stock_code','type','local']);

            $table->timestamp('updated_at')->useCurrent()->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
