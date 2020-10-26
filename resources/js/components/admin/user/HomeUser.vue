<template>
    <v-container>
        <v-data-table
            show-select
            :footer-props="table.footerProps"
            :headers="table.headers"
            :items="table.data"
            :items-per-page="5"
            class="elevation-1">
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Benutzer</v-toolbar-title>

                    <v-dialog v-model="dialog" max-width="1000px">
                        <v-card>
                            <v-card-title>
                                <span class="headline">Benutzer bearbeiten</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-form ref="modal">
                                        <v-row>
                                            <v-col cols="12" md="6">
                                                <v-text-field
                                                    :error="errors.username" :error-messages="errors.username"
                                                    :rules="rules.username"
                                                    v-model="editedItem.username"
                                                    id="username"
                                                    name="username"
                                                    label="Benutzername *"
                                                    type="text"
                                                    class="mt-1"
                                                    outlined dense></v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="6">
                                                <v-text-field
                                                    :error="errors.email" :error-messages="errors.email"
                                                    :rules="rules.email"
                                                    v-model="editedItem.email"
                                                    onCopy="return false"
                                                    onDrag="return false"
                                                    onDrop="return false"
                                                    onPaste="return false"
                                                    id="email"
                                                    name="email"
                                                    type="email"
                                                    label="Email *"
                                                    class="mt-1"
                                                    outlined dense></v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="6">
                                                <v-text-field
                                                    :rules="rules.first_name"
                                                    v-model="editedItem.first_name"
                                                    class="mt-1"
                                                    label="Vorname *"
                                                    id="firstname"
                                                    name="first_name"
                                                    type="text"
                                                    outlined dense></v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="6">
                                                <v-text-field
                                                    :rules="rules.last_name"
                                                    v-model="editedItem.last_name"
                                                    class="mt-1"
                                                    label="Nachname *"
                                                    id="lastname"
                                                    name="last_name"
                                                    type="text"
                                                    outlined dense></v-text-field>
                                            </v-col>


                                            <v-col cols="12" md="4">
                                                <v-select
                                                    :rules="rules.title"
                                                    v-model="editedItem.title"
                                                    :items="title"
                                                    name="title"
                                                    label="Ich bin …*"
                                                    outlined dense></v-select>
                                            </v-col>

                                            <v-col cols="12" md="4">
                                                <v-select
                                                    :rules="rules.honorific"
                                                    v-model="editedItem.honorific"
                                                    :items="honorifics"
                                                    name="honorific"
                                                    label="Anrede *"
                                                    outlined dense></v-select>
                                            </v-col>

                                            <v-col cols="12" md="4">
                                                <v-select
                                                    v-model="editedItem.titles"
                                                    :items="titles"
                                                    name="title"
                                                    label="Titel (Präfix)"
                                                    outlined dense></v-select>
                                            </v-col>


                                            <v-col cols="12" md="6">
                                                <v-text-field
                                                    :rules="rules.pharmacy"
                                                    v-model="editedItem.pharmacy"
                                                    class="mt-1"
                                                    :label="labelForPharmacy"
                                                    id="pharmacy"
                                                    name="pharmacy"
                                                    type="text"
                                                    outlined dense></v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="6">
                                                <v-text-field
                                                    :rules="rules.street"
                                                    v-model="editedItem.street"
                                                    class="mt-1"
                                                    label="Straße und Hausnr. *"
                                                    id="street"
                                                    name="street"
                                                    type="text"
                                                    outlined dense></v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="4">
                                                <v-text-field
                                                    v-model="editedItem.address"
                                                    class="mt-1"
                                                    label="Adresszusatz"
                                                    id="address"
                                                    name="address"
                                                    type="text"
                                                    outlined dense></v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="4">
                                                <v-text-field
                                                    :rules="rules.postal"
                                                    v-model="editedItem.postal"
                                                    class="mt-1"
                                                    label="Postleitzahl *"
                                                    id="postal"
                                                    name="postal"
                                                    type="text"
                                                    outlined dense></v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="4">
                                                <v-text-field
                                                    :rules="rules.city"
                                                    v-model="editedItem.city"
                                                    class="mt-1"
                                                    label="Stadt / Ort *"
                                                    id="city"
                                                    name="city"
                                                    type="text"
                                                    outlined dense></v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="6">
                                                <v-text-field
                                                    :rules="rules.phone"
                                                    v-model="editedItem.phone"
                                                    class="mt-1"
                                                    label="Telefon *"
                                                    id="phone"
                                                    name="phone"
                                                    type="text"
                                                    outlined dense></v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="6">
                                                <v-text-field
                                                    :rules="rules.fax"
                                                    v-model="editedItem.fax"
                                                    class="mt-1"
                                                    label="Fax *"
                                                    id="fax"
                                                    name="fax"
                                                    type="text"
                                                    outlined dense></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-form>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close">Schließen</v-btn>
                                <v-btn color="blue darken-1" text @click="save">Geschäft</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>

            <template v-slot:item.btmnr="{ item }">
                <v-btn v-if="item.files.length" small dense @click="showFiles(item)">Show Files</v-btn>
                <v-btn v-else small dense disabled>No Files</v-btn>

                <v-list-item-group color="primary" v-if="item.show_files">
                    <template v-for="file in item.files">
                        <v-list-item dense>
                            <v-list-item-content>
                                <a :href="file.path" download>{{ file.name }}</a>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-list-item-group>
            </template>

            <template v-slot:item.email_verified="{ item }">
                <span v-if="item.email_verified_at === null">Email nicht bestätigt</span>
                <span v-else>Email bestätigt</span>
            </template>

            <template v-slot:item.activated="{ item }">
                <v-btn small dense v-if="item.active" @click="deactivateAcc(item)">Sperren</v-btn>
                <v-btn small dense v-else @click="activateAcc(item)">Freischalten</v-btn>
            </template>

            <template v-slot:item.actions="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil</v-icon>
                <v-icon small @click="deleteItem(item)"> mdi-delete</v-icon>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
export default {
    name: "HomeUser",

    data() {
        return {
            tab: null,
            declinedData: [],
            deleteAllBtn: false,
            table: {
                footerProps: {
                    itemsPerPageAllText: 'Alle',
                    itemsPerPageText: 'Benutzer pro Seite:',
                    pageText: '{0}-{1} von {2}',
                },
                headers: [
                    {
                        text: 'ID',
                        value: 'id',
                    },
                    {
                        text: 'Benutzername',
                        value: 'username',
                    },
                    {
                        text: 'Name',
                        value: 'name',
                        sortable: false,
                    },
                    {
                        text: 'Email',
                        value: 'email',
                    },
                    {
                        text: 'Rolle',
                        value: 'role',
                        sortable: false,
                    },
                    {
                        text: 'Dokumente',
                        value: 'btmnr',
                        sortable: false,
                    },
                    {
                        text: 'Registriert seit',
                        value: 'created_at',
                        sortable: false,
                    },
                    {
                        text: 'Email bestätigt',
                        value: 'email_verified',
                        sortable: false,
                    },
                    {
                        text: 'Status',
                        value: 'activated',
                        sortable: false,
                    },
                    {
                        text: "Optionen",
                        value: "actions",
                        sortable: false,
                    },
                ],
                data: [],
            },
            declinedTable: {
                headers: [
                    {
                        text: 'ID',
                        value: 'id',
                    },
                    {
                        text: 'Username',
                        value: 'username',
                    },
                    {
                        text: 'Name',
                        value: 'name',
                        sortable: false,
                    },
                    {
                        text: 'Email',
                        value: 'email',
                    },
                    {
                        text: 'Phone',
                        value: 'phone',
                    },
                    {
                        text: 'Action',
                        value: 'action'
                    }
                ],
                data: []
            },

            dialog: false,
            editedIndex: -1,

            editedItem: {
                username: null,
                email: null,
                titles: null,
                honorific: null,
                title: null,
                first_name: null,
                last_name: null,
                pharmacy: null,
                street: null,
                address: null,
                postal: null,
                city: null,
                phone: null,
                fax: null,
            },

            defaultItem: {
                username: null,
                email: null,
                titles: null,
                honorific: null,
                title: null,
                first_name: null,
                last_name: null,
                pharmacy: null,
                street: null,
                address: null,
                postal: null,
                city: null,
                phone: null,
                fax: null,
            },

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
                username: [value => !!value || 'Bitte geben Sie einen Benutzer-/Loginnamen an! '],
                email: [
                    value => !!value || 'Bitte geben Sie eine gültige E-Mailadresse an',
                    value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Ihre E-Mail sollte ein gültiges Format haben z.B. name@domain.de'
                    },
                ],
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

            errors: {
                email: null,
                username: null,
            },
        }
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        },

        labelForPharmacy() {
            return this.editedItem.title === 'Arzt/Ärztin' ? 'Name der Praxis' : 'Name der Apotheke';
        },
    },

    watch: {
        dialog(val) {
            val || this.close()
        },

        "editedItem.username": function (username) {
            this.checkIfUsernameExists(username)
        },

        "editedItem.email": function (email) {
            this.checkIfEmailExists(email)
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            axios.get('/back/users').then(response => {
                this.table.data = response.data.data.map(item => {
                    let date = new Date(item.created_at);
                    let year = date.getFullYear();
                    let month = (1 + date.getMonth()).toString().padStart(2, '0');
                    let day = date.getDate().toString().padStart(2, '0');

                    item.created_at = year + '/' + month + '/' + day;

                    item.show_files = false;
                    return item;
                })
            })
        },

        showFiles(item) {
            item.show_files = !item.show_files;
        },

        activateAcc(item) {
            axios.post('/back/users/' + item.id + '/activate').then(response => {
                this.$toasted.show(response.data.message);
                item.active = true;
                this.declinedUsers();
                this.initialize();
            });
        },

        deactivateAcc(item) {
            axios.post('/back/users/' + item.id + '/deactivate').then(response => {
                this.$toasted.show(response.data.message);
                item.active = false;
                this.declinedUsers();
                this.initialize();
            });
        },

        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        editItem(item) {
            this.editedIndex = item.id;

            this.editedItem = {
                username: item.username,
                email: item.email,
                titles: item.titles,
                honorific: item.honorific,
                title: item.title,
                first_name: item.first_name,
                last_name: item.last_name,
                pharmacy: item.pharmacy,
                street: item.street,
                address: item.address,
                postal: item.postal,
                city: item.city,
                phone: item.phone,
                fax: item.fax,
            };

            this.dialog = true;
        },

        deleteItem(item) {
            if (confirm('Are you sure?')) {
                axios.delete('/back/users/' + item.id).then(response => {
                    this.$toasted.show(response.data.message);
                    this.declinedUsers();
                    this.initialize();
                });
            }
        },

        formData() {
            let form = {};

            if (this.editedItem.title) {
                form.title =  this.editedItem.title;
            }
            if (this.editedItem.username) {
                form.username = this.editedItem.username;
            }
            if (this.editedItem.email) {
                form.email = this.editedItem.email;
            }
            if (this.editedItem.honorific) {
                form.honorific = this.editedItem.honorific;
            }
            if (this.editedItem.titles) {
                form.titles = this.editedItem.titles;
            }
            if (this.editedItem.first_name) {
                form.first_name = this.editedItem.first_name;
            }
            if (this.editedItem.last_name) {
                form.last_name = this.editedItem.last_name;
            }
            if (this.editedItem.pharmacy) {
                form.pharmacy = this.editedItem.pharmacy;
            }
            if (this.editedItem.street) {
                form.street = this.editedItem.street;
            }
            if (this.editedItem.address) {
                form.address = this.editedItem.address;
            }
            if (this.editedItem.postal) {
                form.postal = this.editedItem.postal;
            }
            if (this.editedItem.city) {
                form.city = this.editedItem.city;
            }
            if (this.editedItem.phone) {
                form.phone = this.editedItem.phone;
            }
            if (this.editedItem.fax) {
                form.fax = this.editedItem.fax;
            }

            return form;
        },

        save() {
            let form = this.formData();

            if (this.$refs.modal.validate()) {
                axios.patch(
                    "/back/users/" + this.editedIndex,
                    form,
                ).then((response) => {
                    this.initialize();
                    this.close();
                    this.$toasted.show(response.data);
                }).catch((error) => {
                    this.errors = error.response.data;
                });
            }
        },

        checkIfUsernameExists: _.debounce(function (value) {
            axios.post('/exists', {
                username: value,
                edit: this.editedIndex
            }).then((response) => {
                if (response.data.value) {
                    this.errors.username = 'Benutzername existiert bereits.';
                }
            })
        }, 100),

        checkIfEmailExists: _.debounce(function (value) {
            axios.post('/exists', {
                email: value,
                edit: this.editedIndex
            }).then((response) => {
                if (response.data.value) {
                    this.errors.email = 'E-Mail existiert bereits.';
                }
            })
        }, 100),
    },
}
</script>
