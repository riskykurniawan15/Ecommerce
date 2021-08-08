<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Customer;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function index()
    {
        return view('home.pages.account.index');
    }

    public function update_profile(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100',
            'contact' => 'required|max:15',
            'gender' => 'required',
        ]);

        if (Auth::guard('customer')->user()->email != $request->email) {
            $validatedData = $request->validate([
                'email' => 'required|max:100|unique:customers',
            ]);
        }

        if (Auth::guard('customer')->user()->contact != $request->contact) {
            $validatedData = $request->validate([
                'contact' => 'required|max:15|unique:customers',
            ]);
        }

        Customer::where('id', Auth::guard('customer')->user()->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'contact' => $request->contact,
                'gender' => $request->gender
            ]);

        return redirect(url('account'))->with('status', 'Success Update');
    }

    public function password()
    {
        return view('home.pages.account.change_password');
    }

    public function update_password(Request $request)
    {
        $validatedData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'same:new_password|required'
        ]);

        if (!(Hash::check($request->old_password, Auth::guard('customer')->user()->password))) {
            return redirect()->back()->with("error", "Password lama anda salah. Silahkan Ulangi kembali.");
        } else {
            Customer::where('id', Auth::guard('customer')->user()->id)
                ->update([
                    'password' => Hash::make($request->new_password)
                ]);
            return redirect(url('account/password'))->with('status', 'Password Success Update');
        }
    }
}
