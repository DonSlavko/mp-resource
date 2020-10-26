<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{

    public function index() {
        $brand = Brand::all();

        return response(['data' => $brand]);
    }


    public function store(Request $request) {
        try {
            $data = $request->all();

            Brand::create($data);

            return response(['Neue Marke wurde hinzugefügt']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }


    // public function show(Brand $brand)
    // {
    //     $attribute = $brand->load('attributeValues')->toArray();

    //     return response(['data' => $attribute]);
    // }


    public function update(Request $request, Brand $brand) {
        try {
            $data = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
            ];

            $brand->update($data);

            return response(['Marke wurde aktualisiert']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }


    public function destroy(Brand $brand) {
        try {
            $brand->delete();

            return response(['Marke wurde gelöscht']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }
}
