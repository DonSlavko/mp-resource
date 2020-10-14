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
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <v-col cols="12" class="py-0">
                            <v-text-field
                                    class="mt-1"
                                    label="{{ __('E-Mail Address') }}"
                                    value="{{ $email ?? old('email') }}"
                                    id="email" name="email" type="email"
                                    outlined dense required></v-text-field>
                        </v-col>

                        <v-col cols="12" class="py-0">
                            <v-text-field
                                    class="mt-1"
                                    label="{{ __('Password') }}"
                                    v-model="input.password"
                                    :rules="validate.password"
                                    id="password" name="password" type="password"
                                    outlined dense required></v-text-field>
                        </v-col>

                        <v-col cols="12" class="py-0">
                            <v-text-field
                                    class="mt-1"
                                    v-model="input.password_repeat"
                                    :rules="[validate.password_repeat, confirmPassword]"
                                    label="{{ __('Confirm Password') }}"
                                    id="password-confirm" name="password_confirmation" type="password"
                                    outlined dense required></v-text-field>
                        </v-col>

                        <v-btn color="primary"
                               style="text-transform: none!important;"
                               type="submit"
                               depressed large block>{{ __('Reset Password') }}
                        </v-btn>
                    </form>
                </div>
            </v-col>
        </v-row>
    </v-container>
@endsection
