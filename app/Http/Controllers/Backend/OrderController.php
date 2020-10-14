<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\UserOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = UserOrder::all()->load(['user', 'carts.product', 'carts.variation_value']);

        return response(['data' => $orders]);
    }
}
