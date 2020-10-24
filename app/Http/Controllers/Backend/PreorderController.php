<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\PaymentStatus;
use App\UserPreorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PreorderController extends Controller
{
    public function index()
    {
        $preorders = UserPreorder::with(['user', 'carts.product'])->get()->toArray();

        return response(['preorders' => $preorders]);
    }

    public function approve(UserPreorder $order)
    {
        $order->update([
            'status' => 'Approved',
        ]);

        Mail::to($order->user->email)->send(new \App\Mail\UserOrder([
            'order' => $order,
            'name' => $order->user->username,
        ], [
            'address' => 'auftragsbestaetigung@mp-resource.shop',
            'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
        ], 'Your Preorder is approved'));

        return response(['message' => 'Preorder successfully approved']);
    }

    public function denied(UserPreorder $order)
    {
        $order->update([
            'status' => 'Denied',
        ]);

        Mail::to($order->user->email)->send(new \App\Mail\UserOrder([
            'order' => $order,
            'name' => $order->user->username,
        ], [
            'address' => 'auftragsbestaetigung@mp-resource.shop',
            'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
        ], 'Your Preorder is denied'));

        return response(['message' => 'Preorder successfully denied']);
    }
}
