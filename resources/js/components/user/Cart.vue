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
                    <v-container>
                        <v-row>
                            <v-col cols="12" offset-md="4" md="4" order-md="2">
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

                            <v-col offset-md="8" md="4" order-md="3">
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

                            <v-col cols="12" md="4" order-md="1">
                                <v-file-input
                                    :rules="rules.file"
                                    v-model="order.file1"
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
                                    v-model="order.file2"
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
                                    v-model="order.file3"
                                    accept="image/png, image/jpeg, application/pdf"
                                    label=" Approbation:"
                                    prepend-icon="mdi-paperclip"
                                    outlined
                                    :show-size="1000"
                                    dense
                                    clearable
                                ></v-file-input>
                            </v-col>
                        </v-row>
                    </v-container>
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
                    <v-container>
                        <v-row>
                            <v-col cols="12" offset-md="4" md="4" order-md="2">
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

                            <v-col cols="12" offset-md="8" md="4" order-md="3">
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

                            <v-col cols="12" md="4" order-md="1">
                                <v-file-input
                                    :rules="rules.file"
                                    v-model="preorder.file1"
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
                                    v-model="preorder.file2"
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
                                    v-model="preorder.file3"
                                    accept="image/png, image/jpeg, application/pdf"
                                    label=" Approbation:"
                                    prepend-icon="mdi-paperclip"
                                    outlined
                                    :show-size="1000"
                                    dense
                                    clearable
                                ></v-file-input>
                            </v-col>
                        </v-row>
                    </v-container>
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
            rules: {
                file: [
                    value => !!value || 'No file selected',
                    value => value.size < 6000000,
                ],
            },

            order: {
                file1: null,
                file2: null,
                file3: null,
            },
            preorder: {
                file1: null,
                file2: null,
                file3: null,
            },
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
            return !(this.orderIds.length > 0
                && this.checkbox_order
                && this.order.file1
                && this.order.file2
                && this.order.file3);
        },

        canPlacePreorder() {
            return !(this.preorderIds.length > 0
                && this.checkbox_preorder
                && this.preorder.file1
                && this.preorder.file2
                && this.preorder.file3);
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

            let form = new FormData();

            if (preorder) {
                form.append("carts_id", this.preorderIds);
                form.append("total_price", this.totalPrice(true));
                form.append("preorder", "1");

                form.append("file1", this.preorder.file1, this.preorder.file1.name);
                form.append("file2", this.preorder.file2, this.preorder.file2.name);
                form.append("file3", this.preorder.file3, this.preorder.file3.name);
            } else {
                form.append("carts_id", this.orderIds);
                form.append("total_price", this.totalPrice());

                form.append("file1", this.order.file1, this.order.file1.name);
                form.append("file2", this.order.file2, this.order.file2.name);
                form.append("file3", this.order.file3, this.order.file3.name);
            }

            return form;
        },

        makeOrder(preorder = false) {
            if (preorder) {
                axios.post("/back/make-order", this.formData(preorder), {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((response) => {
                    this.initialize();
                    this.$toasted.show(response.data);
                    window.location.href = "/vorbestellungen/my-pre-orders";
                }).catch((error) => {
                    console.log(error.message);
                });
            } else {
                axios.post("/back/make-order", this.formData(), {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((response) => {
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
