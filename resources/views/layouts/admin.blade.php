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
</head>
<body>
<div id="app">
    <v-app v-cloak {{--style="background-image: linear-gradient(180deg, rgba(255,255,255,0) 0%, #dfeacc 100%);"--}}>
        <v-app-bar app height="100" flat color="#fff">
            <v-container>
                <v-row align="center" justify="center">
                    <a href="/"><v-img max-width="162" src="{{ asset('storage/Logo-Original.png') }}" contain></v-img></a>
                    <v-spacer></v-spacer>

                    <v-btn href="{{ route('admin.product.index') }}" text class="text--secondary">
                        Product</v-btn>
                    <v-btn href="{{ route('admin.category.index') }}" text class="text--secondary">
                        Category</v-btn>
                    <v-btn href="{{ route('admin.attribute.index') }}" text class="text--secondary">
                        Attribute</v-btn>
                    <v-btn href="{{ route('admin.user.index') }}" text class="text--secondary">
                        User</v-btn>
                    <v-btn href="{{ route('admin.variation.index') }}" text class="text--secondary">
                        Variation</v-btn>
                    <v-btn href="{{ route('user.shop') }}" text class="text--secondary">
                        Shop</v-btn>
                </v-row>
            </v-container>

        </v-app-bar>
        <v-main>
            @yield('content')
        </v-main>
    </v-app>
</div>
</body>
</html>
