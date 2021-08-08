<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Dotenv\Regex\Result;

class RajaOngkirController extends Controller
{

    public function provinsi($id = '')
    {
        if ($id != '') {
            $id = "?id=" . $id;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . DB::table('configs')->where('NAME_CONFIG', 'API_RAJA_ONGKIR')->pluck('VALUE')->first()
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $data['rajaongkir'];
        }
    }

    public function city($province = '', $id = '')
    {
        if ($id != '') {
            $id = "&id=" . $id;
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $province . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . DB::table('configs')->where('NAME_CONFIG', 'API_RAJA_ONGKIR')->pluck('VALUE')->first()
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $data['rajaongkir'];
        }
    }

    public function cost($destination = '', $weight = '', $courier = '')
    {
        $curl = curl_init();

        $origin = DB::table('configs')->where('NAME_CONFIG', 'ORIGIN')->pluck('VALUE')->first();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier . "",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . DB::table('configs')->where('NAME_CONFIG', 'API_RAJA_ONGKIR')->pluck('VALUE')->first()
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $data['rajaongkir'];
        }
    }

}
