<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Frontend')->group(function () {
    Route::get('/', 'LandingController@home')->name('home');
    Route::get('produkte', 'LandingController@product')->name('product');
    Route::get('eu-gmp', 'LandingController@eugmp')->name('eu-gmp');
    Route::get('investoren', 'LandingController@investor')->name('investor');
    Route::get('karriere', 'LandingController@career')->name('career');
    Route::get('kontakt', 'LandingController@contact')->name('contact');
});

Auth::routes();

Route::namespace('Frontend')->name('user.')->group(function () {
    Route::get('neuigkeiten', 'UserController@news')->name('news');
    Route::get('shop', 'UserController@shop')->name('shop');
    Route::get('vorbestellungen/my-pre-orders', 'UserController@preorder')->name('preorder');
});

Route::namespace('Frontend\Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('produkte', 'ProductController');
    Route::resource('attribut', 'AttributeController');
    Route::resource('variation', 'VariationController');
    Route::resource('benutzer', 'UserController');
    Route::resource('kategorie', 'CategoryController');
});

Route::namespace('Backend')->prefix('back')->name('back.')->group(function () {
    Route::resource('users', 'UserController');
});
