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
                    <v-img max-width="162" src="{{ asset('storage/Logo-Original.png') }}" contain></v-img>

                    <v-spacer></v-spacer>

                    <v-btn href="{{ route('user.news') }}" text class="text--secondary">
                        Neuigkeiten</v-btn>
                    <v-btn href="{{ route('user.shop') }}" text class="text--secondary">
                        Produkte</v-btn>
                    <v-btn href="{{ route('user.preorder') }}" text class="text--secondary">
                        Vorbestellungen</v-btn>
                    <v-btn href="/admin/produkte" text class="text--secondary">
                        Admin</v-btn>

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
