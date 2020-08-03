<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ShopController extends Controller
{
    public function index() {
        $products = Product::all();

        $products = ProductResource::collection($products);

        return response($products);
    }

    public function show(Product $product) {
        $product = new ProductResource($product);

        return response($product);
    }
}
