<?php

namespace App\Http\Controllers\Adminpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Config;
use File;

class ConfigsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $city = app('App\Http\Controllers\Home\RajaOngkirController')->city();
        return view('adminpanel.pages.configs.index', compact('city'));
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'BRAND_ECOMMERCE' => 'required|max:20',
            'DESCRIPTION' => 'required|max:300',
            'EMAIL' => 'required|max:50',
            'CONTACT' => 'numeric|required',
            'ADDRESS' => 'required|max:200',
            'INSTAGRAM' => 'required|max:20',
            'FACEBOOK' => 'required|max:20',
            'NOREK' => 'required|numeric',
            'NAME_NOREK' => 'required|max:100',
            'BANK' => 'required|max:100',
            'API_RAJA_ONGKIR' => 'required|max:50',
            'ORIGIN' => 'required|numeric'
        ]);

        $notif = "";
        if ($request->LOGO != "") {
            $validatedData = $request->validate([
                'LOGO' => 'mimes:jpeg,png,jpg'
            ]);

            $logo = DB::table('configs')->where('NAME_CONFIG', 'LOGO')->pluck('VALUE')->first();

            $file = $request->file('LOGO');

            $namafile = md5(crypt($file->getClientOriginalName() . 'LOGO', Hash::make(now()))) . '.' . $file->getClientOriginalExtension();
            
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'assets/img/logo/';

            // upload file
            if ($file->move($tujuan_upload, $namafile)) {
                if ($logo != "") {
                    File::delete($tujuan_upload . $logo);
                }

                Config::where('NAME_CONFIG', 'LOGO')
                    ->update([
                        'VALUE' => $namafile
                    ]);
                $notif .= "Logo berhasil diubah, ";
            } else {
                $notif .= "Logo gagal diubah, ";
            }

        }

        if ($request->ICON != "") {
            $validatedData = $request->validate([
                'ICON' => 'mimes:jpeg,png,jpg'
            ]);

            $icon = DB::table('configs')->where('NAME_CONFIG', 'ICON')->pluck('VALUE')->first();

            $file = $request->file('ICON');

            $namafile = md5(crypt($file->getClientOriginalName() . 'ICON', Hash::make(now()))) . '.' . $file->getClientOriginalExtension();
            
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'assets/img/icon/';

            // upload file
            if ($file->move($tujuan_upload, $namafile)) {
                if ($icon != "") {
                    File::delete($tujuan_upload . $icon);
                }

                Config::where('NAME_CONFIG', 'ICON')
                    ->update([
                        'VALUE' => $namafile
                    ]);
                $notif .= "Icon berhasil diubah, ";
            } else {
                $notif .= "Icon gagal diubah, ";
            }

        }

        foreach (Config::where('type', 'text')->get() as $config) {
            Config::where('NAME_CONFIG', $config->NAME_CONFIG)
                ->update([
                    'VALUE' => $_POST[$config->NAME_CONFIG]
                ]);
        }

        $notif .= 'Data berhasil diubah';
        return redirect(url('adminpanel/configs'))->with('status', $notif);
    }
}
