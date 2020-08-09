<?php

namespace App\Http\Controllers\Backend;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index() {
        $products = Product::all();

        $products = ProductResource::collection($products);

        return response($products);
    }

    public function show(Product $product) {

        $product = new ProductResource($product->load(['variation.variationValues']));

        return response($product);
    }

    public function inCart() {
        return response(['data' => Auth::user()->carts->where('order_id', null)->load(['product', 'variation_value'])->toArray()]);
    }

    public function addToCart(Request $request) {
        $data = [
            'product_id' => $request->get('product'),
            'variation_value_id' => $request->get('variation_value'),
            'quantity' => $request->get('quantity'),
        ];

        Auth::user()->carts()->create($data);

        return response(['Product added to cart successfully']);
    }

    public function removeFromCart(Cart $cart) {
        $cart->delete();

        return response(['Successfully removed from cart']);
    }

    public function makeOrder(Request $request) {
        $carts_id = $request->get('carts_id');

        $data = [
            'user_id' => Auth::user()->id,
            'total_price' => $request->get('total_price'),
        ];

        $order = Order::create($data);

        Cart::whereIn('id', $carts_id)->update(['order_id' => $order->id]);

        return response(['Order created successfully']);
    }

    public function getOrders() {
        return response(['data' => Auth::user()->orders->load(['carts.product', 'carts.variation_value'])->toArray()]);
    }
}
