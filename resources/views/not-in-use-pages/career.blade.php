@extends('layouts.app')

@section('content')
    <v-parallax
            src="{{ asset('storage/karriere-1.jpg') }}"
            height="450"
    >
        <div style="z-index: 1; background: rgba(255,255,255,0.55); mix-blend-mode: normal; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
        <v-row style="z-index: 100;"
               align="center"
               justify="center"
        >
            <v-col class="text-center" style="color: #444444" cols="12">
                <h4 class="text-body-1 font-weight-medium mb-4">KARRIERE</h4>
                <h1 class="text-h3 font-weight-bold mb-4">
                    Wir suchen engagierte Bewerber
                </h1>
                <h4 class="text-body-1 font-weight-medium">
                    Bewirb dich jetzt für einen sicheren und innovativen Arbeitsplatz.
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
                    <h2 class="text-h6 mb-6" style="text-transform: uppercase">Dein einstieg bei uns</h2>
                    <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; width: 50%; border: none;">
                </v-col>
                <v-col cols="12">

                    <p>Du möchtest bei uns von Beginn an mitwirken? Und etwas großes und dauerhaftes
                        Schaffen?</p>

                    <p>Dann heißen wir dich herzlich Willkommen bei der Medical Pharma Resource GmbH.
                        Du kannst am Wachstum unseres <br> Unternehmens teilnehmen und so ein Teil des
                        Ganzen werden.</p>

                    <p>Aktuelle Stellenangebote für Praktikanten:</p>

                    <ul class="mb-4">
                        <li>Studenten aus dem BWL- und Pharma-Bereich</li>
                    </ul>

                    <p>Oder schick einfach eine Initiativbewerbung an uns unter:</p>

                    <p class="primary--text">bewerbung@mp-resource.com</p>
                </v-col>

                <v-col cols="12" class="mt-10">
                    <h2 class="text-h6 mb-6" style="text-transform: uppercase">DICH ERWARTET</h2>
                    <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; width: 50%; border: none;">
                </v-col>

                <v-col cols="12" md="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-leaf</v-icon>
                    <h3>Work-Life Balance</h3>

                    <p>Weniger Stress und mehr Zeit für Familie oder Freizeitaktivitäten.</p>
                </v-col>

                <v-col cols="12" md="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-home</v-icon>
                    <h3>Home-Office</h3>

                    <p>Du kannst bis zu zwei mal die Woche vom
                        Home-Office arbeiten.</p>
                </v-col>

                <v-col cols="12" md="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-clock-time-three-outline</v-icon>

                    <h3>Flexible Arbeitszeiten</h3>
                    <p>Gestalte flexibel deine Arbeitszeiten passend
                        zu deinen Aufgaben.</p>
                </v-col>

                <v-col cols="12" md="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-star</v-icon>

                    <h3> Kostenlose Snacks & Getränke</h3>
                    <p>Wir stellen euch täglich Obst, Kaffeevariationen und Wasser zur Verfügung.</p>
                </v-col>

                <v-col cols="12" md="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-rocket-launch</v-icon>

                    <h3>Mobilität</h3>
                    <p>Jobtickets und Bahnvorteilskarten unterstützen Sie bei Ihrer Mobilität.</p>
                </v-col>

                <v-col cols="12" md="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-presentation</v-icon>

                    <h3>Weiterbildung</h3>
                    <p>Sie werden branchenspezifisch durch Schulungen, Seminare und Kurse zusätzlich gefördert.</p>
                </v-col>

            </v-row>
        </section>

    </v-container>
@endsection
