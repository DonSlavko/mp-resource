<?php

namespace App\Http\Controllers\Backend;

use App\Attribute;
use App\AttributeValue;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()
            ->load(['variation', 'attributes', 'attributeValues', 'category'])
            ->map(function($prod) {
                $prod->attribute = [
                    'ids' => $prod->attributes->pluck('id'),
                    'values' => $prod->attributeValues->pluck('id'),
                ];
                $prod->stock = $prod->stock_quantity;

                return $prod;
            })
            ->toArray();

        return response(['data' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->get('attribute');

        $images = $request->file('images');
        $brochure = $request->file('brochure');
        $analysis = $request->file('analysis');

        $data = [
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'description' => $request->get('description'),
            'variation_id' => $request->get('variation_id'),
            'price' => $request->get('price'),
            'stock_quantity' => $request->get('stock'),
            'sku' => $request->get('sku'),
        ];

        $product = Product::create($data);

        $product->attributes()->attach($attributes['ids']);
        $product->attributeValues()->attach($attributes['values']);

        if ($brochure) {
            $product->addMedia($brochure->path())
                ->setFileName($brochure->getClientOriginalName())
                ->toMediaCollection('brochure');
        }

        if ($analysis) {
            $product->addMedia($analysis->path())
                ->setFileName($analysis->getClientOriginalName())
                ->toMediaCollection('analysis');
        }

        if ($images) {
            foreach ($images as $image)
            $product->addMedia($image->path())
                ->setFileName($image->getClientOriginalName())
                ->toMediaCollection('images');
        }

        return response('Product created');
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
    public function update(Request $request, Product $product)
    {

        $attributes = $request->get('attribute');

        $data = [
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'description' => $request->get('description'),
            'variation_id' => $request->get('variation_id'),
            'price' => $request->get('price'),
            'stock_quantity' => $request->get('stock'),
            'sku' => $request->get('sku'),
        ];

        $product->update($data);

        $product->attributes()->detach($product->attributes->pluck('id'));
        $product->attributeValues()->detach($product->attributeValues->pluck('id'));

        $product->attributes()->attach($attributes['ids']);
        $product->attributeValues()->attach($attributes['values']);

        return response('Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->attributes()->detach($product->attributes->pluck('id'));
        $product->attributeValues()->detach($product->attributeValues->pluck('id'));

        $product->delete();

        return response('Product deleted');
    }
}
