<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Config::create([
            'NAME_CONFIG' => 'BRAND_ECOMMERCE',
            'TYPE' => 'text',
            'VALUE' => 'Risoftinc'
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'DESCRIPTION',
            'TYPE' => 'text',
            'VALUE' => 'Aplikasi ini dibuat untuk memenuhi salah satu tugas matakuliah Pemrograman Web 3 Dibuat oleh Risky Kurniawan, dengan framework Laravel dan template adminlte(adminpanel) dan theme Wpthemesgrid untuk home (16180001 Risky Kurniawan)'
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'EMAIL',
            'TYPE' => 'text',
            'VALUE' => 'riskykurniawan@programmer.net'
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'CONTACT',
            'TYPE' => 'text',
            'VALUE' => '083826114233'
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'ADDRESS',
            'TYPE' => 'text',
            'VALUE' => 'Dsn Purwasari - 04/08 Ds Parigi. Kec Parigi. Kab Pangandaran 46393'
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'INSTAGRAM',
            'TYPE' => 'text',
            'VALUE' => 'risky_kurniawanz'
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'FACEBOOK',
            'TYPE' => 'text',
            'VALUE' => 'riskykurniawan503'
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'NOREK',
            'TYPE' => 'text',
            'VALUE' => '403201015822537'
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'NAME_NOREK',
            'TYPE' => 'text',
            'VALUE' => 'Risky Kurniawan'
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'BANK',
            'TYPE' => 'text',
            'VALUE' => 'Bank Rakyat Indonesia/BRI'
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'ORIGIN',
            'TYPE' => 'text',
            'VALUE' => '332'
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'API_RAJA_ONGKIR',
            'TYPE' => 'text',
            'VALUE' => '8d46804d1410013b2f0c79a21a202dbe'
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'LOGO',
            'TYPE' => 'file',
            'VALUE' => ''
        ]);

        \App\Config::create([
            'NAME_CONFIG' => 'ICON',
            'TYPE' => 'file',
            'VALUE' => ''
        ]);

    }
}
