<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaymentStatus;
use App\UserOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserDashboardController extends Controller
{
    public function index() {
        $orders = UserOrder::where('user_id', Auth::user()->id)->get();
        $paymentstatus = PaymentStatus::where('user_id', Auth::user()->id)->get();
        //dd($orders);
        return view('dashboard.index', get_defined_vars());
    }

    public function update(Request $request) {


        $user = Auth::user();
        $user->update($request->has('password') ? $request->all() : $request->except(['password']));

        return response(['message' => 'Profile has been Updated.']);

    }


    public function delete() {

        $user = User::find(Auth::user()->id);
        Auth::logout();
        if ($user->delete()) {
            return Redirect::route('home');
        }
    }
}
