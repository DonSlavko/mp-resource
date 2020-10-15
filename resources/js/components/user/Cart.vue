<template>
    <v-container>
        <v-card>
            <v-tabs color="light-green darken-1" left>
                <v-tab>Orders
                    <v-chip small>{{ orders.length }}</v-chip>
                </v-tab>
                <v-tab>Preorders
                    <v-chip small>{{ preorders.length }}</v-chip>
                </v-tab>

                <v-tab-item>
                    <h2 class="mb-3 ml-3">You have {{ orders.length }} waiting for ordering</h2>
                    <v-data-table
                        :headers="headers"
                        :items="orders"
                        :items-per-page="15"
                        class="elevation-1"
                    >
                        <template v-slot:item.price="{ item }"
                        >{{ item.price }} €
                        </template
                        >
                        <template v-slot:item.total="{ item }"
                        >{{ item.quantity * item.price }} €
                        </template
                        >
                        <template v-slot:item.actions="{ item }">
                            <v-icon small @click="removeItem(item)"> mdi-delete</v-icon>
                        </template>
                        <template v-slot:no-data> Cart is empty</template>
                    </v-data-table>
                    <v-row>
                        <v-col cols="12" offset-md="8" md="4">
                            <h2>Shopping cart total</h2>

                            <v-simple-table>
                                <thead>
                                <tr>
                                    <th class="text-left">
                                        {{ headers[4].text }}
                                    </th>
                                    <th class="text-left">
                                        {{ totalPrice() }} €
                                    </th>
                                </tr>
                                </thead>
                            </v-simple-table>
                        </v-col>

                        <v-col offset-md="8" md="4">
                            <v-checkbox
                                v-model="checkbox_order">
                                <template v-slot:label>
                                    <div class="font-weight-light text-subtitle-1">
                                        I accept the
                                        <v-tooltip bottom>
                                            <template v-slot:activator="{ on }">
                                                <strong><a
                                                    target="_blank"
                                                    href="/agb"
                                                    @click.stop
                                                    v-on="on">
                                                    Terms and Conditions
                                                </a></strong>
                                            </template>
                                            Opens in new window
                                        </v-tooltip>
                                    </div>
                                </template>
                            </v-checkbox>

                            <v-btn @click="makeOrder()" :disabled="canPlaceOrder">Place order</v-btn>

                        </v-col>
                    </v-row>
                </v-tab-item>

                <v-tab-item>
                    <h2 class="mb-3 ml-3">You have placed {{ preorders.length }} items in preorder</h2>
                    <v-data-table
                        :headers="headers"
                        :items="preorders"
                        :items-per-page="15"
                        class="elevation-1"
                    >
                        <template v-slot:item.price="{ item }"
                        >{{ item.price }} €
                        </template
                        >
                        <template v-slot:item.total="{ item }"
                        >{{ item.quantity * item.price }} €
                        </template
                        >
                        <template v-slot:item.actions="{ item }">
                            <v-icon small @click="removeItem(item)"> mdi-delete</v-icon>
                        </template>
                        <template v-slot:no-data>Preorder is empty</template>
                    </v-data-table>
                    <v-row>
                        <v-col cols="12" offset-md="8" md="4">
                            <h2>Shopping cart total</h2>

                            <v-simple-table>
                                <thead>
                                <tr>
                                    <th class="text-left">
                                        {{ headers[4].text }}
                                    </th>
                                    <th class="text-left">
                                        {{ totalPrice(true) }} €
                                    </th>
                                </tr>
                                </thead>
                            </v-simple-table>
                        </v-col>

                        <v-col offset-md="8" md="4">
                            <v-checkbox
                                v-model="checkbox_preorder">
                                <template v-slot:label>
                                    <div class="font-weight-light text-subtitle-1">
                                        I accept the
                                        <v-tooltip bottom>
                                            <template v-slot:activator="{ on }">
                                                <strong><a
                                                    target="_blank"
                                                    href="/agb"
                                                    @click.stop
                                                    v-on="on"
                                                >
                                                    Terms and Conditions
                                                </a></strong>
                                            </template>
                                            Opens in new window
                                        </v-tooltip>
                                    </div>
                                </template>
                            </v-checkbox>

                            <v-btn @click="makeOrder(true)" :disabled="canPlacePreorder">Place pre-order</v-btn>
                        </v-col>
                    </v-row>
                </v-tab-item>
            </v-tabs>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "Cart",

    data() {
        return {
            headers: [
                {
                    text: "Product Name",
                    value: "product_name",
                    sortable: false,
                },
                {
                    text: "Variation Type",
                    value: "variation_value_name",
                    sortable: false,
                },
                {
                    text: "Quantity",
                    value: "quantity",
                    sortable: false,
                },
                {
                    text: "Price",
                    value: "price",
                    sortable: false,
                },
                {
                    text: "Total Price",
                    value: "total",
                    sortable: false,
                },
                {
                    text: "Options",
                    value: "actions",
                    sortable: false,
                },
            ],
            orders: [],
            preorders: [],
            product_detail: [],
            checkbox_order: false,
            checkbox_preorder: false,
        };
    },

    computed: {
        orderIds() {
            return this.orders.map((item) => {
                return item.id;
            });
        },

        preorderIds() {
            return this.preorders.map((item) => {
                return item.id;
            });
        },

        canPlaceOrder() {
            return !(this.orderIds.length > 0 && this.checkbox_order);
        },

        canPlacePreorder() {
            return !(this.preorderIds.length > 0 && this.checkbox_preorder);
        }
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            axios
                .get("/back/in-cart")
                .then((response) => {
                    this.orders = response.data.orders;
                    this.preorders = response.data.preorders;
                })
                .catch((error) => {
                    console.log(error.message);
                });
        },

        removeItem(item) {
            axios
                .delete("/back/remove-from-cart/" + item.id)
                .then((response) => {
                    this.initialize();
                    this.count = response.data;
                    document.getElementById("cart-count").innerHTML = this.count;
                    this.initialize();
                })
                .catch((error) => {
                    console.log(error.message);
                });
        },

        totalPrice(preorder = false) {
            let total_total = 0;

            if (preorder) {
                this.preorders.forEach(item => {
                    total_total += item.quantity * item.price;
                })
            } else {
                this.orders.forEach((item) => {
                    total_total += item.quantity * item.price;
                });
            }

            return total_total;
        },

        formData(preorder = false) {
            if (preorder) {
                return {
                    carts_id: this.preorderIds,
                    total_price: this.totalPrice(true),
                    preorder: true
                };
            } else {
                return {
                    carts_id: this.orderIds,
                    total_price: this.totalPrice(),
                };
            }
        },

        makeOrder(preorder = false) {
            if (preorder) {
                axios.post("/back/make-order", this.formData(preorder)).then((response) => {
                    this.initialize();
                    this.$toasted.show(response.data);
                    window.location.href = "/vorbestellungen/my-pre-orders";
                }).catch((error) => {
                    console.log(error.message);
                });
            } else {
                axios.post("/payment", this.formData()).then((response) => {
                    this.initialize();
                    this.$toasted.show(response.data);
                }).catch((error) => {
                    console.log(error.message);
                });
            }
        },
    },
};
</script>
<style>
label {
    margin-bottom: 0 !important;
}
</style>
