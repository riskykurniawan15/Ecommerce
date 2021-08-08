<?php

namespace App\Http\Controllers\Adminpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = Customer::all();
        return view('adminpanel.pages.customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        return view('adminpanel.pages.customers.show', compact('customer'));
    }
}
