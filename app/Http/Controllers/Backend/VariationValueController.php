<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\VariationValue;
use Illuminate\Http\Request;

class VariationValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        VariationValue::create($data);

        return response(['Value created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VariationValue $variationValue)
    {
        $data = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ];

        $variationValue->update($data);

        return response(['Value updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(VariationValue $variationValue)
    {
        $variationValue->delete();

        return response(['Value delete']);
    }
}
