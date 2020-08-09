<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function news() {
        return view('user.news');
    }

    public function shop() {
        return view('user.shop');
    }

    public function product(Product $product) {
        return view('user.product')->with('id', $product->id);
    }

    public function preorder() {
        return view('user.preorder');
    }

    public function cart() {
        return view('user.cart');
    }
}
