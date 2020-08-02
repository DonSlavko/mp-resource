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
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <v-app v-cloak {{--style="background-image: linear-gradient(180deg, rgba(255,255,255,0) 0%, #dfeacc 100%);"--}}>
            <v-app-bar app height="100" flat>
                <v-container>
                    <v-row align="center" justify="center">
                        <v-img max-width="162" src="{{ asset('storage/Logo-Original.png') }}" contain></v-img>

                        <v-spacer></v-spacer>

                        <v-btn href="/" text class="text--secondary">
                            Unternehmen</v-btn>
                        <v-btn href="{{ route('product') }}" text class="text--secondary">
                            Produkte</v-btn>
                        <v-btn href="{{ route('eu-gmp') }}" text class="text--secondary">
                            EU-\GMP</v-btn>
                        <v-btn href="{{ route('investor') }}"text class="text--secondary">
                            Investoren</v-btn>
                        <v-btn href="{{ route('career') }}" text class="text--secondary">
                            Karriere</v-btn>
                        <v-btn text class="text--secondary">
                            Aktuelles</v-btn>
                        <v-btn href="{{ route('contact') }}" text class="text--secondary">
                            Kontakt</v-btn>
                        <v-btn href="{{ route('login') }}" text class="text--secondary">
                            Shop</v-btn>
                    </v-row>
                </v-container>

            </v-app-bar>
            <v-main>
                @yield('content')
            </v-main>
        </v-app>
    </div>

    @stack('scripts')
</body>
</html>
