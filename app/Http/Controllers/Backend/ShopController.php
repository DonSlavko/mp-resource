<?php

namespace App\Http\Controllers\Backend;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\UserOrder;
use App\Product;
use App\Variation;
use App\VariationValue;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use DB;
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
        return response(['data' => Auth::user()->carts->where('order_id', null)->toArray()]);
    }

    public function addToCart(Request $request) {
        $product_id = $request->product_id;
        $variation_id = $request->variation_id;
        $quantity = $request->quantity;

        // $var_for_price = DB::table('variation_value_product')->where('variation_value_id', $variation_id)->where('product_id', $request->product)->first();
        // $price= $var_for_price->price;

        $var = DB::table('product_variation')->where('variation_id', $variation_id)->where('product_id', $product_id)->first();
        $stock = $var->stock_quantity;
        if ($stock >= $quantity) {
            DB::table('product_variation')->where('id', $var->id)->update(
                [
                    'stock_quantity' => $var->stock_quantity - $request->quantity,
                ]
            );


            $variation = DB::table('variation_values')->where('variation_id', $variation_id)->first();
            $variation_value_name = $variation->name;
            $prices = DB::table('product_variation')->where('variation_id', $variation_id)->where('product_id', $product_id)->first();
            $price = $prices->price;
            $product = DB::table('products')->where('id', $product_id)->first();
            $product_name = $product->name;

            $cart = DB::table('carts')->where('product_name', $product_name)->where('variation_value_name', $variation_value_name)->first();
            //$cart_id = $cart->id;
            //dd($cart);
            if ($cart) {
                $cart_id = $cart->id;
                $carts = Cart::find($cart_id);
                $carts->quantity += 1;
                $carts->save();
            } else {
                Auth::user()->carts()->create([
                    'user_id' => Auth::user()->id,
                    'quantity' => $quantity,
                    'product_name' => $product_name,
                    'variation_value_name' => $variation_value_name,
                    'stock' => $stock,
                    'price' => $price
                ]);
            }
            $count = Auth::user()->inCart()->count();
        } else {
            return response([
                [], ['Product Stocks is Not Enough']
            ]);
        }
        return response([
            ["$count"],
            ['Product added to cart successfully']
        ]);
    }

    public function removeFromCart(Cart $cart) {
        $cart->delete();
        $count = Auth::user()->inCart()->count();
        return $count;
        return response(['Successfully removed from cart']);
    }

    public function makeOrder(Request $request) {

        $carts_id = $request->get('carts_id');

        $data = [
            'user_id' => Auth::user()->id,
            'total_price' => $request->get('total_price'),
        ];

        $order = UserOrder::create($data);

        $cart = Cart::whereIn('id', $carts_id)->update(['order_id' => $order->id]);
        $user_name = Auth::user()->username;
        $user_email = Auth::user()->email;


        // todo - change to default laravel mailer
        /*sendMail([
            'view' => 'email.PreOrder_mail_to_admin',
            'to' => 'admin@gmail.com',
            'subject' => 'New Order is created',
            'data' => [
                'order' => $order,
                'name' => $user_name,
                'user_email' => $user_email
            ]
        ]);
        sendMail([
            'view' => 'email.PreOrder_mail_to_customer',
            'to' => $user_email,
            'subject' => 'Your Order is created',
            'data' => [
                'order' => $order,
                'name' => $user_name,
            ]
        ]);*/
        return response(['Order created successfully']);
        //return ['redirect' => route('user.preorder')];
    }

    public function getOrders() {
        return response(['data' => Auth::user()->userOrders->load(['carts'])->toArray()]);
    }

    public function getcount() {
        $count = Auth::user()->inCart()->count();
        return $count;
    }
}
