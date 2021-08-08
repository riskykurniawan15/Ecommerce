<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('ID_ITEMS');
            $table->string('CODE_ITEMS', 50)->unique();
            $table->string('NAME_ITEMS', 100);
            $table->string('HEAD_PICTURE_ITEMS', 100);
            $table->integer('PURCHASE_PRICE_ITEMS');
            $table->integer('SELLING_PRICE_ITEMS');
            $table->integer('WEIGHT_ITEMS');
            $table->text('DESCRIPTION_ITEMS');
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
        Schema::dropIfExists('items');
    }
}
