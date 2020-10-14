<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        ul {
            margin: 0px;
            padding: 0px;
        }

        .footer-section {
            background: #151414;
            position: relative;
        }

        .footer-cta {
            border-bottom: 1px solid #373636;
        }

        .single-cta i {
            color: #ff5e14;
            font-size: 30px;
            float: left;
            margin-top: 8px;
        }

        .cta-text {
            padding-left: 15px;
            display: inline-block;
        }

        .cta-text h4 {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .cta-text span {
            color: #757575;
            font-size: 15px;
        }

        .footer-content {
            position: relative;
            z-index: 2;
        }

        .footer-pattern img {
            position: absolute;
            top: 0;
            left: 0;
            height: 330px;
            background-size: cover;
            background-position: 100% 100%;
        }

        .footer-logo {
            margin-bottom: 30px;
        }

        .footer-logo img {
            max-width: 200px;
        }

        .footer-text p {
            margin-bottom: 14px;
            font-size: 14px;
            color: #7e7e7e;
            line-height: 28px;
        }

        .footer-social-icon span {
            color: #fff;
            display: block;
            font-size: 20px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 20px;
        }

        .footer-social-icon a {
            color: #fff;
            font-size: 16px;
            margin-right: 15px;
        }

        .footer-social-icon i {
            height: 40px;
            width: 40px;
            text-align: center;
            line-height: 38px;
            border-radius: 50%;
        }

        .facebook-bg {
            background: #3B5998;
        }

        .twitter-bg {
            background: #55ACEE;
        }

        .google-bg {
            background: #DD4B39;
        }

        .footer-widget-heading h3 {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 40px;
            position: relative;
        }

        .footer-widget-heading h3::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -15px;
            height: 2px;
            width: 50px;
            background: #ff5e14;
        }

        .footer-widget ul li {
            display: inline-block;
            float: left;
            width: 50%;
            margin-bottom: 12px;
        }

        .footer-widget ul li a:hover {
            color: #ff5e14;
        }

        .footer-widget ul li a {
            color: #878787;
            text-transform: capitalize;
        }

        .footer-form {
            position: relative;
            overflow: hidden;
        }

        .footer-form input {
            width: 100%;
            padding: 14px 28px;
            background: #2E2E2E;
            border: 1px solid #2E2E2E;
            color: #fff;
        }

        .footer-form button {
            border: none;
            background: transparent;
            outline: none;
            border-radius: 0px 20px 20px 0px;
            background-color: #9babcc;
            color: #fff;
            font-weight: bold;
        }

        .footer-form button i {
            color: #fff;
            font-size: 22px;
            transform: rotate(-6deg);
        }

        .copyright-area {
            background: #202020;
            padding: 25px 0;
        }

        .copyright-text p {
            margin: 0;
            font-size: 14px;
            color: #878787;
        }

        .copyright-text p a {
            color: #ff5e14;
        }

        .footer-menu li {
            display: inline-block;
            margin-left: 20px;
        }

        .footer-menu li:hover a {
            color: #ff5e14;
        }

        .footer-menu li a {
            font-size: 14px;
            color: #878787;
        }

        .footer-widget ul li a {
            color: white;
        }


        .third {
            margin-left: solid;
            padding: 40px;
        }

        .copyright {
            text-align: center;
        }

        .footer-menu li a {
            font-size: 14px;
            color: #878787;
        }

        .footer-section {
            background-color: #88b04b;
        }

        .footer-section li {
            padding: 7px;
        }

        .footer-section ul {
            border-left: 1px solid #fff;
            padding: 10px;
        }

        .footer-section a {
            color: #fff !important;
            font-weight: bold;
        }

        .footer-section hr {
            height: 1px;
            background-color: #fff;
            border: none;
        }
    </style>
</head>

<body>
<div id="app">
    <v-app v-cloak {{--style="background-image: linear-gradient(180deg, rgba(255,255,255,0) 0%, #dfeacc 100%);"--}}>
        <v-app-bar app height="100" flat color="#fff">
            <v-container>
                <v-row align="center" justify="center">
                    <div class="col-md-2">
                        <a href="/">
                            <v-img max-width="162"
                                   src="https://mp-resource.shop/wp-content/uploads/2019/12/Logo-Original.png"
                                   contain></v-img>
                        </a>
                    </div>
                    <v-spacer></v-spacer>
                    <div class="col-md-10">
                        <v-btn href="{{ route('admin.product.index') }}" text
                               class="text--secondary {{ Route::currentRouteNamed('admin.product.*') ? 'active' : '' }}">
                            Products
                        </v-btn>
                        <v-btn href="{{ route('admin.category.index') }}" text
                               class="text--secondary {{ Route::currentRouteNamed('admin.category.index') ? 'active' : '' }}">
                            Categories
                        </v-btn>
                        <v-btn href="{{ route('admin.attribute.index') }}" text class="text--secondary">
                            Attributes
                        </v-btn>
                        <v-btn href="{{ route('admin.attribute-value.index') }}" text class="text--secondary">
                            Attributes Values
                        </v-btn>
                        <v-btn href="{{ route('admin.variation.index') }}" text class="text--secondary">
                            Variations
                        </v-btn>
                        <v-btn href="{{ route('admin.variation-value.index') }}" text class="text--secondary">
                            Variations Values
                        </v-btn>
                        <v-btn href="{{ route('admin.brand.index') }}" text class="text--secondary">
                            Brand
                        </v-btn>
                        <v-btn href="{{ route('admin.user.index') }}" text class="text--secondary">
                            Users
                        </v-btn>
                        <v-btn href="{{ route('admin.order.index') }}" text class="text--secondary">
                            Orders
                        </v-btn>
                        <v-btn href="{{ route('admin.newsletterindex') }}" text class="text--secondary">
                            Newsletter
                        </v-btn>
                        <v-btn href="{{ route('admin.call-service') }}" text class="text--secondary">
                            Call Service
                        </v-btn>
                        <v-btn href="{{ route('user.shop') }}" text class="text--secondary">
                            Back to Shop
                        </v-btn>
                        <v-btn @click="logout()" text class="text--secondary">
                            Logout
                        </v-btn>
                    </div>
                </v-row>
            </v-container>

        </v-app-bar>

        <v-main>
            @yield('content')
        </v-main>
        <div class="footer-section mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 first mt-2">
                        <a href="/">
                            <v-img max-width="182" src="/Logo-white-300x134.png" contain></v-img>
                            <v-img max-width="160" class="mt-2 ml-2" src="/MPR-Canna-white-200x32.png" contain></v-img>

                        </a></div>
                    <div class="col-md-3 ">
                        <ul>
                            <li><a href="{{ route('user.news') }}">Neuigkeiten</a></li>
                            <li><a href="{{ route('user.shop') }}">Produkte</a></li>
                            <li><a href="{{ route('user.preorder') }}">Vorbestellungen</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <ul>
                            <li><a href="{{ route('inc.agb') }}">AGB</a></li>
                            <li><a href="{{ route('inc.dat') }}">Datenschutzerklaerung</a></li>
                            <li><a href="{{ route('inc.imp') }}">Impressum</a></li>
                            <li>
                                <call-service></call-service>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3" style="border-left: 1px solid white; padding: 10px">
                        <div class="">
                            <div class="">
                                <h3 style="color: white;">Newsletter</h3>
                            </div>
                            <div class="input-group mb-2 mr-sm-2">
                                <form class="form-inline" action="{{route('user.add_to_newsletter')}}" method="post">
                                    @csrf
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" name="email" class="form-control"
                                               id="inlineFormInputGroupUsername2" placeholder="Email Address">
                                        <div class="input-group-prepend">
                                            <div class="">
                                                <button type="submit" class="btn btn-info mb-1">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <p class="text-white">Zahlungsmöglichkeiten</p>
                                <div class="row ml-2">
                                    <div class="ml-2 mr-2">
                                        <a href="#" class="">
                                            <img src="https://mp-resource.shop/wp-content/uploads/2019/12/SEPA-rund.png"
                                                 class="" alt="">
                                        </a>
                                    </div>
                                    <div class="ml-2 mr-2">
                                        <a href="#" class="">
                                            <img src="https://mp-resource.shop/wp-content/uploads/2019/12/Vorkasse-rund.png"
                                                 class="" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center m-auto text-white">
                <p> Copyright © 2019-2020, Medical Pharma Resource GmbH</p>
            </div>
        </div>
    </v-app>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>

</body>

</html>