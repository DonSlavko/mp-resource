<?php

namespace App\Http\Controllers\Backend;

use App\Attribute;
use App\Brand;
use App\Cart;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AttributeResource;
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
    public function index(Request $request) {
        $per_page = $request->get('per_page', 16);
        $order = $request->get('order', 'asc');
        $sort = $request->get('sort', 'id');
        $attrValIds = $request->get('attributes_values_ids', null);
        $brandIds = $request->get('brand_ids', null);

        $products = Product::with('product_images');

        if ($attrValIds) {
            foreach ($attrValIds as $ids) {
                $products = $products->filterAttributesValues($ids);
            }
        }

        $products = $products->brands($brandIds)->orderBy($sort, $order)
            ->paginate($per_page);

        $products = ProductResource::collection($products);
        return $products;
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

        if ($total_quantity < $quantity) {
            return response([
                [], ['Not enough product in stock']
            ]);
        }

        Auth::user()->carts()->create([
            'quantity' => $quantity,
            'product_id' => $product_id,
            'product_name' => $product->name,
            'variation_value_id' => $variation_value_id,
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

        if (!is_array($carts_id)) {
            $carts_id = [$carts_id];
        }

        $preorder = !!$request->get('preorder', false);


        $file1 = $request->file('file1');
        $file2 = $request->file('file2');
        $file3 = $request->file('file3');
        if ($file1) {
            $name1 = time() . '_' . $file1->getClientOriginalName();
            $path1 = 'order/files/' . $name1;
            $file1->move('order/files/', $name1);
        }
        if ($file2) {
            $name2 = time() . '_' . $file2->getClientOriginalName();
            $path2 = 'order/files/' . $name2;
            $file2->move('order/files/', $name2);
        }
        if ($file3) {
            $name3 = time() . '_' . $file3->getClientOriginalName();
            $path3 = 'order/files/' . $name3;
            $file3->move('order/files/', $name3);
        }

        $data = [
            'user_id' => Auth::user()->id,
            'total_price' => $request->get('total_price'),
            'preorder' => $preorder,
            'status' => 'On hold',
            'file1' => $path1 ?? null,
            'file2' => $path2 ?? null,
            'file3' => $path3 ?? null,
        ];

        $files = [
            [
                'name' => $name1,
                'file' => $path1,
                'options' => [],
            ],
            [
                'name' => $name2,
                'file' => $path2,
                'options' => [],
            ],
            [
                'name' => $name3,
                'file' => $path3,
                'options' => [],
            ],
        ];

        $order = UserOrder::create($data);

        Cart::whereIn('id', $carts_id)->update(['order_id' => $order->id]);

        $user_name = Auth::user()->username;
        $user_email = Auth::user()->email;

        $order = $order->load('carts');

        if ($preorder) {
            $data = [
                'order' => $order,
                'name' => $user_name,
            ];

            $from = [[
                'address' => 'vorbestellung@mp-resource.shop',
                'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
            ]];

            Mail::to($user_email)->send(new \App\Mail\UserOrder($data, $from, 'Your Pre-order is created'));

            $adminEmails = User::where('is_admin', 1)->pluck('email')->toArray();

            $from = [[
                'address' => 'vorbestellung@mp-resource.shop',
                'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
            ]];

            Mail::to($adminEmails)->send(new UserOrderAdmin($order, $from, $files, 'New Pre-order is created'));
        } else {
            $data = [
                'order' => $order,
                'name' => $user_name,
            ];

            $from = [[
                'address' => 'bestellung@mp-resource.shop',
                'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
            ]];

            Mail::to($user_email)
                ->send(new \App\Mail\UserOrder($data, $from, 'Your Order is created'));

            $adminEmails = User::where('is_admin', 1)->pluck('email')->toArray();

            $from = [[
                'address' => 'bestellung@mp-resource.shop',
                'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
            ]];

            Mail::to($adminEmails)
                ->send(new UserOrderAdmin($order, $from, $files, 'New Order is created'));
        }

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

    public function attributes(Request $request) {
        $attribute = Attribute::all()->load('attributeValues');

        return response(AttributeResource::collection($attribute));
    }

    public function brands() {
        $brands = Brand::all();

        return response($brands);
    }
}
