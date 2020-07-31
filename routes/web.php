<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('produkte', function () {
    return view('pages.product');
})->name('product');
Route::get('eu-gmp', function () {
    return view('pages.eu-gmp');
})->name('eu-gmp');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::name('user.')->group(function () {
    Route::get('neuigkeiten', function () {
        return view('user.news');
    })->name('news');
    Route::get('shop', function () {
        return view('user.shop');
    })->name('shop');
    Route::get('vorbestellungen/my-pre-orders/', function () {
        return view('user.preorder');
    })->name('preorder');
});
