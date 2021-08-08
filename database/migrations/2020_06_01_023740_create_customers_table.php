<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            // $table->increments('ID_CUSTOMERS');
            // $table->string('NAME_CUSTOMERS', 100);
            // $table->string('EMAIL_CUSTOMERS', 100)->unique();
            // $table->timestamp('EMAIL_VERIFIED_AT_CUSTOMERS')->nullable();
            // $table->string('PASSWORD_CUSTOMERS', 100);
            // $table->string('CONTACT_CUSTOMERS', 20)->unique();
            // $table->enum('GENDER_CUSTOMERS', ['Laki - Laki', 'Perempuan']);
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);
            $table->string('contact', 15)->unique();
            $table->enum('gender', ['Laki - Laki', 'Perempuan']);
            $table->rememberToken();
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
        Schema::dropIfExists('customers');
    }
}
