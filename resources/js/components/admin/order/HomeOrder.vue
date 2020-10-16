<template>
    <v-container>
        <v-card>
            <v-tabs color="light-green darken-1" left>
                <v-tab>Orders</v-tab>
                <v-tab>Preorders</v-tab>

                <v-tab-item>
                    <v-data-table show-select
                                  :headers="table.headers"
                                  :items="table.orders"
                                  :items-per-page="5"
                                  class="elevation-1">
                        <template v-slot:item.products="{ item }">
                            {{ item.carts.length }}
                        </template>
                        <template v-slot:item.price="{ item }">
                            {{ item.total_price }} €
                        </template>
                        <template v-slot:item.date="{ item }">
                            {{ getDate(item.created_at) }}
                        </template>
                        <template v-slot:no-data>
                            <v-btn color="primary" @click="initialize">Reset</v-btn>
                        </template>
                    </v-data-table>
                </v-tab-item>

                <v-tab-item>
                    <v-data-table show-select
                                  :headers="table.headers"
                                  :items="table.preorders"
                                  :items-per-page="5"
                                  class="elevation-1">
                        <template v-slot:item.products="{ item }">
                            {{ item.carts.length }}
                        </template>
                        <template v-slot:item.price="{ item }">
                            {{ item.total_price }} €
                        </template>
                        <template v-slot:item.date="{ item }">
                            {{ getDate(item.created_at) }}
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
                        </template>
                        <template v-slot:no-data>
                            <v-btn color="primary" @click="initialize">Reset</v-btn>
                        </template>
                    </v-data-table>
                </v-tab-item>
            </v-tabs>
        </v-card>
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
                        value: 'user.username'
                    },
                    {
                        text: 'Number of Products',
                        value: 'products',
                        sortable: false,
                    },
                    {
                        text: 'Price',
                        value: 'price',
                        sortable: false,
                    },
                    {
                        text: 'Status',
                        value: 'status',
                        sortable: false
                    },
                    {
                        text: 'Date',
                        value: 'date',
                        sortable: false,
                    },
                    {
                        text: 'Options',
                        value: 'options',
                        sortable: false
                    }
                ],
                orders: [],
                preorders: [],
            },
            dialog: false,
        }
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            axios.get('/back/orders').then(response => {
                this.table.orders = response.data.orders
                this.table.preorders = response.data.preorders

            }).catch(error => {
                console.log(error.message);
            });
        },

        getDate(date) {
            return new Date(date).toLocaleString('en-gb', {
                year: 'numeric', month: '2-digit', day: '2-digit'
            }).replace(/(\d+)\/(\d+)\/(\d+)/, '$3/$1/$2');
        },

        approve(item) {
            if (confirm("Are you sure you want to approve this preorder? This action can't be undone!")) {
                axios.post('/back/orders/' + item.id + '/approve').then(response => {
                    this.$toasted.show(response.data.message);
                    this.initialize();
                }).catch(error => {
                    this.$toasted.show(error.message);
                });
            }
        },

        denied(item) {
            if (confirm("Are you sure you want to denies this preorder? This action can't be undone!")) {
                axios.post('/back/orders/' + item.id + '/denied').then(response => {
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
