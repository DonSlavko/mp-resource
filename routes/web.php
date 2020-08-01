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
    return view('pages.home');
})->name('home');
Route::get('produkte', function () {
    return view('pages.product');
})->name('product');
Route::get('eu-gmp', function () {
    return view('pages.eu-gmp');
})->name('eu-gmp');
Route::get('investoren', function () {
    return view('pages.investor');
})->name('investor');
Route::get('karriere', function () {
    return view('pages.career');
})->name('career');
Route::get('kontakt', function () {
    return view('pages.contact');
})->name('contact');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
