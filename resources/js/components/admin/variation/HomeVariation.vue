<template>
    <v-container>
        <v-data-table
            show-select
            :footer-props="table.footerProps"
            :headers="table.headers"
            :items="table.data"
            :items-per-page="5"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Variationen</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="primary"
                                dark
                                class="mb-2"
                                v-bind="attrs"
                                v-on="on"
                            >+ Neue Variation
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-form ref="modal">
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field
                                                    :error="errors.name" :error-messages="errors.name"
                                                    :rules="rules" :counter="255"
                                                    v-model="editedItem.name" label="Name"></v-text-field>
                                            </v-col>

                                            <v-col cols="12">
                                                <v-textarea
                                                    v-model="editedItem.description"
                                                    label="Beschreibung"></v-textarea>
                                            </v-col>

                                            <v-col cols="12">
                                                <v-alert v-if="errors.message" type="error">
                                                    {{ errors.message }}
                                                </v-alert>
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
            <template v-slot:item.description="{ item }">
                {{ item.description ? item.description.slice(0, 60) : '-' }}
            </template>
            <template v-slot:item.actions="{ item }">
                <v-btn
                    small
                    class="mr-2"
                    :href="'variation/'+item.id"
                    icon
                >
                    <v-icon small
                    >mdi-magnify
                    </v-icon>
                </v-btn>
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
            <template v-slot:no-data>
                <v-btn color="primary" @click="initialize">Zürücksetzen</v-btn>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
export default {
    name: "HomeVariation",

    data() {
        return {
            table: {
                footerProps: {
                    itemsPerPageAllText: 'Alle',
                    itemsPerPageText: 'Variationen pro Seite:',
                    pageText: '{0}-{1} von {2}',
                },

                headers: [
                    {
                        text: 'ID',
                        value: 'id'
                    },
                    {
                        text: 'Name',
                        value: 'name'
                    },
                    {
                        text: "Beschreibung",
                        value: "description",
                    },
                    {
                        text: "Optionen",
                        value: "actions",
                    },
                ],
                data: []
            },

            errors: [],

            dialog: false,
            editedIndex: -1,

            editedItem: {
                name: '',
                description: '',
            },

            defaultItem: {
                name: '',
                description: '',
            },

            rules: [
                value => !!value || "Name field is required",
                value => value.length <= 255 || "Name must be less than 255 characters long",
            ],
        }
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "Neue Variation" : "Variation bearbeiten"
        },
    },

    watch: {
        dialog(val) {
            val || this.close()
        },
    },

    created() {
        this.initialize()
    },

    methods: {
        initialize() {
            axios.get('/back/variations').then(response => {
                this.table.data = response.data;
            }).catch(error => {
                console.log(error.message);
            });
        },

        editItem(item) {
            this.editedIndex = this.table.data.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            const index = this.table.data.indexOf(item)
            confirm('Möchten Sie dies wirklich löschen?') &&
            axios.delete('/back/variations/' + item.id).then(respones => {
                this.initialize();
            });
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save() {
            if (this.$refs.modal.validate()) {
                if (this.editedIndex > -1) {
                    axios.patch('/back/variations/' + this.editedItem.id, this.editedItem).then((response) => {
                        this.initialize();
                        this.close();
                        this.$toasted.show(response.data)
                    }).catch((error) => {
                        this.errors = error.response.data;
                    });
                } else {
                    axios.post('/back/variations', this.editedItem).then((response) => {
                        this.initialize();
                        this.close();
                        this.$toasted.show(response.data)
                    }).catch((error) => {
                        this.errors = error.response.data;
                    });
                }
            }
        },
    },
}
</script>
