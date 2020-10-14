<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;
use App\VariationValue;
use Illuminate\Http\Request;

class VariationValueController extends Controller
{
    public function index() {
        return view('admin.variation_values.index');
    }

    public function show(VariationValue $variation_value) {
        return view('admin.variation_values.show')->with(['id' => $variation_value->id]);
    }
}
