<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function preparePayment(Request $request) {
        $total_price = Auth::user()->carts->pluck('price')->sum();
        $total_price = number_format($total_price, 2);
        $order_id = rand();
        // save order details

        $data = [];
        $data['order_id'] = $order_id;
        $data['user_id'] = Auth::id();
        $data['payment_amount'] = $total_price;
        $data['customer_name'] = Auth::user()->username;
        PaymentStatus::create($data);

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $total_price // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Product Order Description",
            "redirectUrl" => route('user.order.success'),
            "webhookUrl" => 'https://0ca3518a75d9.ngrok.io/mp-resource/public/api/webhooks',

            "metadata" => [
                "order_id" => $order_id,
                "user_id" => Auth::id()
            ],
        ]);


        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function handleWebhookNotification(Request $request) {
        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);
        $user = User::find($payment->metadata->user_id);

        if ($payment->isPaid()) {
            $pst = PaymentStatus::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            $pst->status = 'paid';
            $pst->payment_id = $paymentId;
            $pst->save();

            //another code
            $carts_id = $user->carts->pluck('id');
            $data = [
                'user_id' => $user->id,
                'total_price' => $user->carts->pluck('price')->sum(),
            ];

            $order = UserOrder::create($data);
            $cart = Cart::whereIn('id', $carts_id)->update(['order_id' => $order->id]);
            $user_name = $user->username;
            $user_email = $user->email;

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
        }
    }

    public function orderSuccess() {
        return redirect()->route('user.dashboard')->with('message', 'Order created successfully');
        //return response(['Order created successfully']);
    }
}
