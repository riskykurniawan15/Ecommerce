<?php

namespace App\Http\Controllers\Adminpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
      
        // Attempt to log the user in
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->intended(url('adminpanel'))->with('status', 'Login successful');
        }

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->with('error', 'Please recheck your username and password');
    }

    public function logout(Request $request)
    {
        $cart = session()->get('cart');
        Auth::guard('user')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        session()->put('cart', $cart);

        return redirect('adminpanel/login');
    }
}
