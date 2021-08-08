<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::middleware('cache.headers:public;max_age=2628000;etag')->group(function () {

    Route::prefix('adminpanel')->group(function () {    
    // auth adminpanel
        Route::get('login', 'Adminpanel\LoginController@index');
        Route::post('login', 'Auth\LoginController@login')->name('adminpanel/login');
        Route::get('logout', 'Adminpanel\LoginController@logout')->name('adminpanel/logout');

    // dahsboard adminpanel
        Route::get('/', 'Adminpanel\DashboardController@index');
        Route::get('profile', 'Adminpanel\DashboardController@profile');
        Route::patch('profile', 'Adminpanel\DashboardController@update_profile');
        Route::get('change_password', 'Adminpanel\DashboardController@change_password');
        Route::patch('change_password', 'Adminpanel\DashboardController@update_change_password');

    // user adminpanel
        Route::resource('users', 'Adminpanel\UsersController');
        Route::get('users/{user}/change_password', 'Adminpanel\UsersController@change_password');
        Route::patch('users/{user}/change_password', 'Adminpanel\UsersController@update_change_password');

    // user adminpanel
        Route::get('customers', 'Adminpanel\CustomerController@index');
        Route::get('customers/{customer}/show', 'Adminpanel\CustomerController@show');

    // item adminpanel
        Route::resource('items', 'Adminpanel\ItemsController');
        Route::patch('items/{item}/upload', 'Adminpanel\ItemsController@upload');
        Route::delete('items/{item_image}/drop', 'Adminpanel\ItemsController@drop');

    // transaction adminpanel
        Route::get('transactions', 'Adminpanel\TransactionsController@index');
        Route::get('transactions/{fill}', 'Adminpanel\TransactionsController@index');
        Route::get('transactions/{transaction}/show', 'Adminpanel\TransactionsController@show');
        Route::post('transactions/{transaction}/show', 'Adminpanel\TransactionsController@save');

        Route::get('configs', 'Adminpanel\ConfigsController@index');
        Route::post('configs', 'Adminpanel\ConfigsController@save');
    });



// home
    Route::get('/', 'Home\HomeController@index');
    Route::get('home', 'Home\HomeController@index');

// auth home
    Route::get('auth', 'Home\LoginController@index')->name('auth');
    Route::post('auth', 'Home\LoginController@login')->name('auth.login.submit');
    Route::patch('auth', 'Home\LoginController@register');
    Route::get('auth/logout', 'Home\LoginController@logout');

// account home
    Route::get('account', 'Home\AccountController@index');
    Route::post('account', 'Home\AccountController@update_profile');
    Route::get('account/password', 'Home\AccountController@password');
    Route::post('account/password', 'Home\AccountController@update_password');

// cart home
    Route::get('cart', 'Home\CartController@index');
    Route::get('addcart/{id}', 'Home\CartController@addcart');
    Route::post('addcart/{id}', 'Home\CartController@formaddcart');
    Route::post('cart/update', 'Home\CartController@updatecart');
    Route::post('dropcart', 'Home\CartController@dropcart');

//checkout
    Route::get('checkout', 'Home\CheckoutController@index');
    Route::post('checkout', 'Home\CheckoutController@proceed');
    Route::post('checkout/city', 'Home\CheckoutController@city');
    Route::post('checkout/cost', 'Home\CheckoutController@cost');
    Route::post('checkout/cost/get', 'Home\CheckoutController@shippingcost');

// transaction
    Route::get('transaction', 'Home\TransactionController@index');
    Route::get('transaction/{fill}', 'Home\TransactionController@index');
    Route::get('transaction/{transaction}/{code}', 'Home\TransactionController@detail');
    Route::post('transaction/{transaction}/{code}', 'Home\TransactionController@save');
});

Route::get('sitemap.xml', function () {
    return response(view('sitemap'))->withHeaders([
        'Content-Type' => 'text/xml'
    ]);
});