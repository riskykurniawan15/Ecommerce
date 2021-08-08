<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('ID_TRANSACTIONS');
            $table->integer('ID_CUSTOMERS')->unsigned();
            $table->foreign('ID_CUSTOMERS')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ID_USERS')->unsigned()->nullable();
            $table->foreign('ID_USERS')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('CODE_TRANSACTIONS', 50)->unique();
            $table->string('RECIPIENT_TRANSACTIONS', 100);
            $table->string('CONTACT_RECIPIENT_TRANSACTIONS', 100);
            $table->text('SHIPPING_ADDRESS_TRANSACTIONS');
            $table->integer('SHIPPING_COSTS_TRANSACTIONS');
            $table->string('COURIER_TRANSACTIONS', 50);
            $table->string('PROOF_OF_PAYMENT_TRANSACTIONS', 100);
            $table->string('STATUS_TRANSACTIONS', 100);
            $table->string('RECEIPT_CODE_TRANSACTIONS', 100);
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
        Schema::dropIfExists('transactions');
    }
}
