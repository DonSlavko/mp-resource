<?php

namespace App\Http\Controllers\Backend;

use App\AttributeValue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
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
        try {
            $data = $request->all();

            AttributeValue::create($data);

            return response(['Value created']);
        } catch (\Exception $exception) {
            return response(['message' => 'There was an error. Please try again later'], 500);
        }
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
    public function update(Request $request, AttributeValue $attributeValue)
    {
        try {
            $data = [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
            ];

            $attributeValue->update($data);

            return response(['Value updated']);
        } catch (\Exception $exception) {
            return response(['message' => 'There was an error. Please try again later'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeValue $attributeValue)
    {
        try {
            $attributeValue->delete();

            return response(['Value delete']);
        } catch (\Exception $exception) {
            return response(['message' => 'There was an error. Please try again later'], 500);
        }
    }
}
