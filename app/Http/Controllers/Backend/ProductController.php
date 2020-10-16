<?php

namespace App\Http\Controllers\Backend;

use App\Attribute;
use App\AttributeValue;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImages;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // todo change this to resource
        $products = Product::all()
            ->load(['variation', 'variationValues', 'attributes', 'attributeValues', 'brand', 'category'])
            ->map(function ($prod) {

                $attrIds = $prod->attributes->pluck('id');
                $valIds = $prod->attributeValues->pluck('id');
                $attributes = [];

                foreach ($valIds as $key => $value) {
                    $attributes[$attrIds[$key]] = $value;
                }

                $prod->attributes_values = $attributes;

                $prod->stock = $prod->variationValues()->sum('quantity');

                $varIds = $prod->variationValues->pluck('id');
                $quantities = $prod->variationValues()->pluck('quantity');
                $prices = $prod->variationValues()->pluck('price');

                $variations_values = [];

                foreach ($quantities as $key => $quantity) {
                    $variations_values['quantity'][$varIds[$key]] = "$quantity";
                }
                foreach ($prices as $key => $price) {
                    $variations_values['price'][$varIds[$key]] = "$price";
                }

                $prod->variations_values = $variations_values;

                return $prod;
            })->map(function ($prod) {
                $prod->variation = optional($prod->variation()->first())->id;
                $prod->product_variations = [
                    'ids' => $prod->variationValues->pluck('id'),
                    'values' => $prod->variationValues->pluck('id'),
                    'stocks' => $prod->variationValues()->pluck('quantity'),
                    'prices' => $prod->variationValues()->pluck('price'),
                    'variation_name' => $prod->variationValues->pluck('name'),
                ];
                return $prod;
            })->toArray();
        return response(['data' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // todo change this

        $brochure = $request->file('brochure');
        if ($brochure) {
            $name = time() . '_' . $brochure->getClientOriginalName();
            $path = 'images/multiple-images' . $name;
            $brochure->move('images/multiple-images', $name);
        }

        if ($analysis = $request->file('analysis')) {
            $analysis_name = time() . '_' . $analysis->getClientOriginalName();
            $analysis_name_path = 'images/multiple-images' . $analysis_name;
            $analysis->move('images/multiple-images', $analysis_name);
        }

        $product = Product::create([
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'description' => $request->get('description'),
            'brand_id' => $request->get('brand_id'),
            'sku' => $request->get('sku'),
            'expires' => $request->get('expires'),
            'charge' => $request->get('charge'),
            'brochure' => $name ?? null,
            'analysis' => $analysis_name ?? null,
        ]);

        foreach ($request->file('images') as $image) {
            $name = time() . '_' . $image->getClientOriginalName();
            $path = 'images/multiple-images' . $name;
            $image->move('images/multiple-images', $name);
            $product_images = ProductImages::create([
                'product_id' => $product->id,
                'path' => $name
            ]);
        }

        $variations = $request->get('variations');
        $variation = $request->get('variation');
        $attributes = $request->get('attributes');

        foreach ($attributes as $key => $attribute) {
            $attributeIds[] = $key;
            $attributeValuesIds[] = $attribute;
        }

        $i = 0;
        foreach ($variations as $key => $variation) {
            $variationValuesIds[$i]['variation_value_id'] = $key;
            $variationValuesIds[$i]['price'] = $variation['price'];
            $variationValuesIds[$i]['quantity'] = $variation['quantity'];
            $i++;
        }

        $product->attributes()->attach($attributeIds);
        $product->attributeValues()->attach($attributeValuesIds);

        $product->variation()->attach($variation);
        $product->variationValues()->attach($variationValuesIds);

        return response('Product created');
    }

    public function update(Request $request, $id) {
        try {
            // dd($request->all());
            $product = Product::find($id);
            $attributes = $request->get('attribute');
            $variation = $request->get('variation');

            if ($request->hasFile('brochure')) {
                $brochure = $request->file('brochure');
                $name = time() . '_' . $brochure->getClientOriginalName();
                $path = 'images/multiple-images' . $name;
                $brochure->move('images/multiple-images', $name);
                $product->where('name', '=', 'brochure')->update([
                    'brochure' => $name,
                ]);
            }

            if ($request->hasFile('analysis')) {
                $analysis = $request->file('analysis');
                $analysis_name = time() . '_' . $analysis->getClientOriginalName();
                $analysis_name_path = 'images/multiple-images' . $analysis_name;
                $analysis->move('images/multiple-images', $analysis_name);
                $product->where('name', '=', 'analysis')->update([
                    'analysis' => $analysis_name,
                ]);
            }

            $data = [
                'name' => $request->get('name'),
                'category_id' => $request->get('category_id'),
                'description' => $request->get('description'),
                'price' => $request->get('price'),
                'sku' => $request->get('sku'),
                'brand_id' => $request->get('brand_id'),
                //'brochure' =>  $name,
                //'analysis' => $analysis_name,
            ];
            $product->update($data);

            if ($request->hasFile('analysis')) {
                foreach ($request->file('images') as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $path = 'images/multiple-images' . $name;
                    $image->move('images/multiple-images', $name);
                    $product_images = ProductImages::create([
                        'product_id' => $product->id,
                        'path' => $name
                    ]);
                }
            }

            $product->attributes()->detach($product->attributes->pluck('id'));
            $product->attributeValues()->detach($product->attributeValues->pluck('id'));

            $product->attributes()->attach($attributes['ids']);
            $product->attributeValues()->attach($attributes['values']);


            $stock_qty = [];
            for ($i = 0; $i < sizeof($variation['ids']); $i++) {
                $stock_qty[$variation['ids'][$i]] = ['stock_quantity' => $variation['stocks'][$i]];
            }

            $prices = [];
            for ($i = 0; $i < sizeof($variation['ids']); $i++) {
                $prices[$variation['values'][$i]] = ['price' => $variation['prices'][$i]];
            }

            $product->variation()->detach($product->variation->pluck('id'));
            $product->variationValues()->detach($product->variationValues->pluck('id'));

            $product->variation()->attach($stock_qty);
            $product->variationValues()->attach($variation['values']);
            $product->variation()->attach($prices);

            return response('Product updated');
        } catch (\Exception $exception) {
            return response(['message' => 'There was an error. Please try again later'], 500);
        }
    }

    public function destroy($id) {
        $product = Product::find($id);
        $product->attributes()->detach($product->attributes->pluck('id'));
        $product->attributeValues()->detach($product->attributeValues->pluck('id'));

        $product->variation()->detach($product->variation->pluck('id'));
        $product->variationValues()->detach($product->variationValues->pluck('id'));

        ProductImages::where('product_id', $id)->delete();
        $product->delete();

        return response('Product deleted');
    }
}
