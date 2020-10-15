<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Newsletter;
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
        $product_id = $product->id;
        return view('user.product')->with(['product_id' => $product_id]);
    }

    public function preorder() {
        return view('user.preorder');
    }

    public function cart() {
        return view('user.cart');
    }

    public function add_to_newsletter(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users,email'
        ]);
        $newsletter = Newsletter::create([
            'email' => $request->email
        ]);
        // todo - change to default laravel mailer
        /*sendMail([
            'view' => 'email.initial_newsletter',
            'to' => $newsletter->email,
            'subject' => 'Your are Added to Newsletter Subscription',
            'data' => []
        ]);*/
        return redirect()->back();
    }
}
