@extends('layouts.app')

@section('content')
    <v-parallax
            src="{{ asset('storage/mprunternehmen.jpg') }}"
            height="550"
    >
        <div style="z-index: 1; mix-blend-mode: normal; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
        <v-row style="z-index: 100;"
               align="center"
               justify="center"
        >
            <v-col class="text-center" style="color: #1b1b1b" cols="12">
                <h1 class="text-h2 font-weight-bold mb-4">
                    Gesundheit ist die erste <br> Pflicht im Leben
                </h1>
                <h3 class="text-h4 font-weight-medium">
                    [Oscar Wilde]
                </h3>
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
                    <h2 class="text-h4 mb-6 font-weight-bold">Über uns</h2>
                    <p>Die Medical Pharma Resource (MPR) GmbH wurde Ende des Jahres 2018 mit dem Sitz in
                        Langenfeld gegründet. Unser pharmazeutisches Unternehmen legt den Fokus auf den
                        Import und Vertrieb von verschreibungspflichtigen medizinischen Cannabisprodukten
                        und therapeutischen Geräten.
                    </p>
                    <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; width: 50%; border: none;">
                </v-col>
                <v-col cols="12">
                    <h2 class="text-h4 mb-6 font-weight-bold">
                        Unsere Philosophie
                    </h2>

                    <p>Die Anwendung von medizinischen Cannabisprodukten bietet eine sehr gute Alternative
                        gegenüber anderen Schmerzmittel, die erheblich mehr Risiken und Nebenwirkungen aufweisen.</p>

                    <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; width: 50%; border: none;">

                </v-col>

                <v-col cols="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-leaf</v-icon>
                    <h3>Work-Life Balance</h3>

                    <p>Weniger Stress und mehr Zeit für Familie oder Freizeitaktivitäten.</p>
                </v-col>

                <v-col cols="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-home</v-icon>
                    <h3>Home-Office</h3>

                    <p>Du kannst bis zu zwei mal die Woche vom
                        Home-Office arbeiten.</p>
                </v-col>

                <v-col cols="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-clock-time-three-outline</v-icon>

                    <h3>Flexible Arbeitszeiten</h3>
                    <p>Gestalte flexibel deine Arbeitszeiten passend
                        zu deinen Aufgaben.</p>
                </v-col>

                <v-col cols="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-star</v-icon>

                    <h3> Kostenlose Snacks & Getränke</h3>
                    <p>Wir stellen euch täglich Obst, Kaffeevariationen und Wasser zur Verfügung.</p>
                </v-col>

                <v-col cols="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-rocket-launch</v-icon>

                    <h3>Mobilität</h3>
                    <p>Jobtickets und Bahnvorteilskarten unterstützen Sie bei Ihrer Mobilität.</p>
                </v-col>

                <v-col cols="4" class="text-center">
                    <v-icon x-large color="primary" class="mb-6">mdi-presentation</v-icon>

                    <h3>Weiterbildung</h3>
                    <p>Sie werden branchenspezifisch durch Schulungen, Seminare und Kurse zusätzlich gefördert.</p>
                </v-col>

            </v-row>
        </section>

    </v-container>
@endsection