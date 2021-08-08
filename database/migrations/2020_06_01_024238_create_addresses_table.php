<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('ID_ADDRESSES');
            $table->integer('ID_CUSTOMERS')->unsigned();
            $table->foreign('ID_CUSTOMERS')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->string('PROVINCE_ADDRESSES', 100);
            $table->string('DISTRICTS_ADDRESSES', 100);
            $table->text('FULL_ADDRESSES');
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
        Schema::dropIfExists('addresses');
    }
}
