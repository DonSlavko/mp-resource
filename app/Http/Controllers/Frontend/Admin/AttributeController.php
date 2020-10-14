<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Attribute;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributeController extends Controller
{

    public function index() {
        return view('admin.attribute.index');
    }


    public function create() {
        //
    }


    public function store(Request $request) {
        //
    }


    public function show(Attribute $attribute) {
        return view('admin.attribute.show')->with(['id' => $attribute->id]);
    }


    public function edit($id) {
        //
    }


    public function update(Request $request, $id) {
        //
    }


    public function destroy($id) {
        //
    }
}
