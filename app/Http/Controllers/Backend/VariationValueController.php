<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Variation;
use App\VariationValue;
use Illuminate\Http\Request;

class VariationValueController extends Controller
{

    public function index() {
        $variation_value = VariationValue::all()->load('variation')->toArray();
        $variation = Variation::all();
        return response([
            'data' => $variation_value,
            'data2' => $variation,
        ]);
    }


    public function store(Request $request) {
        try {
            $data = $request->all();

            VariationValue::create($data);

            return response(['Neuer Variationswert wurde hinzugefügt']);
        } catch (\Exception $exception) {
            return response(['message' => 'There has been an error. Please try again later'], 500);
        }
    }


    public function update(Request $request, VariationValue $variationValue) {
        try {
            $data = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'variation_id' => $request->get('variation_id')
            ];

            $variationValue->update($data);

            return response(['Variationswert wurde aktualisiert']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }


    public function destroy(VariationValue $variationValue) {
        try {
            $variationValue->products()->detach();
            $variationValue->delete();

            return response(['Variationswert wurde gelöscht']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }
}
