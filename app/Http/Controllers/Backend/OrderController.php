<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\PaymentStatus;
use App\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = UserOrder::with(['user', 'carts.product'])->get()->toArray();

        return response(['orders' => $orders]);
    }

    public function approve(UserOrder $order)
    {
        $order->update([
            'status' => 'Approved',
        ]);


        Mail::to($order->user->email)->send(new \App\Mail\UserOrder([
            'order' => $order,
            'name' => $order->user->username,
        ], null, [[
            'address' => 'auftragsbestaetigung@mp-resource.shop',
            'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
        ]], 'Your Order is approved'));

        return response(['message' => 'Bestellung genehmigt']);
    }

    public function denied(UserOrder $order)
    {
        $order->update([
            'status' => 'Denied',
        ]);

        Mail::to($order->user->email)->send(new \App\Mail\UserOrder([
            'order' => $order,
            'name' => $order->user->username,
        ], null, [[
            'address' => 'auftragsbestaetigung@mp-resource.shop',
            'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
        ]], 'Your Order is denied'));

        return response(['message' => 'Bestellung abgelehnt']);
    }

    public function invoice()
    {
        $invoices = PaymentStatus::all();

        return response(['data' => $invoices]);
    }
}
