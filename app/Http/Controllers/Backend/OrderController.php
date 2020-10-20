<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index() {
        $orders = UserOrder::where('preorder', 0)->with(['user', 'carts.product'])->get()->toArray();
        $preorders = UserOrder::where('preorder', 1)->with(['user', 'carts.product'])->get()->toArray();

        return response(['orders' => $orders, 'preorders' => $preorders]);
    }

    public function approve(UserOrder $order) {
        $order->update([
            'status' => 'Approved',
        ]);

        if ($order->preorder === 1) {
            Mail::to($order->user->email)->send(new \App\Mail\UserOrder([
                'order' => $order,
                'name' => $order->user->username,
            ], [
                'address' => 'auftragsbestaetigung@mp-resource.shop',
                'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
            ], 'Your Preorder is approved'));

            return response(['message' => 'Preorder successfully approved']);
        } else {
            Mail::to($order->user->email)->send(new \App\Mail\UserOrder([
                'order' => $order,
                'name' => $order->user->username,
            ], [
                'address' => 'auftragsbestaetigung@mp-resource.shop',
                'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
            ], 'Your Order is approved'));

            return response(['message' => 'Order successfully approved']);
        }
    }

    public function denied(UserOrder $order) {
        $order->update([
            'status' => 'Denied',
        ]);

        if ($order->preorder === 1) {
            Mail::to($order->user->email)->send(new \App\Mail\UserOrder([
                'order' => $order,
                'name' => $order->user->username,
            ], [
                'address' => 'auftragsbestaetigung@mp-resource.shop',
                'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
            ], 'Your Preorder is denied'));

            return response(['message' => 'Preorder successfully denied']);
        } else {
            Mail::to($order->user->email)->send(new \App\Mail\UserOrder([
                'order' => $order,
                'name' => $order->user->username,
            ], [
                'address' => 'auftragsbestaetigung@mp-resource.shop',
                'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
            ], 'Your Order is denied'));

            return response(['message' => 'Order successfully denied']);
        }




    }
}
