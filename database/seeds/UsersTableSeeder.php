<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'contact' => '088812341234',
            'gender' => 'Laki - Laki'
        ]);
        \App\User::create([
            'name' => 'Risky Kurniawan',
            'email' => 'riskykurniawan15@gmail.com',
            'password' => bcrypt('kurniawan'),
            'contact' => '083826114233',
            'gender' => 'Laki - Laki'
        ]);
    }
}
