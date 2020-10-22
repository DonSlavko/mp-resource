<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\InitialNewsletter;
use App\Newsletter;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            'email' => 'required|email'
        ]);

        $email = $request->get('email');

        if ($userExists = Newsletter::where('email', $email)->first()) {
            $userExists->delete();

            return redirect()->back();
        }

        $newsletter = Newsletter::create([
            'email' => $request->email
        ]);

        Mail::to($newsletter->email)->send(new InitialNewsletter('Your are Added to Newsletter Subscription'));

        return redirect()->back();
    }
}
