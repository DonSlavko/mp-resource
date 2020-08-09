<template>
    <v-container>
        <v-data-table
                      :headers="headers"
                      :items="items"
                      :items-per-page="15"
                      class="elevation-1"
        >
            <template v-slot:item.price="{ item }">{{ item.product.price }} €</template>
            <template v-slot:item.total="{ item }">{{ item.quantity * item.product.price }} €</template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    @click="removeItem(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
            <template v-slot:no-data>
                Cart is empty
            </template>
            <template v-slot:footer>
                <v-row align="center" justify="center" class="text-center">
                    <v-col cols="12" md="6" order="2" order-md="1">
                        <v-btn @click="makeOrder()" :disabled="!hasItems">Vorbestellen</v-btn>
                    </v-col>
                    <v-col cols="12" md="6" order="1" order-md="2">
                        <p class="mb-0">Total price: {{ totalPrice }} €</p>
                    </v-col>
                </v-row>
            </template>
        </v-data-table>

    </v-container>
</template>

<script>
export default {
    name: "Cart",

    data () {
        return {
            headers: [
                {
                    text: 'Product Name',
                    value: 'product.name',
                    sortable: false,
                },
                {
                    text: 'Type',
                    value: 'variation_value.name',
                    sortable: false,
                },
                {
                    text: 'Quantity',
                    value: 'quantity',
                    sortable: false,
                },
                {
                    text: 'Price',
                    value: 'price',
                    sortable: false,
                },
                {
                    text: 'Total Price',
                    value: 'total',
                    sortable: false,
                },
                {
                    text: 'Options',
                    value: 'actions',
                    sortable: false,
                },
            ],
            items: [],
        }
    },

    computed: {
        totalPrice() {
            let total_total = 0;

            this.items.forEach((item) => {
                total_total += item.quantity * item.product.price;
            })

            return total_total;
        },

        cartIds() {
            return this.items.map((item) => {
                return item.id;
            })
        },

        hasItems() {
            return this.items.lenght > 0;
        }
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            axios.get('/back/in-cart').then((response) => {
                this.items = response.data.data;
            }).catch((error) => {
                console.log(error.message);
            });
        },

        removeItem(item) {
            axios.delete('/back/remove-from-cart/'+item.id).then((response) => {
                this.initialize();
            }).catch((error) => {
                console.log(error.message);
            })
        },

        formData() {
            return {
                'carts_id': this.cartIds,
                'total_price': this.totalPrice,
            }
        },

        makeOrder() {
            axios.post('/back/make-order', this.formData()).then((response) => {
                this.initialize();
            }).catch((error) => {
                console.log(error.message);
            })
        },
    }
}
</script>
