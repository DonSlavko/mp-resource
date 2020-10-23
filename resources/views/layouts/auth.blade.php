<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MP Resource') }}</title>

    <link rel="icon" href="/images/cropped-mpr_rund_neu-32x32.png" sizes="32x32">
    <link rel="icon" href="/images/cropped-mpr_rund_neu-192x192.png" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="/images/cropped-mpr_rund_neu-180x180.png">

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
    <main class="py-4">
        <v-app v-cloak style="background-image: linear-gradient(180deg, rgba(255,255,255,0) 0%, #dfeacc 100%);">
            <v-main>
                @yield('content')
            </v-main>
        </v-app>
    </main>
</div>

@stack('scripts')
</body>
</html>

