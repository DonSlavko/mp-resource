@extends('layouts.app')

@section('content')
    <v-parallax
            src="{{ asset('storage/investor-3.jpg') }}"
            height="450"
    >
        <div style="z-index: 1; background: rgba(255,255,255,0.55); mix-blend-mode: normal; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
        <v-row style="z-index: 100;"
               align="center"
               justify="center"
        >
            <v-col class="text-center" style="color: #444444" cols="12">
                <h4 class="text-body-1 font-weight-medium mb-4">INVESTOREN</h4>
                <h1 class="text-h3 font-weight-bold mb-4">
                    Sie möchten in die MPR investieren?
                </h1>
                <h4 class="text-body-1 font-weight-medium">
                    Wir freuen uns, wenn wir Ihr Interesse an unserem Unternehmen geweckt haben. Als Partner <br>
                    können wir Ihnen Sicherheit, Kontinuität, Transparenz und Vertrauen anbieten.
                </h4>
            </v-col>
        </v-row>
    </v-parallax>

    <div style="align-items: center; min-height: 6px; flex-direction: row; flex-wrap: nowrap; display: flex;">
        <div style="width: 25%; min-height: 6px; align-items: stretch; display: flex; background: rgba(153,198,86,1);"></div>
        <div style="width: 25%; min-height: 6px; align-items: stretch; display: flex; background-color: rgba(134,175,74,1);"></div>
        <div style="width: 25%; min-height: 6px; align-items: stretch; display: flex; background-color: rgba(115,150,64,1);"></div>
        <div style="width: 25%; min-height: 6px; align-items: stretch; display: flex; background-color: rgba(82,108,46,1);"></div>
    </div>

    <v-container>
        <section class="mt-16">
            <v-row>
                <v-col cols="12">
                    <h2 class="text-h6 mb-6" style="text-transform: uppercase">WACHSEN SIE MIT UNS</h2>
                    <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; width: 100%; border: none;">
                </v-col>
                <v-col cols="12">
                    <p>Die MPR hat bereits alle nötigen Partner, um am wachsenden deutschen Cannabismarkt,
                        Akzente zu setzen. Aktuell befinden wir uns in der eigenen Zertifizierungsphase.Wir
                        können einer der führenden Großhändler für medizinische Cannabisprodukte in der EU
                        werden. Unser erstes Ziel gilt den deutschen Apotheken und Patienten. Unser zweites
                        Ziel, ist das Erschließen des internationalen Marktes.</p>

                    <p>Wir werden hochwertige medizinische und einzigartige Cannabisprodukte vorerst für den
                        deutschen Markt bereitstellen.
                        Partizipieren Sie an unserem zukunftsfähigen Geschäftsmodell.</p>

                </v-col>

                <v-col cols="12" md="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-checkbox-marked-outline</v-icon>
                    <h3>Partner</h3>

                    <p>Unsere Partner aus dem Transport-, Lager-, Analyse- und Produktionsbereich besitzen
                        alle nötigen Zertifikate für die Teilnahme am deutschen und europäischen
                        Cannabismarkt.
                    </p>
                </v-col>

                <v-col cols="12" md="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-cart-minus</v-icon>
                    <h3>Direktverkauf</h3>

                    <p>Direkter Verkauf an Apotheken über unseren eigenen hochmodernen CRM- und ERP-System.</p>
                </v-col>

                <v-col cols="12" md="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-account-supervisor</v-icon>

                    <h3>Unser Mitarbeiter</h3>
                    <p>Hochbegabte Mitarbeiter, die sich auf med. Cannabisprodukte spezialisiert haben.</p>
                </v-col>

                <v-col cols="12" md="8" class="mt-8">
                    <h2 class="text-h6 mb-5" style="text-transform: uppercase">Wollen sie in Medical Pharma Resource GmbH investieren?</h2>
                    <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; border: none;">
                </v-col>

                <v-col cols="12" md="4" class="mt-8">
                    <h2 class="text-h6 mb-5" style="text-transform: uppercase">Auf EINEN BLICK</h2>
                </v-col>

                <v-col cols="12" md="7">
                    <v-text-field
                            label="Name *" :rules="validate.name" name="name"
                    ></v-text-field>

                    <v-text-field
                            label="E-Mail *" :rules="validate.email" name="e-mail"
                    ></v-text-field>

                    <v-text-field
                            label="Telefonnummer" name="phone"
                    ></v-text-field>

                    <v-text-field
                            label="Unternehmen *" :rules="validate.name" name="company"
                    ></v-text-field>

                    <p class="text--secondary">Unternehmenstyp</p>

                    <v-row>
                        <v-col cols="12" md="4" class="pa-0 ma-0">
                            <v-checkbox name="venture_capital" label="Venture Capital"></v-checkbox>
                        </v-col>
                        <v-col cols="12" md="4" class="pa-0 ma-0">
                            <v-checkbox name="private_equity" label="Private Equity"></v-checkbox>
                        </v-col>
                        <v-col cols="12" md="4" class="pa-0 ma-0">
                            <v-checkbox name="family_office" label="Family Office"></v-checkbox>
                        </v-col>
                        <v-col cols="12" md="4" class="pa-0 ma-0">
                            <v-checkbox name="general_banking" label="General Banking"></v-checkbox>
                        </v-col>
                        <v-col cols="12" md="4" class="pa-0 ma-0">
                            <v-checkbox name="other" label="Sonstige"></v-checkbox>
                        </v-col>
                    </v-row>

                    <v-text-field
                            label="Ihre Position im Umternehmen" name="your_position_in_the_company"
                    ></v-text-field>

                    <v-text-field
                            label="Website" name="website"
                    ></v-text-field>

                    <p class="text--secondary">Ihr Anliegen</p>

                    <v-checkbox dense name="opportunities" label="Ich möchte mehr über Investitionsmöglichkeiten erfahren"></v-checkbox>
                    <v-checkbox dense name="appointment" label="Ich möchte einen Termin ausmachen"></v-checkbox>
                    <v-checkbox dense name="investment" label="Ich möchte in die Medical Pharma Resource GmbH investieren"></v-checkbox>

                    <v-text-field class="pt-4"
                            label="Ihre Nachricht*" :rules="validate.name" name="your_message"
                    ></v-text-field>

                    <v-checkbox name="opportunities" label="Ich habe die Datenschutzinformationen zur
                    Kenntnis genommen und willige in die Datenverarbeitung meiner personenbezogenen
                    Daten durch die Medical Pharma Resource GmbH ein."></v-checkbox>

                    <template>
                        <div class="text-center">
                            <v-btn rounded color="primary" dark>Absenden</v-btn>
                        </div>
                    </template>
                </v-col>

                <v-col offset-md="1" cols="12" md="4">
                    <v-row style="border-left: #444444 1px solid">
                        <v-col cols="12" md="2">
                            <v-icon x-large color="primary" class="mb-6">mdi-earth</v-icon>
                        </v-col>
                        <v-col cols="10">
                            <h3>ZUVERLÄSSIGE Verfügbarkeit</h3>

                            <p>Wir gewährleisten eine dauerhafte und zeitnahe Verfügbarkeit für die
                                zu behandelnden Krankheitssymptome.</p>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-icon x-large color="primary" class="mb-6">mdi-check-circle-outline</v-icon>
                        </v-col>
                        <v-col cols="10">
                            <h3>EU-/GMP- und GDP-zertifizierte Partner</h3>

                            <p>Wir sichern Ihnen eine gleichbleibende Qualität unserer eingeführten Produkte.</p>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-icon x-large color="primary" class="mb-6">mdi-star-outline</v-icon>
                        </v-col>
                        <v-col cols="10">
                            <h3>USP</h3>

                            <p>Wir werden neue Produkte vertreiben, die vorerst kein Mitbewerber anbietet.</p>
                        </v-col>
                    </v-row>

                </v-col>
            </v-row>
        </section>

    </v-container>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/investor.js') }}"></script>
@endpush
