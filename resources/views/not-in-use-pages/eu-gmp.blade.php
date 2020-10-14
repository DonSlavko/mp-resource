@extends('layouts.app')

@section('content')
    <v-parallax
            src="{{ asset('storage/GMP_Neu.jpg') }}"
            height="450"
    >
        <div style="z-index: 1; background: rgba(255,255,255,0.55); mix-blend-mode: normal; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
        <v-row style="z-index: 100;"
               align="center"
               justify="center"
        >
            <v-col class="text-center" style="color: #444444" cols="12">
                <h4 class="text-body-1 font-weight-medium mb-4">GOOD MANUFACTURING PRATICE</h4>
                <h1 class="text-h3 font-weight-bold mb-4">
                    Wir helfen Ihnen gerne bei Ihren <br> GMP – Projekten
                </h1>
                <h4 class="text-body-1 font-weight-medium">
                    Sie möchten eine GMP-Zertifizierung? Bei uns erhalten Sie eine professionale Unterstützung.
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
                    <h2 class="text-h6 mb-3" style="text-transform: uppercase">EU-/GMP Zertifizierung für Europe</h2>
                    <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; width: 50%; border: none;">
                </v-col>
                <v-col cols="12" md="6">
                    <h4>EU-/GMP-zertifiziert für den europäischen Markt</h4>
                    <p>Sie möchten medizinisches Cannabis produzieren, konfektionieren und
                        exportieren/importieren? Wir haben die Möglichkeit, Sie weltweit bei der
                        Umsetzung der aufwendigen EU-GMP (Good Manufacturing Practice) Zertifizierung
                        in Ihrem Unternehmen zu unterstützen.</p>

                    <p>Unser Netzwerk aus qualifizierten Partnern verfügen über langjährige Erfahrung
                        in der Umsetzung. Von der Produktion, Konfektion und der Qualitätskontrolle bis
                        hin zum Transport überprüfen und bewerten wir Ihre gesamte Liefer- und
                        Wertschöpfungskette.</p>

                    <p>Wir bieten Ihnen als <b>zukünftigen Partner</b> eine umfassende Audit- und Beratungsleistung
                        im Bereich GDP (Good Distribution Practice), EU-GMP und Regulatory Compliance an.</p>

                    <p><b>Zukünftiger Partner:</b>
                        Wir haben die Möglichkeit, mit Ihnen einen Exklusivvertrag abzuschließen, bei dem wir
                        die Audit- und die Bezirksregierungskosten übernehmen.
                        <b>Der Nachteil für Sie: Sie binden sich zwischen 1-5 Jahren an uns.</b>
                        Dann haben Sie vorerst leider keine Möglichkeit, an andere Großhändler in Deutschland
                        oder Europa zu verkaufen.</p>

                    <p>Wir wollen Sie in Ihrem EU-Geschäft nicht einschränken, deshalb schlagen wir Ihnen
                        eine <b>faire Option vor</b>.</p>

                    <p><b>Faire Option:</b> Sie übernehmen die Kosten für die Audits (inkl. Bezirksregierung) und
                        zusätzlich <b>die Kosten für die Importlizenz</b> Ihrer hergestellten Produkte. Dies
                        ermöglicht uns den Vertrieb Ihrer Produkte in Deutschland. <b>Der Vorteil für Sie wäre,
                            dass</b> Sie mit weiteren EU-Partnern ohne Einschränkungen zusammenarbeiten können.</p>

                    <p>Wir von Medical Pharma Resource GmbH bestehen nicht auf einen <b>Exklusivvertrag</b>. Wir
                        streben eine dauerhafte Partnerschaft mit Ihnen an.</p>

                    <p><b>Wie können Ihnen weitere Servicetätigkeiten über unsere Partner anbieten:</b></p>

                    <ul>
                        <li class="pb-4">Das Verpacken Ihrer Produkte</li>
                        <li class="pb-4">Das Labeln Ihrer Produkte</li>
                        <li class="pb-6">Die Gammabestrahlung der abgepackten Blüten</li>
                    </ul>

                    <p>Und wenn Sie die Servicetätigkeiten selber übernehmen möchten, so können wir Sie
                        ebenfalls dabei unterstützen.</p>
                </v-col>

                <v-col cols="12" md="6">
                    <v-img height="100%" width="100%" contain
                           src="{{ asset('storage/Europa3.jpg')  }}"></v-img>
                </v-col>

            </v-row>
        </section>

    </v-container>
@endsection
