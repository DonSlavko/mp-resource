<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function news() {
        return view('user.news');
    }

    public function shop() {
        return view('user.shop');
    }

    public function preorder() {
        return view('user.preorder');
    }
}
