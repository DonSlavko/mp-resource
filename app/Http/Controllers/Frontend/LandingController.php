<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function home() {
        return view('pages.home');
    }

    public function product() {
        return view('pages.product');
    }

    public function eugmp() {
        return view('pages.eu-gmp');
    }

    public function investor() {
        return view('pages.investor');
    }

    public function career() {
        return view('pages.career');
    }

    public function contact() {
        return view('pages.contact');
    }

    public function agb() {
        return view('includes.agb');
    }

    public function dat() {
        return view('includes.datenschutzerklaerung');
    }

    public function imp() {
        return view('includes.impressum');
    }
}
