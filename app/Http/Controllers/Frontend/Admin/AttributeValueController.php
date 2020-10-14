<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\AttributeValue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function index() {
        return view('admin.attribute_values.index');
    }

    public function show(AttributeValue $attribute_value) {
        return view('admin.attribute_values.show')->with(['id' => $attribute_value->id]);
    }
}
