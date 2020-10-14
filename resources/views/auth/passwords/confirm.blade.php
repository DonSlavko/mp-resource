@extends('layouts.app')

@section('content')
    <v-container fluid>
        <v-row>
            <v-col offset-md="5" cols="12" md="2">
                <v-img max-width="200" src="/storage/Logo-Original.png" contain></v-img>
            </v-col>
            <v-col offset-md="4" cols="12" md="4">
                <v-col cols="12" class="text-center pt-10">
                    {{ __('Confirm Password') }}
                </v-col>

                <v-col cols="12" class="text-center pt-10" style="color: #494949;">
                    {{ __('Please confirm your password before continuing.') }}
                </v-col>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf


                        <v-col cols="12" class="py-0">
                            <v-text-field
                                    class="mt-1"
                                    label="{{ __('Password') }}"
                                    id="password" name="password" type="password"
                                    outlined dense autofocus required autocomplete="email"></v-text-field>
                        </v-col>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <v-btn color="primary"
                               style="text-transform: none!important;"
                               type="submit"
                               depressed large block>{{ __('Confirm Password') }}
                        </v-btn>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>
                </div>
            </v-col>
        </v-row>
    </v-container>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Confirm Password') }}</div>

                    <div class="card-body">
                        {{ __('Please confirm your password before continuing.') }}

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm Password') }}
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
    </div>
@endsection
