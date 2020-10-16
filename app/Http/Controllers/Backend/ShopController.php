<?php

namespace App\Http\Controllers\Backend;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Mail\UserOrderAdmin;
use App\UserOrder;
use App\Product;
use App\Variation;
use App\VariationValue;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\PseudoTypes\False_;

use Mollie\Laravel\Facades\Mollie;
use Laravel\Cashier\SubscriptionBuilder\RedirectToCheckoutResponse;
use App\User;
use App\PaymentStatus;
use Log;

class ShopController extends Controller
{
    public function index() {
        $products = Product::with('product_images')->get();
        $products = ProductResource::collection($products);
        return response($products);
    }

    public function show(Product $product) {

        $product = new ProductResource($product->load(['variation.variationValues']));

        return response($product);
    }

    public function inCart() {
        $cart = Cart::where('user_id', Auth::user()->id)->where('order_id', null)->get();

        $order_cart = $cart->where('preorder', false)->toArray();

        $preorder_cart = $cart->where('preorder', true)->toArray();


        return response(['orders' => $order_cart, 'preorders' => $preorder_cart]);
    }

    public function addToCart(Request $request) {
        $preorder = $request->get('preorder', false);
        $product_id = $request->get('product_id');
        $variation_value_id = $request->get('variation_value_id');
        $quantity = $request->get('quantity');

        $product = Product::whereId($product_id)->first();
        $variation_value = VariationValue::whereId($variation_value_id)->first();

        $price = $product->variationValues->where('id', $variation_value->id)->first()->pivot->price;
        $total_quantity = $product->variationValues->where('id', $variation_value->id)->first()->pivot->quantity;


        if ($total_quantity > $quantity) {
            return response([
                [], ['Not enough product in stock']
            ]);
        }

        Auth::user()->carts()->create([
            'quantity' => $quantity,
            'product_name' => $product->name,
            'variation_value_name' => $variation_value->name,
            'stock' => $quantity,
            'price' => $price,
            'preorder' => $preorder
        ]);

        $count = Auth::user()->inCart()->count();

        return response([
            ["$count"],
            ['Product added to cart successfully']
        ]);
    }

    public function removeFromCart(Cart $cart) {
        $cart->delete();
        $count = Auth::user()->inCart()->count();
        return $count;
    }

    public function makeOrder(Request $request) {

        $carts_id = $request->get('carts_id');

        $data = [
            'user_id' => Auth::user()->id,
            'total_price' => $request->get('total_price'),
            'preorder' => $request->get('preorder')
        ];

        $order = UserOrder::create($data);

        Cart::whereIn('id', $carts_id)->update(['order_id' => $order->id]);

        $user_name = Auth::user()->username;
        $user_email = Auth::user()->email;

        Mail::to($user_email)->send(new \App\Mail\UserOrder([
            'order' => $order,
            'name' => $user_name,
        ], [
            'address' => 'vorbestellung@mp-resource.shop',
            'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
        ], 'Your Pre-order is created'));

        $adminEmails = User::where('is_admin', 1)->pluck('email')->toArray();

        Mail::to($adminEmails)->send(new UserOrderAdmin([
            'order' => $order,
            'name' => $user_name,
            'user_email' => $user_email
        ], [
            'address' => 'vorbestellung@mp-resource.shop',
            'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
        ], 'New Pre-order is created'));

        return response(['Order created successfully']);
    }

    public function getOrders() {
        return response(['data' => Auth::user()->userOrders->load(['carts'])->where('status', 'On hold')->toArray()]);
    }

    public function moveToOrder(Request $request) {
        $preorder = UserOrder::whereId($request->get('preorder_id'))->first();

        $preorder->carts->each(function($cart) {
            Auth::user()->carts()->create([
                'quantity' => $cart->quantity,
                'product_name' => $cart->product_name,
                'variation_value_name' => $cart->variation_value_name,
                'stock' => $cart->stock,
                'price' => $cart->price,
                'preorder' => false
            ]);
        });

        $preorder->update([
            'status' => 'Completed'
        ]);

        $count = Auth::user()->inCart()->count();

        return response([
            ["$count"],
            ['Product added to cart successfully']
        ]);
    }

    public function getcount() {
        $count = Auth::user()->inCart()->count();
        return $count;
    }
}
