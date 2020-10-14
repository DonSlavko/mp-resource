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
                    <a href="/">
                        <v-img max-width="162" src="{{ asset('/Logo-Original.png') }}" contain></v-img>
                    </a>
                    <v-spacer></v-spacer>

                    <v-btn href="/home" text class="text--secondary">
                        Unternehmen
                    </v-btn>
                    <v-btn href="{{ route('product') }}" text class="text--secondary active">
                        Produkte
                    </v-btn>
                    <v-btn href="{{ route('eu-gmp') }}" text class="text--secondary">
                        EU-\GMP
                    </v-btn>
                    <v-btn href="{{ route('investor') }}" text class="text--secondary">
                        Investoren
                    </v-btn>
                    <v-btn href="{{ route('career') }}" text class="text--secondary">
                        Karriere
                    </v-btn>
                    {{--<v-btn text class="text--secondary">
                        Aktuelles</v-btn>--}}
                    <v-btn href="{{ route('contact') }}" text class="text--secondary">
                        Kontakt
                    </v-btn>
                    <v-btn href="{{ route('login') }}" text class="text--secondary">
                        Shop
                    </v-btn>
                    @auth
                        <v-btn @click="logout()" text class="text--secondary">
                            Logout
                        </v-btn>
                    @endauth
                </v-row>
            </v-container>

        </v-app-bar>
        <v-main>
            @yield('content')
        </v-main>
        <div style="align-items: center; min-height: 6px; flex-direction: row; flex-wrap: nowrap; display: flex;">
            <div style="width: 25%; min-height: 6px; align-items: stretch; display: flex; background: rgba(153,198,86,1);"></div>
            <div style="width: 25%; min-height: 6px; align-items: stretch; display: flex; background-color: rgba(134,175,74,1);"></div>
            <div style="width: 25%; min-height: 6px; align-items: stretch; display: flex; background-color: rgba(115,150,64,1);"></div>
            <div style="width: 25%; min-height: 6px; align-items: stretch; display: flex; background-color: rgba(82,108,46,1);"></div>
        </div>
        <v-footer padless>

            <v-row justify="center" no-gutters>
                <v-col cols="12" md="3" offset-md="1">
                    <v-img class="mt-2" max-width="162" src="{{ asset('/Logo-Original.png') }}"></v-img>
                </v-col>
                <v-col cols="12" md="5">
                    <v-btn href="{{ route('product') }}" text rounded>
                        Produkte
                    </v-btn>
                    <v-btn href="{{ route('eu-gmp') }}" text rounded>
                        EU-\GMP
                    </v-btn>
                    <v-btn href="{{ route('investor') }}" text rounded>
                        Investoren
                    </v-btn>
                    <v-btn href="{{ route('career') }}" text rounded>
                        Karriere
                    </v-btn>
                    <v-btn href="{{ route('contact') }}" text rounded>
                        Kontakt
                    </v-btn>
                    <v-btn href="{{ route('login') }}" text rounded>
                        Shop
                    </v-btn>
                    <v-divider></v-divider>
                    <v-btn href="{{ route('inc.agb') }}" text rounded>
                        AGB
                    </v-btn>
                    <v-btn href="{{ route('inc.dat') }}" text rounded>
                        Datenschutzerklaerung
                    </v-btn>
                    <v-btn href="{{ route('inc.imp') }}" text rounded>
                        Impressum
                    </v-btn>
                </v-col>
                <v-col cols="12" md="3"></v-col>
                <v-col class=" py-4 text-center" cols="12">
                    <p>Copyright©2019-2020, Medical Pharma Resource GmbH</p>
                </v-col>
            </v-row>
        </v-footer>
    </v-app>
</div>

@stack('scripts')
</body>

</html>