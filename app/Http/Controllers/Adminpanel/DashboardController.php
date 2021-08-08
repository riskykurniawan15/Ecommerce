<?php

namespace App\Http\Controllers\Adminpanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('adminpanel.pages.dashboard.index');
    }

    public function profile()
    {
        return view('adminpanel.pages.dashboard.profile');
    }

    public function update_profile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100',
            'contact' => 'max:15',
            'gender' => 'required',
        ]);

        User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'gender' => $request->gender
            ]);
        return redirect(url('adminpanel/profile'))->with('status', 'Data berhasil diubah');
    }

    public function change_password()
    {
        return view('adminpanel.pages.dashboard.change_password');
    }

    public function update_change_password(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'same:new_password|required'
        ]);

        if (!(Hash::check($request->old_password, Auth::user()->password))) {
            return redirect()->back()->with("error", "Password lama anda salah. Silahkan Ulangi kembali.");
        } else {
            User::where('id', Auth::user()->id)
                ->update([
                    'password' => Hash::make($request->new_password)
                ]);
            return redirect(url('adminpanel/change_password'))->with('status', 'Data berhasil diubah');
        }
    }
}
