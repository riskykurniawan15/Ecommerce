<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->increments('ID_DETAIL_TRANSACTIONS');
            $table->integer('ID_TRANSACTIONS')->unsigned();
            $table->foreign('ID_TRANSACTIONS')->references('ID_TRANSACTIONS')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ID_ITEMS')->unsigned();            
            $table->foreign('ID_ITEMS')->references('ID_ITEMS')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('PRICE_ITEMS_TRANSACTIONS');
            $table->integer('QUANTITY_ITEM_DETAIL_TRANSACTIONS');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transactions');
    }
}
