<template>
    <v-container>
        <v-data-table show-select
                      :headers="table.headers"
                      :items="table.items"
                      :items-per-page="5"
                      class="elevation-1">
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
                <v-btn color="primary" @click="initialize">Reset</v-btn>
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
                headers: [
                    {
                        text: 'ID',
                        value: 'id'
                    },
                    {
                        text: 'User',
                        value: 'customer_name'
                    },
                    {
                        text: 'Order Id',
                        value: 'order_id'
                    },
                    {
                        text: 'Amount',
                        value: 'payment_amount'
                    },
                    {
                        text: 'Status',
                        value: 'status'
                    },
                    {
                        text: 'Created',
                        value: 'created_at'
                    },
                    {
                        text: 'Options',
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
