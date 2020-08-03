@extends('layouts.app')

@section('content')
    <v-parallax
        src="{{ asset('storage/mprunternehmen.jpg') }}"
        height="550"
    >
        <div
            style="z-index: 1; mix-blend-mode: normal; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
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
        <div
            style="width: 25%; min-height: 6px; align-items: stretch; display: flex; background: rgba(153,198,86,1);"></div>
        <div
            style="width: 25%; min-height: 6px; align-items: stretch; display: flex; background-color: rgba(134,175,74,1);"></div>
        <div
            style="width: 25%; min-height: 6px; align-items: stretch; display: flex; background-color: rgba(115,150,64,1);"></div>
        <div
            style="width: 25%; min-height: 6px; align-items: stretch; display: flex; background-color: rgba(82,108,46,1);"></div>
    </div>

    <v-container>
        <section class="mt-16">
            <v-row align="center" justify="center" style="text-align: center">
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

        <section>
            <v-row align="center" justify="center">
                <v-col cols="12" md="6">
                    <v-img height="550px" src="/storage/Hände.jpg"></v-img>
                </v-col>
                <v-col cols="12" md="6" class="px-14 py-8">
                    <h1 class="mb-8">Unsere Partner</h1>

                    <p>
                        <span class="primary--text">
                            <b>EU-/GMP- und GDP-zertifizierte Partner</b>
                        </span> <br>
                        Wir haben sehr darauf geachtet, dass unsere Partner alle nötigen Zertifizierungen besitzen. Nur so
                        können wir Ihnen eine perfekte Wertschöpfungskette gewährleisten.
                    </p>

                    <p class="my-8">Der Fokus liegt auf:</p>

                    <ul>
                        <li class="my-4">dem Herstellungs- und Verarbeitungsprozess</li>
                        <li class="my-4">dem Analyseprozess</li>
                        <li class="my-4">dem Transportprozess</li>
                        <li class="my-4">dem Lagerungs- und Verpackungsprozess</li>
                        <li class="my-4">dem Vertriebsprozess zu den Apotheken</li>
                    </ul>
                </v-col>
                <v-col cols="12" md="6" class="px-14 py-8">
                    <h1 class="mb-8">Investoren</h1>

                    <p>Investieren Sie jetzt vorausschauend in die Zukunft von medizinischem Cannabis. Eine gute
                        Alternative mit wenig Risiken und Nebenwirkungen.</p>

                    <p>Als Partner können wir Ihnen Sicherheit, Kontinuität, Transparenz und Vertrauen anbieten.</p>

                    <v-btn href="/investoren" color="primary">
                        Mehr Erfahren</v-btn>
                </v-col>
                <v-col cols="12" md="6">
                    <v-img height="550px" src="/storage/investor-3.jpg" position="center right"></v-img>
                </v-col>
            </v-row>
        </section>

        <section>
            <h1 class="my-8">Forschung</h1>

            <p class="primary--text" class="my-4"><b>Forschungsziele</b></p>
            <p>Wir sehen durch die aktuellen Forschungsergebnisse zu Cannabinoiden ein großes Potential in der Behandlung von verschiedenen Krankheitssymptomen.</p>
            <p>Unser Fokus liegt auf folgenden Bereichen:</p>
            <ul>
                <li class="my-4">Empirischer Forschungsansatz</li>
                <li class="my-4">Einsatz von medizinischem Cannabis bei verschiedenen Krankheitssymptomen</li>
                <li class="my-4">Erhebung bisheriger Patientenerfahrungen in Deutschland mit quantitativen Befragungen</li>
                <li class="my-4">Eine qualitative Expertenbefragung von Apothekern zu bisherigen Erfahrung und dem Umgang mit Patienten, die dieses Arzneimittel verschrieben bekommen</li>
                <li class="my-4">Bio-chemische Forschung <br>
                    • Endocannabinoid-System <br>
                    • Wirkungsweise und Zusammenarbeit verschiedener Botenstoffe von Cannabis (THC, CBD, Terpene – Entourage-Effekt)</li>
            </ul>
            <p class="primary--text"><b>Klinische Studien und Fallberichte</b></p>
            <p>Auf den folgenden Webseiten finden Sie klinische Studien zu Cannabis oder einzelnen Cannabinoiden bei verschiedenen Krankheiten und Fallberichte über den Cannabiskonsum von Patienten.</p>
            <p>Sie können nach Krankheiten (Indikationen), Autoren, Medikation, Studiendesign (kontrollierte Studie, offene Studie, Fallbericht usw.) und anderen Kriterien suchen.</p>
            <p><a href="https://www.cannabis-med.org/studies/study.php" class="text--primary">https://www.cannabis-med.org/studies/study.php</a>  (English)</p>
            <p><a href="https://www.cannabis-med.org/german/studies.htm" class="text--primary">https://www.cannabis-med.org/german/studies.htm</a> (Deutsch)</p>
        </section>
    </v-container>
@endsection
