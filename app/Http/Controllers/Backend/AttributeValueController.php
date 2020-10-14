<?php

namespace App\Http\Controllers\Backend;

use App\Attribute;
use App\AttributeValue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{

    public function index() {
        $attribute_value = AttributeValue::all()->load('attribute')->toArray();
        $attribute = Attribute::all();
        return response([
            'data' => $attribute_value,
            'data2' => $attribute,
        ]);
    }

    public function store(Request $request) {
        try {
            $data = $request->all();

            AttributeValue::create($data);

            return response(['Value created']);
        } catch (\Exception $exception) {
            return response(['message' => 'There was an error. Please try again later'], 500);
        }
    }


    public function update(Request $request, AttributeValue $attributeValue) {
        try {
            $data = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'attribute_id' => $request->get('attribute_id')
            ];

            $attributeValue->update($data);

            return response(['Value updated']);
        } catch (\Exception $exception) {
            return response(['message' => 'There was an error. Please try again later'], 500);
        }
    }

    public function destroy(AttributeValue $attributeValue) {
        try {
            $attributeValue->delete();

            return response(['Value delete']);
        } catch (\Exception $exception) {
            return response(['message' => 'There was an error. Please try again later'], 500);
        }
    }
}
