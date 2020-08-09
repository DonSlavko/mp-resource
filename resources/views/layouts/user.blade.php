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

                    <v-btn href="{{ route('user.news') }}" text class="text--secondary">
                        Neuigkeiten</v-btn>
                    <v-btn href="{{ route('user.shop') }}" text class="text--secondary">
                        Produkte</v-btn>
                    <v-btn href="{{ route('user.preorder') }}" text class="text--secondary">
                        Vorbestellungen</v-btn>
                    <v-btn href="{{ route('user.cart') }}" text class="text--secondary">
                        <v-icon>mdi-cart</v-icon>
                        <v-chip class="ma-2" pill>
                            {{ Auth::user()->inCart()->count() }}
                        </v-chip>
                    </v-btn>
                    @if(Auth::user()->is_admin)
                    <v-btn href="/admin/product" text class="text--secondary">
                        Admin</v-btn>
                    @endif
                    <v-btn  @click="logout()" text class="text--secondary">
                        Logout</v-btn>

                </v-row>
            </v-container>

        </v-app-bar>
        <v-main>
            @yield('content')
        </v-main>

        <v-footer
                color="primary"
                padless
        >
            <v-row
                    justify="center"
                    no-gutters
            >
                <v-col offset-md="1" cols="3">
                    <v-img class="mt-2" max-width="162" src="{{ asset('storage/Logo-white-300x134.png') }}"></v-img>
                    <v-img class="mt-2" max-width="162" src="{{ asset('storage/MPR-Canna-white-200x32.png') }}"></v-img>
                </v-col>
                <v-col cols="12" md="5">
                    <v-btn href="{{ route('user.news') }}"
                           color="white"
                           text
                           rounded>
                        Neuigkeiten</v-btn>
                    <v-btn href="{{ route('user.shop') }}"
                           color="white"
                           text
                           rounded>
                        Produkte</v-btn>
                    <v-btn href="{{ route('user.preorder') }}"
                           color="white"
                           text
                           rounded>
                        Vorbestellungen</v-btn>
                    <v-divider></v-divider>
                    <v-btn href="{{ route('inc.agb') }}"
                           color="white"
                           text
                           rounded>
                        AGB</v-btn>
                    <v-btn href="{{ route('inc.dat') }}"
                           color="white"
                           text
                           rounded>
                        Datenschutzerklaerung</v-btn>
                    <v-btn href="{{ route('inc.imp') }}"
                           color="white"
                           text
                           rounded>
                        Impressum</v-btn>
                </v-col>
                <v-col cols="12" md="3"></v-col>
                <v-col
                        class="primary py-4 text-center white--text"
                        cols="12"
                >
                    <p>Copyright©2019-2020, Medical Pharma Resource GmbH</p>
                </v-col>
            </v-row>
        </v-footer>
    </v-app>
</div>
</body>
</html>
