@extends('layouts.auth')

@section('content')
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
                        <v-btn href="{{ route('register') }}" color="secondary" class="text--secondary" large style="text-transform: none!important;" block>Registrieren</v-btn>
                    </v-col>

                    <v-col cols="12">
                        <v-btn href="password-resset" outlined text class="text--secondary" style="text-transform: none!important;" block>
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
                    <v-btn href="datenschutzerklaerung_" text class="text--secondary" style="text-transform: none!important;">
                        Datenschutzerklärung</v-btn>
                </v-col>
                <v-col cols="4" class="text-center">
                    <v-btn href="agb_" text class="text--secondary" style="text-transform: none!important;">
                        AGB</v-btn>
                </v-col>
                <v-col cols="4">
                    <v-btn href="impressum" text class="text--secondary" style="text-transform: none!important;">
                        Impressum</v-btn>
                </v-col>
            </v-row>
        </v-col>

        <v-col cols="12" class="text-center pt-10" style="color: #494949;">
            Copyright © 2019-2020, Medical Pharma Resource GmbH
        </v-col>
    </v-row>
</v-container>
@endsection
