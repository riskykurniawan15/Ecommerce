<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Customer;



class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    public function index()
    {
        return view('home.pages.auth.index');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100|unique:customers',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'contact' => 'max:15|unique:customers',
            'gender' => 'required',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact' => $request->contact,
            'gender' => $request->gender
        ]);

        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(url('/'))->with('status', 'Registration successfully executed');
        }

        return redirect(url('auth'))->with('status', 'Registration successfully executed, please login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
      
        // Attempt to log the user in
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->intended(url('/'))->with('status', 'Login successful');
        }

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->with('error', 'Please recheck your username and password');
    }

    public function logout(Request $request)
    {
        $cart = session()->get('cart');
        Auth::guard('customer')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        session()->put('cart', $cart);

        return redirect('auth');
    }
}
