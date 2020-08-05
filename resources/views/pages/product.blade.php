@extends('layouts.app')

@section('content')
    <v-parallax
            src="{{ asset('storage/produkte-1.jpg') }}"
            height="450"
    >
        <div style="z-index: 1; background: rgba(255,255,255,0.55); mix-blend-mode: normal; position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
        <v-row style="z-index: 100;"
                align="center"
                justify="center"
        >
            <v-col class="text-center" style="color: #444444" cols="12">
                <h4 class="text-body-1 font-weight-medium mb-4">PRODUKTE</h4>
                <h1 class="text-h3 font-weight-bold mb-4">Eine gute therapeutische und <br> medizinische Alternative</h1>
                <h4 class="text-body-1 font-weight-medium">
                    Bei der Therapie/Behandlung mit medizinischen Cannabisprodukten steht die
                    <br>Reduzierung von Schmerzen und Krankheitssymptomen im Mittelpunkt.
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
                    <h2 class="text-h6" style="text-transform: uppercase">Cannabis die Heilpflanze</h2>
                    <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; width: 50%; border: none;">
                </v-col>
                <v-col cols="12" md="6">
                    <h4>Entourage-Effekt</h4>
                    <p>Die Bezeichnung „Entourage-Effekt“ stammt aus der Cannabis–Forschung und beschreibt ein
                        therapeutisches Zusammenspiel zwischen Cannabinoide und Terpenoide. Diese definiert, dass ein
                        Pflanzenstoffgemisch eine höhere biologische Aktivität besitzt als die isolierte Reinsubstanz selbst.</p>

                    <h4>Cannabinoide</h4>
                    <p>Cannabinoide sind ein Sammelbegriff für alle Stoffe, die über die Cannabinoid Rezeptoren
                        wirken. Bis heute wurden mehr als 100 solcher Cannabinoide in der Cannabispflanze
                        nachgewiesen und extrahiert. Dabei ist interessant, dass Cannabinoide nicht nur in
                        der Hanfpflanze vorkommen, sondern auch in manchen Pilzen und Bakterien. Von den
                        bisher mehr als 100 verschiedenen Cannabinoiden sind vor allem THC, CBD, CBC und
                        CBG die bekanntesten.</p>

                </v-col>
                <v-col cols="12" md="6">
                    <h4>Terpene und Terpenoide</h4>
                    <p>Terpene sind eine Gruppierung chemischer Verbindungen und kommen in natürlichen Organismen vor.
                        Ätherische Öle sind zum Beispiel reich an Terpenen. Ihnen wird eine antimikrobielle Eigenschaft
                        zugeschrieben, was für den medizinischen Einsatz sehr interessant ist, da Infektionen oder auch
                        das Wachstum von Mikroorganismen gehemmt werden können. Dabei sind Terpene in Fetten sehr gut
                        löslich, in Wasser hingegen eher schwer. Daher sind sie vor allem in ätherischen Ölen vorhanden.
                        Mit einem Vaporizer können die Terpene gezielt durch die genaue Bestimmung der
                        Verdampfungstemperatur verdampft werden.</p>

                    <h4>Flavonoide</h4>
                    <p>Die Flavonoide sind in der Cannabispflanze für den Geruch, Farbe wie auch den Geschmack
                        verantwortlich und dienen den Pflanzen vor allem dem Schutz vor der UV-Strahlung.
                        Die Flavonoide werden vor allem über die Nahrung, also über Obst und Gemüse, aufgenommen.
                        Bisher sind den Forschern rund 8.000 Flavonoide bekannt, jedoch sind längst nicht alle
                        Flavonoide eingehend erforscht.</p>
                </v-col>

                <v-col cols="12">
                    <h2 class="text-center text-h6 mt-14" style="text-transform: uppercase">Terpenenmatrix</h2>
                    <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; width: 100%; border: none;">
                </v-col>

                <v-col cols="12">
                    <v-img src="{{ asset('storage/Tperne_DE.jpg')  }}"></v-img>
                </v-col>

                <v-col cols="12">
                    <h2 class="text-h6 mt-14" style="text-transform: uppercase">Produkte</h2>
                    <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; width: 50%; border: none;">
                </v-col>

                <v-col cols="12" md="6">

                    <h4>EU-/GMP- und GDP- zertifizierte Qualität</h4>
                    <p>Unsere medizinischen Cannabisprodukte werden sich durch eine gleichbleibende Qualität
                        auf höchstem Niveau auszeichnen.</p>

                        <p>Unser Ziel ist es eine große Vielfalt an medizinischen Cannabisprodukten anzubieten,
                            um eine bessere Verfügbarkeit für die zu behandelnden Krankheitssymptome zu
                            gewährleisten.</p>

                        <p>Unser Sortiment wird ausschließlich über unseren eigenen Onlineshop zur
                            Verfügung stehen.
                        </p>

                        <p>Die Regelungen des Betäubungsmittelgesetzes (BtMG) sehen ein Verbot der
                            Werbung für Cannabis vor, da Cannabis der Anlage III des BtMG zugeordnet ist.
                            Wir dürfen als Anbieter keinerlei Hinweise zu den Produkten geben oder gar werblich
                            tätig werden. Verstöße gegen dieses Verbot stellen eine Straftat dar.</p>


                        <p>Zudem ist folgendes in § 10 Heilmittelwerbegesetz (HWG) festgehalten: Für
                            verschreibungspflichtige Arzneimittel darf nur bei Fachkreisen im engeren
                            Sinne geworben werden. Das sind Ärzte, Tierärzte, Apotheker und Personen, die
                            mit diesen Arzneimitteln erlaubterweise Handel betreiben.</p>

                        <p>Ausführliche Informationen für Ärzte und Apotheker finden Sie in unseren Online-Shop.
                        Sie müssen sich nur bei uns registrieren. Personen aus dem Nicht-Fachkreis, wenden
                        Sie sich bitte an Ihren behandelnden Arzt oder Apotheker, um weitere Informationen
                        über den Wirkstoff und seine therapeutischen Einsatzmöglichkeiten zu erhalten.</p>


                </v-col>

                <v-col cols="12" md="6">
                    <v-img position="bottom left" height="100%" width="100%" sizes="cover" src="{{ asset('storage/AdobeStock_310714620-scaled.jpeg')  }}"></v-img>
                </v-col>

                <v-col cols="12">
                    <h2 class="text-center text-h6 mt-14" style="text-transform: uppercase">Produktpalette - MPRCanna®</h2>
                </v-col>

                <v-col offset-md="1" cols="10">
                    <v-img src="{{ asset('storage/MPRCanna.docx-Word.png')  }}"></v-img>
                </v-col>

            </v-row>
        </section>

    </v-container>
@endsection
