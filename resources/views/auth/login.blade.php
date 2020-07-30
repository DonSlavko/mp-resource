@extends('layouts.app')

@section('content')
{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>--}}

<v-app v-cloak style="background-image: linear-gradient(180deg, rgba(255,255,255,0) 0%, #dfeacc 100%);">
    <v-main>
        <v-container fluid>
            <v-row>
                <v-col offset="5" cols="2">
                    <v-img max-width="200" src="{{ asset('storage/Logo-Original.png') }}" contain></v-img>
                </v-col>
                <v-col offset="4" cols="4">
                    <v-form>
                        <v-row>
                            <v-col cols="12" class="py-0">
                                <label for="email" class="font-weight-bold text-subtitle-1 mb-2">Benutzername oder E-Mail</label>
                                <v-text-field class="mt-1" id="email" name="email" outlined dense></v-text-field>
                            </v-col>

                            <v-col cols="12" class="py-0">
                                <label for="password" class="font-weight-bold text-subtitle-1">Passwort</label>
                                <v-text-field class="mt-1" id="password" name="password" type="password" outlined dense></v-text-field>
                            </v-col>

                            <v-col cols="12" class="py-0">
                                <v-checkbox name="remember" label="Angemeldet bleiben"></v-checkbox>
                            </v-col>

                            <v-col cols="6">
                                <v-btn color="primary" depressed large style="text-transform: none!important;" block>Anmelden</v-btn>
                            </v-col>

                            <v-col cols="6">
                                <v-btn color="secondary" class="text--secondary" large style="text-transform: none!important;" block>Registrieren</v-btn>
                            </v-col>

                            <v-col cols="12">
                                <v-btn outlined text class="text--secondary" style="text-transform: none!important;" block>
                                    Haben Sie Ihr Passwort vergessen?</v-btn>
                            </v-col>

                            <v-col cols="12" class="text-center">
                                oder
                            </v-col>

                            <v-col cols="12">
                                <v-btn color="primary" depressed large style="text-transform: none!important;" block>DocCheck Login</v-btn>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-col>

                <v-col offset="3" cols="6">
                    <v-row>
                        <v-col offset="1" cols="3">
                            <v-btn text class="text--secondary" style="text-transform: none!important;">
                                Datenschutzerklärung</v-btn>
                        </v-col>
                        <v-col cols="4" class="text-center">
                            <v-btn text class="text--secondary" style="text-transform: none!important;">
                                AGB</v-btn>
                        </v-col>
                        <v-col cols="4">
                            <v-btn text class="text--secondary" style="text-transform: none!important;">
                                Impressum</v-btn>
                        </v-col>
                    </v-row>
                </v-col>

                <v-col cols="12" class="text-center pt-10" style="color: #494949;">
                    Copyright © 2019-2020, Medical Pharma Resource GmbH
                </v-col>
            </v-row>
        </v-container>
    </v-main>
</v-app>
@endsection
