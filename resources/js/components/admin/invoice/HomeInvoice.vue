<template>
    <v-container>
        <v-data-table
            show-select
            :footer-props="table.footerProps"
            :headers="table.headers"
            :items="table.items"
            :items-per-page="5"
            class="elevation-1">
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Rechnungen</v-toolbar-title>
                </v-toolbar>
            </template>
            <template v-slot:item.created_at="{ item }">
                {{ getDate(item.created_at) }}
            </template>
            <template v-slot:item.options="{ item }">
                <v-btn
                    :href="'/back/invoice-download/'+item.id"
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
                    itemsPerPageText: 'Rechnungen pro Seite:',
                    pageText: '{0}-{1} von {2}',
                },

                headers: [
                    {
                        text: 'ID',
                        value: 'id'
                    },
                    {
                        text: 'Benutzername',
                        value: 'customer_name'
                    },
                    {
                        text: 'Bestell- ID',
                        value: 'order_id'
                    },
                    {
                        text: 'Summe',
                        value: 'payment_amount'
                    },
                    {
                        text: 'Status',
                        value: 'status'
                    },
                    {
                        text: 'Erstellt am',
                        value: 'created_at'
                    },
                    {
                        text: 'Optionen',
                        value: 'options'
                    }
                ],
                items: [],
            },
        }
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            axios.get('/back/invoice').then(response => {
                this.table.items = response.data.data
            }).catch(error => {
                console.log(error.message);
            });
        },

        getDate(date) {
            return new Date(date).toLocaleString('en-gb', {
                year: 'numeric', month: '2-digit', day: '2-digit'
            }).replace(/(\d+)\/(\d+)\/(\d+)/, '$3/$1/$2');
        },
    },
}
</script>
