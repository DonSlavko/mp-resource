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
            ->load(['variation', 'variationValues', 'attributes', 'attributeValues', 'brand', 'category', 'product_images'])
            ->map(function ($prod) {

                $attrIds = $prod->attributes->pluck('id');
                $valIds = $prod->attributeValues->pluck('id');
                $attributes = [];

                foreach ($valIds as $key => $value) {
                    if ($attrIds[$key]) {
                        $attributes[$attrIds[$key]] = $value;
                    }
                }

                $prod->attributes_values = $attributes;

                $prod->stock = $prod->variationValues()->sum('quantity');

                $varIds = $prod->variationValues->pluck('id');
                $quantities = $prod->variationValues()->pluck('quantity');
                $prices = $prod->variationValues()->pluck('price');

                $variations_values = [
                    'quantity' => [],
                    'price' => []
                ];

                foreach ($quantities as $key => $quantity) {
                    if ($varIds[$key]) {
                        $variations_values['quantity'][$varIds[$key]] = "$quantity";
                    }
                }
                foreach ($prices as $key => $price) {
                    if ($varIds[$key]) {
                        $variations_values['price'][$varIds[$key]] = "$price";
                    }
                }

                $prod->variations_values = $variations_values;

                $prod->variation_id = $prod->variation()->first()->id;

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

        $product = Product::create([
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'description' => $request->get('description'),
            'brand_id' => $request->get('brand_id'),
            'sku' => $request->get('sku'),
            'expires' => $request->get('expires'),
            'charge' => $request->get('charge'),
        ]);

        $brochure = $request->file('brochure');
        if ($brochure) {
            $name = time() . '_' . $brochure->getClientOriginalName();
            $path = '/files/products/' . $name;
            $brochure->move('files/products/', $name);
        }

        if ($analysis = $request->file('analysis')) {
            $analysis_name = time() . '_' . $analysis->getClientOriginalName();
            $analysis_name_path = '/files/products/' . $analysis_name;
            $analysis->move('files/products/', $analysis_name);
        }

        $product->update([
            'brochure' => $path ?? null,
            'analysis' => $analysis_name_path ?? null,
        ]);

        foreach ($request->file('images') as $image) {
            $name = time() . '_' . $image->getClientOriginalName();
            $path = '/images/products/' . $name;
            $image->move('images/products/', $name);
            $product_images = ProductImages::create([
                'product_id' => $product->id,
                'path' => $path
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
        foreach ($variations as $key => $varVal) {
            $variationValuesIds[$i]['variation_value_id'] = $key;
            $variationValuesIds[$i]['price'] = $varVal['price'];
            $variationValuesIds[$i]['quantity'] = $varVal['quantity'];
            $i++;
        }

        $product->attributes()->attach($attributeIds);
        $product->attributeValues()->attach($attributeValuesIds);

        $product->variation()->attach($variation);
        $product->variationValues()->attach($variationValuesIds);

        return response('Neues Produkt wurde hinzugefügt');
    }

    public function update(Request $request, Product $product) {
        try {
            if ($request->hasFile('brochure')) {
                $brochure = $request->file('brochure');
                $name = time() . '_' . $brochure->getClientOriginalName();
                $path = '/files/products/' . $name;
                $brochure->move('files/products/', $name);
                $product->where('name', '=', 'brochure')->update([
                    'brochure' => $path,
                ]);
            }

            if ($request->hasFile('analysis')) {
                $analysis = $request->file('analysis');
                $analysis_name = time() . '_' . $analysis->getClientOriginalName();
                $analysis_name_path = '/files/products/' . $analysis_name;
                $analysis->move('files/products/', $analysis_name);
                $product->where('name', '=', 'analysis')->update([
                    'analysis' => $analysis_name_path,
                ]);
            }

            $data = [
                'name' => $request->get('name'),
                'category_id' => $request->get('category_id'),
                'description' => $request->get('description'),
                'brand_id' => $request->get('brand_id'),
                'sku' => $request->get('sku'),
                'expires' => $request->get('expires'),
                'charge' => $request->get('charge'),
            ];

            $product->update($data);

            if ($request->hasFile('analysis')) {
                foreach ($request->file('images') as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $path = '/images/products/' . $name;
                    $image->move('images/products/', $name);
                    $product_images = ProductImages::create([
                        'product_id' => $product->id,
                        'path' => $path
                    ]);
                }
            }

            $product->attributes()->detach();
            $product->attributeValues()->detach();

            $product->variation()->detach();
            $product->variationValues()->detach();

            $variations = $request->get('variations');
            $variation = $request->get('variation');
            $attributes = $request->get('attributes');

            foreach ($attributes as $key => $attribute) {
                $attributeIds[] = $key;
                $attributeValuesIds[] = $attribute;
            }

            $i = 0;
            foreach ($variations as $key => $varVal) {
                $variationValuesIds[$i]['variation_value_id'] = $key;
                $variationValuesIds[$i]['price'] = $varVal['price'];
                $variationValuesIds[$i]['quantity'] = $varVal['quantity'];
                $i++;
            }

            $product->attributes()->attach($attributeIds);
            $product->attributeValues()->attach($attributeValuesIds);

            $product->variation()->attach($variation);
            $product->variationValues()->attach($variationValuesIds);

            return response('Produkt wurde aktualisiert');
        } catch (\Exception $exception) {
            return response(['message' => 'Es gab einen Fehler'], 500);
        }
    }

    public function destroy(Product $product) {
        $product->attributes()->detach();
        $product->attributeValues()->detach();

        $product->variation()->detach();
        $product->variationValues()->detach();

        $product->product_images()->delete();
        $product->delete();

        return response('Produkt wurde gelöscht');
    }
}
