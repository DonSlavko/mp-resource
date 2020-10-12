@extends('layouts.auth')

@section('content')
    <v-container fluid>
        <v-row>
            <v-col offset-md="5" cols="12" md="2">
                <v-img max-width="200" src="/storage/Logo-Original.png" contain></v-img>
            </v-col>
            <v-col offset-md="4" cols="12" md="4">
                <v-col cols="12" class="text-center pt-10">
                    {{ __('Reset Password') }}
                </v-col>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf


                        <v-col cols="12" class="py-0">
                            <v-text-field
                                    class="mt-1"
                                    label="{{ __('E-Mail Address') }}"
                                    value="{{ old('email') }}"
                                    id="email" name="email" type="email"
                                    outlined dense autofocus required autocomplete="email"></v-text-field>
                        </v-col>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <v-btn color="primary"
                               style="text-transform: none!important;"
                               type="submit"
                               depressed large block>{{ __('Send Password Reset Link') }}
                        </v-btn>
                    </form>
                </div>
            </v-col>
        </v-row>
    </v-container>
@endsection
