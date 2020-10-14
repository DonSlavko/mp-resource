@extends('layouts.user')

@section('content')
    <dashboard></dashboard>
{{--

    <div class="container mt-3 mb-5">
        <div class="">
            <h3>Hi, <em><u>{{ auth()->user()->username }}</u></em> Welcome to Dashboard</h3>
        </div>
        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif
        <hr/>
        <div class="row mt-3">
            <div class="col-md-3  jumbotron mt-3" style="border: 1px solid #ccc;">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                       aria-controls="v-pills-home" aria-selected="true">Edit user Account</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                       aria-controls="v-pills-profile" aria-selected="false">Bills</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
                       aria-controls="v-pills-messages" aria-selected="false">My Orders</a>
                    <a href="{{ route('password.request') }}" class="nav-link" aria-selected="false">Change Password</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
                       aria-controls="v-pills-settings" aria-selected="false">Delete an Account</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                         aria-labelledby="v-pills-home-tab">
                        <profile :user="{{ Auth::user()->toJson() }}"></profile>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                         aria-labelledby="v-pills-profile-tab">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col"> Status</th>
                                <th scope="col">Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paymentstatus as $ps)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$ps->customer_name}}</td>
                                    <td>{{$ps->order_id}}</td>
                                    <td>{{$ps->payment_amount}}</td>
                                    <td>
                                        @if($ps->status = "paid")
                                            <span class="badge badge-success">{{$ps->status}}</span>
                                        @else
                                            <span class="badge badge-danger">{{$ps->status}}</span>
                                        @endif
                                    </td>
                                    <td>{{$ps->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                         aria-labelledby="v-pills-messages-tab">

                        <!-- user order section -->
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>€{{$order->total_price}}</td>
                                    <td>
                                        @if($order->status = "On hold")
                                            <span class="badge badge-danger">{{$order->status}}</span>
                                        @else
                                            <span class="badge badge-success">{{$order->status}}</span>
                                        @endif
                                    </td>
                                    <td>{{$order->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                         aria-labelledby="v-pills-settings-tab">
                        <div class="jumbotron">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="font-weight-bold">Mega Warning!</h2>
                                    <p>You are going to delete absolutely everything you've ever done in MP Resource
                                        Shop. Orders,
                                        Hearts, Comments, your profile... everything even your assets.</p>
                                    <p>You don’t need to delete your account to change your username, profile name, or
                                        email address.
                                        You can update your account information in your account settings.</p>
                                    <p class="alert- alert-danger p-2">After you click the “Delete Account” button,
                                        a warning will pop up, explaining what will happen to your account when you
                                        delete it.
                                        If you are sure you want to delete your account, click the button that says
                                        “OK”.</p>
                                    <a href="{{ route('user.delete.account') }}"
                                       class="btn btn-danger text-white font-weight-bold"
                                       onclick="return confirm('Are you sure you want to delete?')">I Understand, Please
                                        Delete My Account</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
--}}
@endsection