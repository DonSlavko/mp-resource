@extends('layouts.app')

@section('content')
    <v-parallax
            src="{{ asset('storage/kontakt-1.jpg') }}"
            height="450"
    >
        <div style="z-index: 1; background: rgba(255,255,255,0.55); mix-blend-mode: normal; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
        <v-row style="z-index: 100;"
               align="center"
               justify="center"
        >
            <v-col class="text-center" style="color: #444444" cols="12">
                <h4 class="text-body-1 font-weight-medium mb-4">KONTAKT</h4>
                <h1 class="text-h3 font-weight-bold mb-4">
                    Gerne helfen wir Ihnen weiter
                </h1>
                <h4 class="text-body-1 font-weight-medium">
                    Bei Fragen oder Anregungen stehen wir Ihnen zur Verfügung. Wir freuen uns auf den
                    Kontakt mit Ihnen.
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

    <v-row justify="center">
        <v-col cols="12" md="4" class="text-center" style="background-color: rgba(222,222,222,1);">
            <v-icon x-large color="primary" class="mb-6">mdi-microphone-outline</v-icon>
            <h3>FÜR PRESSEANFRAGEN</h3>

            <p>Sie sind auf der Suche nach einem Interviewpartner? Unsere Pressestelle steht für Ihre
                Pressanfragen gerne zur Verfügung, damit Sie den geplanten Beitrag zeitnah veröffentlichen
                können.
            </p>
        </v-col>

        <v-col cols="12" md="4" class="text-center" style="background-color: rgba(234,234,234,1);">
            <v-icon x-large color="primary" class="mb-6">mdi-card-account-details-outline</v-icon>
            <h3>FACHGERECHTE AUFKLÄRUNG</h3>

            <p>Wenn Sie Fragen zur medikamentösen Therapie/Behandlung oder zur Verordnung von
               Medizinal-Cannabis haben, steht Ihnen unser Ärzteberatungsteam für jegliche Fragen zur Seite.</p>
        </v-col>

        <v-col cols="12" md="4" class="text-center" style="background-color: rgba(246,246,246,1);">
            <v-icon x-large color="primary" class="mb-6">mdi-phone</v-icon>

            <h3>EXKLUSIVE KUNDENBETREUUNG</h3>
            <p>Sie betreiben eine Apotheke und haben Fragen zur unseren Produkten, zum Bestellverfahren
                oder zum Lieferprozess? Ein Beratungsteam steht Ihnen gerne zur Verfügung, um alle
                Fragen zu beantworten.</p>
        </v-col>
    </v-row>

    <v-container>
        <section class="mt-16">
            <v-row>


                <v-col cols="12" md="8" class="mt-8">
                    <h2 class="text-h6 mb-5" style="text-transform: uppercase">HABEN SIE FRAGEN ODER ANREGUNGEN?</h2>
                    <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; border: none;">
                </v-col>

                <v-col cols="12" md="7">
                    <v-text-field
                            label="Name *" :rules="validate.name" name="name"
                    ></v-text-field>

                    <v-text-field
                            label="E-Mail *" :rules="validate.email" name="e-mail"
                    ></v-text-field>

                    <v-text-field
                            label="Betreff" name="subject"
                    ></v-text-field>

                    <p class="text--secondary">Ihr Anliegen</p>

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
                            <v-icon x-large color="primary" class="mb-6">mdi-phone</v-icon>
                        </v-col>
                        <v-col cols="10">
                            <h3>TELEFON</h3>

                            <p>+49 (2173) 940 9591</p>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-icon x-large color="primary" class="mb-6">mdi-fax</v-icon>
                        </v-col>
                        <v-col cols="10">
                            <h3>FAX</h3>

                            <p>+49 (2173) 940 9599</p>
                        </v-col>
                        <v-col cols="12" md="2">
                            <v-icon x-large color="primary" class="mb-6">mdi-email-outline</v-icon>
                        </v-col>
                        <v-col cols="10">
                            <h3>EMAIL</h3>

                            <p>info@mp-resource.de</p>
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
