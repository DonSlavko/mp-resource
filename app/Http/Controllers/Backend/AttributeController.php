<?php

namespace App\Http\Controllers\Backend;

use App\Attribute;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AttributeResource;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class AttributeController extends Controller
{

    public function index(Request $request) {
        $attribute = Attribute::all();

        if ($request->has('with_values')) {
            $attribute->load('attributeValues');
        }

        return response(AttributeResource::collection($attribute));
    }


    public function store(Request $request) {
        try {
            $data = $request->all();

            Attribute::create($data);

            return response(['Neue Eigenschaft wurde hinzugefügt']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }


    public function show(Attribute $attribute) {
        $attribute = $attribute->load('attributeValues')->toArray();

        return response(['data' => $attribute]);
    }


    public function update(Request $request, Attribute $attribute) {
        try {
            $data = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
            ];

            $attribute->update($data);

            return response(['Eigenschaft wurde aktualisiert']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }


    public function destroy(Attribute $attribute) {
        try {
            $attribute->attributeValues()->each(function ($var) {
                $var->products()->detach();
            });

            $attribute->attributeValues()->delete();

            $attribute->delete();

            return response(['Eigenschaft wurde gelöscht']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }
}
