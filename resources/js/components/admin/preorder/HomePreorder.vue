<template>
    <v-container>
        <v-data-table
            show-select
            :footer-props="table.footerProps"
            :headers="table.headers"
            :items="table.preorders"
            :items-per-page="5"
            class="elevation-1">

            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Vorbestellungen</v-toolbar-title>

                    <v-spacer></v-spacer>
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
                    :href="'/back/preorder-download/'+item.id"
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
    name: "HomePreorder",

    data() {
        return {
            table: {
                footerProps: {
                    itemsPerPageAllText: 'Alle',
                    itemsPerPageText: 'Vorbestellungen pro Seite:',
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
                preorders: [],
            },
        }
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            axios.get('/back/preorders').then(response => {
                this.table.preorders = response.data.preorders.map(item => {
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
                axios.post('/back/preorders/' + item.id + '/approve').then(response => {
                    this.$toasted.show(response.data.message);
                    this.initialize();
                }).catch(error => {
                    this.$toasted.show(error.message);
                });
            }
        },

        denied(item) {
            if (confirm("Are you sure you want to denies? This action can't be undone!")) {
                axios.post('/back/preorders/' + item.id + '/denied').then(response => {
                    this.$toasted.show(response.data.message);
                    this.initialize();
                }).catch(error => {
                    this.$toasted.show(error.message);
                });
            }
        },
    },
}
</script>
