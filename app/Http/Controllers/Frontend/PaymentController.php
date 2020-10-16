<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\UserOrderAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Mollie\Laravel\Facades\Mollie;
use Laravel\Cashier\SubscriptionBuilder\RedirectToCheckoutResponse;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\PaymentStatus;
use Log;
use App\Cart;
use App\UserOrder;


class PaymentController extends Controller
{
    public function preparePayment(Request $request)
    {
        if ($request->has('order_id')) {

            $order = UserOrder::whereId($request->get('order_id'))->first();

            $total_price = number_format($order->total_price, 2, '.', '');

            $payment = Mollie::api()->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $total_price
                ],

                "description" => "Product Order Description",
                "redirectUrl" => route('user.order.success'),
                "webhookUrl" => route('webhooks'),

                "metadata" => [
                    "order_id" => $order->id,
                    "user_id" => Auth::id()
                ],
            ]);

            return redirect($payment->getCheckoutUrl(), 303);
        }

        $carts_id = $request->get('carts_id');

        $data = [
            'user_id' => Auth::user()->id,
            'total_price' => $request->get('total_price'),
            'is_paid' => false,
            'status' => 'Processing'
        ];

        $order = UserOrder::create($data);

        $cart = Cart::whereIn('id', $carts_id)->update(['order_id' => $order->id]);

        $total_price = number_format($order->total_price, 2, '.', '');

        $paymentData = [
            'order_id' => $order->id,
            'user_id' => Auth::user()->id,
            'payment_amount' => $total_price,
            'customer_name' => Auth::user()->username
        ];

        PaymentStatus::create($data);

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $total_price
            ],
            "description" => "Product Order Description",
            "redirectUrl" => route('user.order.success'),
            "webhookUrl" => route('webhooks'),

            "metadata" => [
                "order_id" => $order->id,
                "user_id" => Auth::id()
            ],
        ]);

        $user_name = Auth::user()->username;
        $user_email = Auth::user()->email;

        Mail::to($user_email)
            ->send(new \App\Mail\UserOrder([
                'order' => $order,
                'name' => $user_name,
            ], [
                'address' => 'bestellung@mp-resource.shop',
                'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
            ], 'Your Order is created'));

        $adminEmails = User::where('is_admin', 1)->pluck('email')->toArray();

        Mail::to($adminEmails)
            ->send(new UserOrderAdmin([
                'order' => $order,
                'name' => $user_name,
                'user_email' => $user_email
            ], [
                'address' => 'bestellung@mp-resource.shop',
                'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
            ], 'New Order is created'));

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function handleWebhookNotification(Request $request)
    {
        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);
        $user = User::find($payment->metadata->user_id);
        $order = UserOrder::find($payment->metadata->order_id);

        if ($payment->isPaid()) {
            $pst = PaymentStatus::where('user_id', $user->id)->where('order_id', $order->id)->first();
            $pst->status = 'paid';
            $pst->payment_id = $paymentId;
            $pst->save();

            $order->update([
                'is_paid' => true,
                'status' => 'Completed'
            ]);
        } else {
            $order->update([
                'is_paid' => false,
                'status' => 'On hold'
            ]);
        }
    }

    public function orderSuccess()
    {
        return redirect()->route('user.dashboard')->with('message', 'Order created successfully');
        //return response(['Order created successfully']);
    }
}
