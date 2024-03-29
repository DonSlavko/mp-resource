<template>
    <v-container>
        <v-data-table
            show-select
            :footer-props="table.footerProps"
            :headers="table.headers"
            :items="table.orders"
            :items-per-page="5"
            class="elevation-1">
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Bestellungen</v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on"
                            >CSV Exportieren
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="headline">CSV Exportieren</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-select
                                                v-model="dateSelect"
                                                :items="dateSelectors"
                                                name="brand_id"
                                                label="Select interval"
                                                outlined
                                                dense
                                            ></v-select>
                                        </v-col>

                                        <v-col cols="12" v-if="dateSelect === 4">
                                            <v-menu
                                                v-model="datePicker1"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                transition="scale-transition"
                                                offset-y
                                                min-width="290px"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="dateStart"
                                                        label="Start date"
                                                        readonly
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        outlined
                                                        dense
                                                    ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="dateStart"
                                                    @input="datePicker1 = false"
                                                ></v-date-picker>
                                            </v-menu>
                                        </v-col>
                                        <v-col cols="12" v-if="dateSelect === 4">
                                            <v-menu
                                                v-model="datePicker2"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                transition="scale-transition"
                                                offset-y
                                                min-width="290px"
                                            >
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-text-field
                                                        v-model="dateEnd"
                                                        label="End date"
                                                        readonly
                                                        v-bind="attrs"
                                                        v-on="on"
                                                        outlined
                                                        dense
                                                    ></v-text-field>
                                                </template>
                                                <v-date-picker
                                                    v-model="dateEnd"
                                                    @input="datePicker2 = false"
                                                ></v-date-picker>
                                            </v-menu>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close">Schließen</v-btn>
                                <v-btn color="blue darken-1" text @click="exportCsv()"
                                       :disabled="!canExport">Export
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.products="{ item }">
                {{ item.carts.length }}
            </template>
            <template v-slot:item.price="{ item }">
                {{ item.total_price }} €
            </template>
            <template v-slot:item.date="{ item }">
                {{ getDate(item.created_at) }}
            </template>

            <template v-slot:item.files="{ item }">
                <v-btn v-if="item.file1 && item.file2" small dense @click="showFiles(item)">
                    Show Files
                </v-btn>
                <v-btn v-else small dense disabled>No Files</v-btn>

                <v-list-item-group color="primary" v-if="item.show_files">
                    <v-list-item dense v-if="item.file1">
                        <v-list-item-content>
                            <a :href="item.file1" download>Apothekenzulassung</a>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item dense v-if="item.file2">
                        <v-list-item-content>
                            <a :href="item.file2" download>BtM-Nummernzuweisung</a>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </template>

            <template v-slot:item.options="{ item }">
                <v-btn v-if="item.status === 'On hold'"
                       @click="approve(item)"
                       small icon color="primary">
                    <v-icon>
                        mdi-check
                    </v-icon>
                </v-btn>
                <v-btn v-if="item.status === 'On hold'"
                       @click="denied(item)"
                       small icon color="red">
                    <v-icon>
                        mdi-close
                    </v-icon>
                </v-btn>


                <v-btn
                    :href="'/back/order-download/'+item.id"
                    small icon color="green">
                    <v-icon>
                        mdi-download
                    </v-icon>
                </v-btn>
            </template>
            <template v-slot:no-data>
                <v-btn color="primary" @click="initialize">Zürücksetzen</v-btn>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
export default {
    name: "HomeOrder",

    data() {
        return {
            table: {
                footerProps: {
                    itemsPerPageAllText: 'Alle',
                    itemsPerPageText: 'Bestellungen pro Seite:',
                    pageText: '{0}-{1} von {2}',
                },

                headers: [
                    {
                        text: 'ID',
                        value: 'id'
                    },
                    {
                        text: 'Benutzername',
                        value: 'user.username'
                    },
                    {
                        text: 'Anzahl der Produkte',
                        value: 'products',
                        sortable: false,
                    },
                    {
                        text: 'Preis',
                        value: 'price',
                        sortable: false,
                    },
                    {
                        text: 'Status',
                        value: 'status',
                        sortable: false
                    },
                    {
                        text: 'Datum',
                        value: 'date',
                        sortable: false,
                    },
                    {
                        text: 'Dokumente',
                        value: 'files',
                        sortable: false,
                    },
                    {
                        text: 'Optionen',
                        value: 'options',
                        sortable: false
                    }
                ],
                orders: [],
            },
            dialog: false,

            dateSelectors: [
                {
                    text: 'Today',
                    value: 1
                },
                {
                    text: 'Last Week',
                    value: 2
                },
                {
                    text: 'Last Month',
                    value: 3
                },
                {
                    text: 'Custom Interval',
                    value: 4
                }
            ],

            dateSelect: null,
            dateStart: null,
            dateEnd: null,
            datePicker1: false,
            datePicker2: false,
        }
    },

    created() {
        this.initialize();
    },

    computed: {
        canExport() {
            if (this.dateSelect === 4 && this.dateStart && this.dateEnd) {
                let date1 = new Date(this.dateStart);
                let date2 = new Date(this.dateEnd);
                if (date1 >= date2) {
                    return false
                } else {
                    return true
                }
            } else if (this.dateSelect !== null && this.dateSelect < 4) {
                return true
            } else {
                return false
            }
        }
    },

    methods: {
        initialize() {
            axios.get('/back/orders').then(response => {
                this.table.orders = response.data.orders.map(item => {
                    item.show_files = false;
                    return item;
                })
            }).catch(error => {
                console.log(error.message);
            });
        },

        getDate(date) {
            return new Date(date).toLocaleString('en-gb', {
                year: 'numeric', month: '2-digit', day: '2-digit'
            }).replace(/(\d+)\/(\d+)\/(\d+)/, '$3/$1/$2');
        },

        showFiles(item) {
            item.show_files = !item.show_files;
        },

        approve(item) {
            if (confirm("Are you sure you want to approve? This action can't be undone!")) {
                axios.post('/back/orders/' + item.id + '/approve').then(response => {
                    this.$toasted.show(response.data.message);
                    this.initialize();
                }).catch(error => {
                    this.$toasted.show(error.message);
                });
            }
        },

        denied(item) {
            if (confirm("Are you sure you want to denies? This action can't be undone!")) {
                axios.post('/back/orders/' + item.id + '/denied').then(response => {
                    this.$toasted.show(response.data.message);
                    this.initialize();
                }).catch(error => {
                    this.$toasted.show(error.message);
                });
            }
        },

        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.dateSelect = null;
                this.dateInterval = [];
            });
        },

        exportCsv() {
            axios.get('/back/order-export', {
                params: {
                    interval: this.dateSelect,
                    start_date: this.dateStart,
                    end_date: this.dateEnd,
                }
            }).then(response => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                const fileName = `export-${+new Date()}.csv`
                link.setAttribute('download', fileName);
                document.body.appendChild(link);
                link.click();
                link.remove();
            })
        },
    },
}
</script>
