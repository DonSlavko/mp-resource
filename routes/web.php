<?php

use Illuminate\Support\Facades\Route;
Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');

Route::get('/home', function () {
    return view('pages.home');
});

Route::get('/agb', function () {
    return view('includes.agb');
});
Route::get('/datenschutzerklaerung', function () {
    return view('includes.datenschutzerklaerung');
});
Route::get('/impressum', function () {
    return view('includes.impressum');
});

Route::namespace('Frontend')->group(function () {
    //Route::get('/', 'LandingController@home')->name('home');
    Route::get('produkte', 'LandingController@product')->name('product');
    Route::get('eu-gmp', 'LandingController@eugmp')->name('eu-gmp');
    Route::get('investoren', 'LandingController@investor')->name('investor');
    Route::get('karriere', 'LandingController@career')->name('career');
    Route::get('kontakt', 'LandingController@contact')->name('contact');
});

Auth::routes(['verify' => true]);

//Route::middleware(['auth','verified'])->group(function () {

    Route::namespace('Frontend')->name('user.')->group(function () {
        Route::get('neuigkeiten', 'UserController@news')->name('news');
        Route::get('shop', 'UserController@shop')->name('shop');
        Route::get('shop/product/{product}', 'UserController@product')->name('shop.product');
        Route::get('vorbestellungen/my-pre-orders', 'UserController@preorder')->name('preorder');
    });

    Route::namespace('Frontend\Admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('product', 'ProductController');
        Route::resource('attribute', 'AttributeController');
        Route::resource('variation', 'VariationController');
        Route::resource('user', 'UserController');
        Route::resource('category', 'CategoryController');
    });

Route::namespace('Backend')->prefix('back')->name('back.')->group(function () {
    Route::resource('users', 'UserController');
    Route::resource('categories', 'CategoryController');
    Route::resource('variations', 'VariationController');
    Route::resource('variation-values', 'VariationValueController');
    Route::resource('attributes', 'AttributeController');
    Route::resource('attribute-values', 'AttributeValueController');
    Route::resource('products', 'ProductController');
    Route::get('shop', 'ShopController@index');
    Route::get('shop/{product}', 'ShopController@show');
    Route::post('users/{user}/activate', 'UserController@activate');
    Route::post('users/{user}/deactivate', 'UserController@deactivate');
});


//});
