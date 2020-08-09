<template>
    <v-container>
        <v-row>
            <v-col cols="12" md="6">
                <v-stepper v-model="stepper" alt-labels>
                    <v-stepper-header class="m-0 p-0">
                        <v-stepper-step :complete="complete_step1" step="1" :editable="complete > 0">Anmeldedaten
                        </v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step :complete="complete_step2" step="2" :editable="complete > 1">Kontaktdaten
                        </v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step :complete="complete_step3" step="3" :editable="complete > 2">Nachweise
                        </v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step step="4" :editable="complete > 3">Überprüfen</v-stepper-step>
                    </v-stepper-header>

                    <v-stepper-items>
                        <v-stepper-content step="1">
                            <v-form ref="step1">
                                <p class="font-weight-bold text-subtitle-1 mb-2">Ihre Berufsgruppe</p>

                                <v-select
                                    :rules="rules.title"
                                    v-model="input.title"
                                    :items="title"
                                    name="title"
                                    label="Ich bin …*"
                                    outlined dense></v-select>

                                <p class="font-weight-bold text-subtitle-1 mb-2">Anmeldedaten</p>

                                <v-text-field
                                    :error="errors.username" :error-messages="errors.username"
                                    :rules="[rules.username]"
                                    v-model="input.username"
                                    id="username"
                                    name="username"
                                    label="Benutzername *"
                                    type="text"
                                    class="mt-1"
                                    outlined dense></v-text-field>
                                <v-text-field
                                    :rules="rules.password"
                                    v-model="input.password"
                                    id="password"
                                    name="password"
                                    label="Passwort *"
                                    class="mt-1"
                                    outlined dense
                                    :append-icon="show_pass ? 'mdi-eye' : 'mdi-eye-off'"
                                    @click:append="() => (show_pass = !show_pass)"
                                    :type="show_pass ? 'text' : 'password'"
                                ></v-text-field>

                                <v-text-field
                                    :rules="[rules.password_repeat, confirmPassword]"
                                    v-model="input.password_repeat"
                                    id="password_repeat"
                                    name="password_repeat"
                                    type="password"
                                    label="Passwort wiederholen *"
                                    class="mt-10"
                                    outlined dense></v-text-field>
                                <v-text-field
                                    :error="errors.email" :error-messages="errors.email"
                                    :rules="rules.email"
                                    v-model="input.email"
                                    id="email"
                                    name="email"
                                    type="email"
                                    label="Email *"
                                    class="mt-1"
                                    outlined dense></v-text-field>
                                <v-text-field
                                    :rules="[rules.email_repeat.empty, rules.email_repeat.correct, confirmEmail]"
                                    v-model="input.email_repeat"
                                    id="email_repeat"
                                    name="email_repeat"
                                    type="email"
                                    label="Email wiederholen *"
                                    class="mt-1"
                                    outlined dense></v-text-field>

                                <div class="mb-10">(*) Pflichtfelder</div>
                                <v-btn color="primary" @click="validateStep1">weiter</v-btn>
                            </v-form>
                        </v-stepper-content>

                        <v-stepper-content step="2">
                            <v-form ref="step2">
                                <p class="font-weight-bold text-subtitle-1 mb-2">Ansprechpartner\in
                                    (Rechnungsempfänger\in) </p>

                                <v-select
                                    :rules="rules.honorific"
                                    v-model="input.honorific"
                                    :items="honorifics"
                                    name="honorific"
                                    label="Anrede *"
                                    outlined dense></v-select>
                                <v-select
                                    v-model="input.titles"
                                    :items="titles"
                                    name="title"
                                    label="Titel (Präfix)"
                                    outlined dense></v-select>

                                <v-text-field
                                    :rules="rules.first_name"
                                    v-model="input.first_name"
                                    class="mt-1"
                                    label="Vorname *"
                                    id="firstname"
                                    name="first_name"
                                    type="text"
                                    outlined dense></v-text-field>
                                <v-text-field
                                    :rules="rules.last_name"
                                    v-model="input.last_name"
                                    class="mt-1"
                                    label="Nachname *"
                                    id="lastname"
                                    name="last_name"
                                    type="text"
                                    outlined dense></v-text-field>

                                <p class="font-weight-bold text-subtitle-1 mb-2">Kontaktdaten (Liefer- und
                                    Rechnungsadresse)</p>

                                <v-text-field
                                    :rules="rules.pharmacy"
                                    v-model="input.pharmacy"
                                    class="mt-1"
                                    :label="labelForPharmacy"
                                    id="pharmacy"
                                    name="pharmacy"
                                    type="text"
                                    outlined dense></v-text-field>
                                <v-text-field
                                    :rules="rules.street"
                                    v-model="input.street"
                                    class="mt-1"
                                    label="Straße und Hausnr. *"
                                    id="street"
                                    name="street"
                                    type="text"
                                    outlined dense></v-text-field>
                                <v-text-field
                                    v-model="input.address"
                                    class="mt-1"
                                    label="Adresszusatz"
                                    id="address"
                                    name="address"
                                    type="text"
                                    outlined dense></v-text-field>
                                <v-text-field
                                    :rules="rules.postal"
                                    v-model="input.postal"
                                    class="mt-1"
                                    label="Postleitzahl *"
                                    id="postal"
                                    name="postal"
                                    type="text"
                                    outlined dense></v-text-field>
                                <v-text-field
                                    :rules="rules.city"
                                    v-model="input.city"
                                    class="mt-1"
                                    label="Stadt / Ort *"
                                    id="city"
                                    name="city"
                                    type="text"
                                    outlined dense></v-text-field>
                                <v-text-field
                                    :rules="rules.phone"
                                    v-model="input.phone"
                                    class="mt-1"
                                    label="Telefon *"
                                    id="phone"
                                    name="phone"
                                    type="text"
                                    outlined dense></v-text-field>
                                <v-text-field
                                    :rules="rules.fax"
                                    v-model="input.fax"
                                    class="mt-1"
                                    label="Fax *"
                                    id="fax"
                                    name="fax"
                                    type="text"
                                    outlined dense></v-text-field>
                                <div class="mb-10">(*) Pflichtfelder</div>

                                <v-btn color="primary" @click="validateStep2">weiter</v-btn>
                            </v-form>
                        </v-stepper-content>

                        <v-stepper-content step="3">
                            <v-form ref="step3">
                                <p class="font-weight-bold text-subtitle-1 mb-2">Dokumentenupload</p>

                                <v-file-input
                                    :rules="rules.file"
                                    v-model="input.file1"
                                    accept="image/png, image/jpeg, application/pdf"
                                    label="Apothekenzulassung:"
                                    prepend-icon="mdi-paperclip"
                                    outlined
                                    :show-size="1000"
                                    dense
                                    clearable
                                ></v-file-input>
                                <v-file-input
                                    :rules="rules.file"
                                    v-model="input.file2"
                                    accept="image/png, image/jpeg, application/pdf"
                                    label=" BtM-Nummernzuweisung:"
                                    prepend-icon="mdi-paperclip"
                                    outlined
                                    :show-size="1000"
                                    dense
                                    clearable
                                ></v-file-input>
                                <v-file-input
                                    :rules="rules.file"
                                    v-model="input.file3"
                                    accept="image/png, image/jpeg, application/pdf"
                                    label=" Approbation:"
                                    prepend-icon="mdi-paperclip"
                                    outlined
                                    :show-size="1000"
                                    dense
                                    clearable
                                ></v-file-input>

                                <div class="mb-10">(Folgende Dateiformate werden unterstützt: .pdf, .jpg, .png und eine
                                    Dateigröße von max. 6 MB)
                                </div>

                                <v-btn color="primary" @click="validateStep3">weiter</v-btn>
                            </v-form>
                        </v-stepper-content>

                        <v-stepper-content step="4">
                            <v-form ref="step4">
                                <h4>Überprüfen Sie Ihre Angaben</h4>

                                <p>{{ input.title === 'Arzt/Ärztin' ? 'Praxis' : 'Apotheke' }} {{ input.pharmacy }}</p>
                                <p>{{ input.title === 'Arzt/Ärztin' ? 'Arzt' : 'Apotheker' }}: {{
                                        input.honorific + ' ' + input.titles + ' ' + input.first_name + ' ' + input.last_name
                                    }}</p>
                                <p>Adresse: {{
                                        input.street + ' ' + input.address + ', ' + input.postal + ' ' + input.city
                                    }}</p>
                                <p>E-Mail: {{ input.email }}</p>
                                <p>Telefon: {{ input.phone }}</p>
                                <p>Fax: {{ input.fax }}</p>

                                <v-checkbox :rules="rules.checkbox" v-model="input.agree" name="agree"></v-checkbox>

                                <p>Ich habe Gelegenheit gehabt, die Inhalte der</p>
                                <p>Datenschutzerklärung zur Kenntnis zu nehmen und willige in die Datenverarbeitung
                                    meiner
                                    personenbezogenen Daten durch die Medical Pharma Resource GmbH ein. Insbesondere
                                    stimme
                                    ich der Weitergabe meiner personenbezogenen Daten an Dritte im Rahmen von
                                    Auftragsdatenverarbeitungsvereinbarungen zu. Mir ist bekannt, dass ich obige
                                    Einwilligung jederzeit mit Wirkung für die Zukunft durch eine Nachricht an uns
                                    widerrufen kann.*</p>


                                <v-checkbox v-model="input.subscribe" name="subscribe"></v-checkbox>

                                <p>Ich möchte zeitnah über die Verfügbarkeit der Arzneimittel im Onlineshop
                                    benachrichtigt werden.</p>

                                <v-btn color="primary" @click="validateStep4">Registrieren</v-btn>
                            </v-form>
                        </v-stepper-content>
                    </v-stepper-items>
                </v-stepper>
            </v-col>

            <v-col cols="12" md="6">
                <v-btn href="/" text class="text--secondary">Back</v-btn>

                <v-timeline dense align-top>
                    <v-timeline-item large fill-dot icon="mdi-square-edit-outline">
                        <h3>REGISTRIEREN UND NACHWEISERBRINGUNG</h3>

                        Füllen Sie bitte das Registrierungsformular aus und erbringen zusätzlich die verlangten
                        Nachweise. Durch Ihre Registrierung erhalten Sie Zugriff auf den Fachbereich und unseren
                        Onlineshop. Bitte beachten Sie, dass wir unsere Fachinformationen und Produkte nach §10
                        Heilmittelwerbegesetz (HWG) nur engeren medizinischen Fachkreisen wie Ärzten oder Apothekern
                        zugänglich machen dürfen.

                    </v-timeline-item>
                    <v-timeline-item large fill-dot icon="mdi-calendar-check">
                        <h3>REGISTRIERUNG BESTÄTIGEN</h3>

                        Im nächsten Schritt erhalten Sie nach dem Absenden des Registrierungsformulars eine
                        Bestätigungs-E-Mail mit dem Betreff: REGISTRIERUNG BESTÄTIGEN bitte. Sie gilt für Ihre und
                        unsere Sicherheit. Bestätigen Sie Ihre Registrierung, indem Sie auf den Link in der
                        Bestätigungs-E-Mail klicken.

                    </v-timeline-item>

                    <v-timeline-item large fill-dot icon="mdi-card-account-details-outline">
                        <h3>VERIFIZIERUNG UND FREISCHALTUNG</h3>

                        Nachdem Sie Ihre Registrierung bestätigt und wir parallel Ihre hochgeladenen Nachweise
                        erfolgreich verifiziert haben, erhalten Sie zeitnah eine Benachrichtigungs-E-Mail mit dem
                        Betreff: VERIFIZIERUNG UND FREISCHALTUNG erfolgreich abgeschlossen. Falls die Verifizierung
                        nicht erfolgreich abgeschlossen wird, werden Sie zeitnah via E-Mail oder Telefon von uns
                        kontaktiert.

                    </v-timeline-item>

                    <v-timeline-item large fill-dot icon="mdi-account-check">
                        <h3>SUPPORT ZUM ONLINESHOP</h3>

                        Falls Sie aber Fragen zu unserem Onlineshop oder Probleme bei der Registrierung haben, wenden
                        Sie sich bitte an unseren Kundensupport. Sie erreichen uns telefonisch von Montag bis Freitag
                        zwischen 10:00 und 18:00 Uhr unter der 02173 / 940 9591 oder 24/7 per E-Mail unter
                        support@mp-resource.shop. Wir helfen Ihnen gerne!
                    </v-timeline-item>
                </v-timeline>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: "Register",

    data() {
        return {
            stepper: 1,
            complete: 4,
            show_pass: 0,
            complete_step1: false,
            complete_step2: false,
            complete_step3: false,


            title: ['Apotheker/Apothekerin', 'Arzt/Ärztin'],
            titles: [
                'Dipl.-Med.', 'Dr.', 'Dr. med.', 'Dr. rer. nat.', 'Dr. mult.', 'Drs.', 'Dr. Dr.', 'Dr. Dr. med.',
                'Dipl. Ing.', 'Mag.', 'MBA', 'Ph.D.', 'Primar', 'Assoc. Prof.', 'Prof.', 'Prof. Dr.', 'Prof. Dr. h. c.',
                'Prof. Dr. mult.', 'Prof. Dr. med.', 'Prof. Dr. Dr.', 'Prof. Dr. Dr. h. c.',
                'Prof. Dr. Dr. h. c. mult.', 'Prof. Dr. Dr. med.',
            ],
            honorifics: ['Herr', 'Frau'],

            rules: {
                title: [value => !!value || 'Bitte auswählen! '],
                username: value => !!value || 'Bitte geben Sie einen Benutzer-/Loginnamen an! ',
                password: [
                    value => !!value || 'Passwort angeben',
                    value => {
                        const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!\$%&\*?\,\_])(?=.{8,})/;
                        return (
                            pattern.test(value) ||
                            "Minimum 10 Zeichen\n" +
                            "mind. ein Großbuchstaben\n" +
                            "einen Kleinbuchstaben\n" +
                            "eine Zahl\n" +
                            "ein Sonderzeichen ( !$%&?*,_ )"
                        );
                    }
                ],
                password_repeat: value => !!value || 'Passwort wiederholen',
                email: [
                    value => !!value || 'Bitte geben Sie eine gültige E-Mailadresse an',
                    value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Ihre E-Mail sollte ein gültiges Format haben z.B. name@domain.de'
                    },
                ],
                email_repeat: {
                    empty: value => !!value || 'Bitte bestätigen Sie Ihre E-Mailadresse',
                    correct: value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Ihre E-Mail sollte ein gültiges Format haben z.B. name@domain.de'
                    },
                },
                honorific: [value => !!value || 'Bitte auswählen'],
                first_name: [value => !!value || 'Bitte geben Sie Ihren Vornamen an'],
                last_name: [value => !!value || 'Bitte geben Sie Ihren Nachnamen an'],
                pharmacy: [value => !!value || 'Bitte geben Sie einen Namen an!'],
                street: [value => !!value || 'Bitte geben Sie Ihre Adresse an!'],
                postal: [value => !!value || 'Bitte geben Sie eine Postleitzahl an!'],
                city: [value => !!value || 'Bitte geben Sie einen Ort an!'],
                phone: [value => !!value || 'Bitte geben Sie eine Telefonnummer an!'],
                fax: [value => !!value || 'This field is required.'],

                file: [
                    value => !!value || 'No file selected',
                    value => value.size < 6000000,
                ],

                checkbox: [value => !!value || 'Bitte akzeptieren!'],
            },

            input: {
                title: null,
                username: null,
                password: null,
                password_repeat: null,
                email: null,
                email_repeat: null,

                honorific: null,
                titles: null,
                first_name: null,
                last_name: null,
                pharmacy: null,
                street: null,
                address: null,
                postal: null,
                city: null,
                phone: null,
                fax: null,

                file1: null,
                file2: null,
                file3: null,

                agree: null,
                subscribe: null,
            },

            errors: {
                email: null,
                username: null,
            },

            form: {
                email: null,
                pass: null,
                remember: null
            }
        }
    },

    watch: {
        "input.username": function(username) {
            this.checkIfUsernameExists(username)
        },

        "input.email": function(email) {
            this.checkIfEmailExists(email)
        },
    },

    computed: {
        confirmPassword() {
            return (this.input.password === this.input.password_repeat) || 'Die Passwörter stimmen nicht überein';
        },

        confirmEmail() {
            return (this.input.email === this.input.email_repeat) || 'E-Mail stimmt nicht überein';
        },

        labelForPharmacy() {
            return this.input.title === 'Arzt/Ärztin' ? 'Name der Praxis' : 'Name der Apotheke';
        }
    },

    methods: {
        validateStep1() {
            if (this.$refs.step1.validate()) {
                this.complete_step1 = true;
                this.complete = this.stepper = 2;
            }
        },

        checkIfUsernameExists: _.debounce(function(value) {
            axios.post('/exists', {
                username: value
            }).then((response) => {
                if (response.data.value) {
                    this.errors.username = 'Benutzername existiert bereits.';
                }
            })
        }, 100),

        checkIfEmailExists: _.debounce(function(value) {
            axios.post('/exists', {
                email: value
            }).then((response) => {
                if (response.data.value) {
                    this.errors.email = 'E-Mail existiert bereits.';
                }
            })
        }, 100),

        validateStep2() {
            if (this.$refs.step2.validate()) {
                this.complete_step2 = true;
                this.complete = this.stepper = 3;
            }
        },

        validateStep3() {
            if (this.$refs.step3.validate()) {
                this.complete_step3 = true;
                this.complete = this.stepper = 4;
            }
        },

        formData() {
            let form = new FormData();

            form.append("title", this.input.title);
            form.append("username", this.input.username);
            form.append("password", this.input.password);
            form.append("email", this.input.email);

            form.append("honorific", this.input.honorific);
            form.append("titles", this.input.titles);
            form.append("first_name", this.input.first_name);
            form.append("last_name", this.input.last_name);
            form.append("pharmacy", this.input.pharmacy);
            form.append("street", this.input.street);
            form.append("street", this.input.street);
            form.append("address", this.input.address);
            form.append("postal", this.input.postal);
            form.append("city", this.input.city);
            form.append("phone", this.input.phone);
            form.append("fax", this.input.fax);

            form.append("file1", this.input.file1, this.input.file1.name);
            form.append("file2", this.input.file2, this.input.file2.name);
            form.append("file3", this.input.file3, this.input.file3.name);

            form.append("agree", this.input.agree);
            form.append("subscribe", this.input.subscribe);

            return form;
        },

        validateStep4() {
            if (this.$refs.step4.validate()) {
                axios.post('register', this.formData(), {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((response) => {
                    window.location = "/"
                }).catch((error) => {
                    console.log(error.response.data.errors)
                   // let errors = error.response.data.errors;
                });
            }
        }
    }
}
</script>

<style scoped>

</style>
