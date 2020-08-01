@extends('layouts.auth')

@section('content')
<v-container>
    <v-row>
        <v-col cols="6">
            <v-stepper v-model="e1" alt-labels>
                <v-stepper-header class="m-0 p-0">
                    <v-stepper-step :complete="e1 > 1" step="1" editable>Anmeldedaten</v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step :complete="e1 > 2" step="2" editable>Kontaktdaten</v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step :complete="e1 > 3" step="3" editable>Nachweise</v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step step="4" editable>Überprüfen</v-stepper-step>
                </v-stepper-header>

                <v-stepper-items>
                    <v-stepper-content step="1">
                        <p class="font-weight-bold text-subtitle-1 mb-2">Ihre Berufsgruppe</p>

                        <v-select :items="items" label="Ich bin …*" outlined dense></v-select>

                        <p class="font-weight-bold text-subtitle-1 mb-2">Anmeldedaten</p>

                        <v-text-field class="mt-1" label="Benutzername *" id="username" name="username" type="text" outlined dense></v-text-field>
                        <v-text-field class="mt-1" label="Passwort *" id="password" name="password" type="password" outlined dense></v-text-field>

                        <v-text-field class="mt-10" label="Passwort wiederholen *" id="password_repeat" name="password_repeat" type="password" outlined dense></v-text-field>
                        <v-text-field class="mt-1" label="Email *" id="email" name="email" type="email" outlined dense></v-text-field>
                        <v-text-field class="mt-1" label="Email wiederholen *" id="email_repeat" name="email_repeat" type="email" outlined dense></v-text-field>

                        <div class="mb-10">(*) Pflichtfelder</div>
                        <v-btn color="primary" @click="e1 = 2">weiter</v-btn>
                    </v-stepper-content>

                    <v-stepper-content step="2">
                        <p class="font-weight-bold text-subtitle-1 mb-2">Ansprechpartner\in (Rechnungsempfänger\in) </p>
                        <v-select :items="items" label="Anrede *" outlined dense></v-select>
                        <v-select :items="items" label="Titel (Präfix)" outlined dense></v-select>

                        <v-text-field class="mt-1" label="Vorname *" id="firstname" name="first_name" type="text" outlined dense></v-text-field>
                        <v-text-field class="mt-1" label="Nachname *" id="lastname" name="last_name" type="text" outlined dense></v-text-field>

                        <p class="font-weight-bold text-subtitle-1 mb-2">Kontaktdaten (Liefer- und Rechnungsadresse)</p>

                        <v-text-field class="mt-1" label="Name der Praxis" id="practice" name="practice" type="text" outlined dense></v-text-field>
                        <v-text-field class="mt-1" label="Straße und Hausnr. *" id="street" name="lastname" type="text" outlined dense></v-text-field>
                        <v-text-field class="mt-1" label="Adresszusatz" id="address" name="address" type="text" outlined dense></v-text-field>
                        <v-text-field class="mt-1" label="Postleitzahl *" id="postal" name="postal" type="text" outlined dense></v-text-field>
                        <v-text-field class="mt-1" label="Stadt / Ort *" id="city" name="city" type="text" outlined dense></v-text-field>
                        <v-text-field class="mt-1" label="Telefon *" id="phone" name="phone" type="text" outlined dense></v-text-field>
                        <v-text-field class="mt-1" label="Fax *" id="fax" name="fax" type="text" outlined dense></v-text-field>

                        <div class="mb-10">(*) Pflichtfelder</div>
                        <v-btn color="primary" @click="e1 = 2">zurück</v-btn>
                        <v-btn color="primary" @click="e1 = 2">weiter</v-btn>
                    </v-stepper-content>

                    <v-stepper-content step="3">
                        <p class="font-weight-bold text-subtitle-1 mb-2">Dokumentenupload</p>

                        <v-file-input
                            v-model="files"
                            label="Apothekenzulassung:"
                            prepend-icon="mdi-paperclip"
                            outlined
                            :show-size="1000"
                            dense
                            clearable
                        ></v-file-input>
                        <v-file-input
                            v-model="files"
                            label=" BtM-Nummernzuweisung:"
                            prepend-icon="mdi-paperclip"
                            outlined
                            :show-size="1000"
                            dense
                            clearable
                        ></v-file-input>
                        <v-file-input
                            v-model="files"
                            label=" Approbation:"
                            prepend-icon="mdi-paperclip"
                            outlined
                            :show-size="1000"
                            dense
                            clearable
                        ></v-file-input>

                        <div class="mb-10">(Folgende Dateiformate werden unterstützt: .pdf, .jpg, .png und eine Dateigröße von max. 6 MB)</div>
                        <v-btn color="primary" @click="e1 = 2">zurück</v-btn>
                        <v-btn color="primary" @click="e1 = 2">weiter</v-btn>
                    </v-stepper-content>

                    <v-stepper-content step="4">
                        Überprüfen Sie Ihre Angaben

                        Praxis 	asdasd
                        Arzt: 	Herr Dr. rer. nat. adasdaasda asdasdas
                        Adresse: 	asdasd asdasd, sdasdas dasdasda
                        E-Mail: 	example@demo.com
                        Telefon: 	sdasdasd
                        Fax: 	asdasd

                        <!--checkbox-->

                        Ich habe Gelegenheit gehabt, die Inhalte der Datenschutzerklärung zur Kenntnis zu nehmen und willige in die Datenverarbeitung meiner personenbezogenen Daten durch die Medical Pharma Resource GmbH ein. Insbesondere stimme ich der Weitergabe meiner personenbezogenen Daten an Dritte im Rahmen von Auftragsdaten­verarbeitungs­vereinbarungen zu. Mir ist bekannt, dass ich obige Einwilligung jederzeit mit Wirkung für die Zukunft durch eine Nachricht an uns widerrufen kann.*

                        <!--checkbox-->

                        Ich möchte zeitnah über die Verfügbarkeit der Arzneimittel im Onlineshop benachrichtigt werden.
                    </v-stepper-content>
                </v-stepper-items>
            </v-stepper>
        </v-col>

        <v-col cols="6">
            <v-timeline dense align-top>
                <v-timeline-item large fill-dot icon="mdi-square-edit-outline">
                    <h3>REGISTRIEREN UND NACHWEISERBRINGUNG</h3>

                    Füllen Sie bitte das Registrierungsformular aus und erbringen zusätzlich die verlangten Nachweise. Durch Ihre Registrierung erhalten Sie Zugriff auf den Fachbereich und unseren Onlineshop. Bitte beachten Sie, dass wir unsere Fachinformationen und Produkte nach §10 Heilmittelwerbegesetz (HWG) nur engeren medizinischen Fachkreisen wie Ärzten oder Apothekern zugänglich machen dürfen.

                </v-timeline-item>
                <v-timeline-item large fill-dot icon="mdi-calendar-check">
                    <h3>REGISTRIERUNG BESTÄTIGEN</h3>

                    Im nächsten Schritt erhalten Sie nach dem Absenden des Registrierungsformulars eine Bestätigungs-E-Mail mit dem Betreff: REGISTRIERUNG BESTÄTIGEN bitte. Sie gilt für Ihre und unsere Sicherheit. Bestätigen Sie Ihre Registrierung, indem Sie auf den Link in der Bestätigungs-E-Mail klicken.

                </v-timeline-item>

                <v-timeline-item large fill-dot icon="mdi-card-account-details-outline">
                    <h3>VERIFIZIERUNG UND FREISCHALTUNG</h3>

                    Nachdem Sie Ihre Registrierung bestätigt und wir parallel Ihre hochgeladenen Nachweise erfolgreich verifiziert haben, erhalten Sie zeitnah eine Benachrichtigungs-E-Mail mit dem Betreff: VERIFIZIERUNG UND FREISCHALTUNG erfolgreich abgeschlossen. Falls die Verifizierung nicht erfolgreich abgeschlossen wird, werden Sie zeitnah via E-Mail oder Telefon von uns kontaktiert.

                </v-timeline-item>

                <v-timeline-item large fill-dot icon="mdi-account-check">
                    <h3>SUPPORT ZUM ONLINESHOP</h3>

                    Falls Sie aber Fragen zu unserem Onlineshop oder Probleme bei der Registrierung haben, wenden Sie sich bitte an unseren Kundensupport. Sie erreichen uns telefonisch von Montag bis Freitag zwischen 10:00 und 18:00 Uhr unter der 02173 / 940 9591 oder 24/7 per E-Mail unter support@mp-resource.shop.  Wir helfen Ihnen gerne!
                </v-timeline-item>
            </v-timeline>
        </v-col>
    </v-row>
</v-container>
@endsection
