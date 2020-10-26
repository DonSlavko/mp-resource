<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VariationResource;
use App\Variation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $variations = Variation::all();

        if ($request->has('with_values')) {
            $variations->load('variationValues');
        }

        return response(VariationResource::collection($variations));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            Variation::create($data);

            return response(['Neue Variation wurde hinzugefügt']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Variation $variation)
    {
        $variation = $variation->load('variationValues')->toArray();

        return response(['data' => $variation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variation $variation)
    {
        try {
            $data = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
            ];

            $variation->update($data);

            return response(['Variation wurde aktualisiert']);
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variation $variation)
    {
        $variation->variationValues()->each(function ($var) {
            $var->products()->detach();
        });

        $variation->variationValues()->delete();

        $variation->delete();

        return response(['Variation wurde gelöscht']);
    }
}
