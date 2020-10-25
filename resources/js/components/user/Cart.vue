<template>
    <v-container>
        <v-card>
            <v-tabs color="light-green darken-1" left>
                <v-tab>Bestellungen
                    <v-chip small>{{ orders.length }}</v-chip>
                </v-tab>
                <v-tab>Vorbestellungen
                    <v-chip small>{{ preorders.length }}</v-chip>
                </v-tab>

                <v-tab-item>
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
                            <v-col cols="12" offset-md="2" md="6" order-md="2">
                                <v-simple-table>
                                    <thead>
                                    <tr>
                                        <th class="text-left">
                                            Gesamtsumme
                                        </th>
                                        <th class="text-left">
                                            {{ totalPrice() }} €
                                        </th>
                                    </tr>
                                    </thead>
                                </v-simple-table>

                                <v-checkbox
                                    v-model="checkbox_order">
                                    <template v-slot:label>
                                        <div class="font-weight-light text-subtitle-1">
                                            Ich habe die
                                            <v-tooltip bottom>
                                                <template v-slot:activator="{ on }">
                                                    <strong><a
                                                        target="_blank"
                                                        href="/agb"
                                                        @click.stop
                                                        v-on="on">
                                                        Allgemeinen Geschäftsbedingungen
                                                    </a></strong>
                                                </template>
                                                Opens in new window
                                            </v-tooltip>
                                            gelesen und akzeptiere diese.
                                        </div>
                                    </template>
                                </v-checkbox>

                                <v-btn @click="makeOrder()" :loading="loading" :disabled="canPlaceOrder">Jetzt kaufen</v-btn>
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
                            </v-col>
                        </v-row>
                    </v-container>
                </v-tab-item>

                <v-tab-item>
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
                            <v-col cols="12" offset-md="2" md="6" order-md="2">
                                <v-simple-table>
                                    <thead>
                                    <tr>
                                        <th class="text-left">
                                            Gesamtsumme
                                        </th>
                                        <th class="text-left">
                                            {{ totalPrice(true) }} €
                                        </th>
                                    </tr>
                                    </thead>
                                </v-simple-table>

                                <p>
                                    Hinweis zur Vorbestellung:
                                    Sie bekommen 5 Werktage vor der tatsächlichen Verfügbarkeit eine Benachrichtigung per E-Mail. Ihre
                                    Vorbestellung wird in eine Bestellung umgewandelt.
                                    Ihre verbindlichen Vorbestellungen sind für uns unverbindlich, da wir Abhängig vom
                                    Hersteller\Lieferanten sind. Das heißt, es könnte z.B. eine Lieferung verspätet oder durch einen
                                </p>
                                <p>
                                    Misserfolg der Ernte „vorerst“ gar nicht eintreffen. Haben Sie diesbezüglich bitte Verständnis, falls eine
                                    Lieferung die 3-monatsgrenze überschreiten sollte. Wenn diese drei (3)-Monatsfrist überschritten
                                    werden, kann der Kunde von seiner Vorbestellung, auf die schriftliche und auf die formlose Art
                                    zurücktreten. Via E-Mail bitte an die vorbestellung@mp-resource.shop.
                                </p>

                                <v-checkbox
                                    v-model="checkbox_preorder2">
                                    <template v-slot:label>
                                        <div class="font-weight-light text-subtitle-1">
                                            Ich habe den
                                            <span class="font-weight-bold">Hinweis zur Vorbestellung</span>
                                            zur Kenntnis genommen und bin damit einverstanden.
                                        </div>
                                    </template>
                                </v-checkbox>

                                <v-checkbox
                                    v-model="checkbox_preorder1">
                                    <template v-slot:label>
                                        <div class="font-weight-light text-subtitle-1">
                                            Ich habe die
                                            <v-tooltip bottom>
                                                <template v-slot:activator="{ on }">
                                                    <strong><a
                                                        target="_blank"
                                                        href="/agb"
                                                        @click.stop
                                                        v-on="on">
                                                        Allgemeinen Geschäftsbedingungen
                                                    </a></strong>
                                                </template>
                                                Opens in new window
                                            </v-tooltip>
                                            gelesen und akzeptiere diese.
                                        </div>
                                    </template>
                                </v-checkbox>

                                <v-btn @click="makeOrder(true)" :loading="loading" :disabled="canPlacePreorder">Vorbestellen</v-btn>
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
                    text: "Produkt",
                    value: "product_name",
                    sortable: false,
                },
                {
                    text: "Variation",
                    value: "variation_value_name",
                    sortable: false,
                },
                {
                    text: "Menge",
                    value: "quantity",
                    sortable: false,
                },
                {
                    text: "Preis",
                    value: "price",
                    sortable: false,
                },
                {
                    text: "Summe",
                    value: "total",
                    sortable: false,
                },
                {
                    text: "Optionen",
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
            },
            preorder: {
                file1: null,
                file2: null,
            },
            orders: [],
            preorders: [],
            product_detail: [],
            checkbox_order: false,
            checkbox_preorder1: false,
            checkbox_preorder2: false,
            loading: false,
            count: null,
        };
    },

    computed: {
        orderIds() {
            if (this.orders.length > 0) {
                return this.orders.map((item) => {
                    return item.id;
                });
            }

            return []
        },

        preorderIds() {
            if (this.preorders.length > 0) {
                return this.preorders.map((item) => {
                    return item.id;
                });
            }
            return []
        },

        canPlaceOrder() {
            return !(this.orderIds.length > 0
                && this.checkbox_order
                && this.order.file1
                && this.order.file2);
        },

        canPlacePreorder() {
            return !(this.preorderIds.length > 0
                && this.checkbox_preorder1
                && this.checkbox_preorder2
                && this.preorder.file1
                && this.preorder.file2);
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

            if (preorder && this.preorders.length > 0) {
                this.preorders.forEach(item => {
                    total_total += item.quantity * item.price;
                })
            } else if (this.orders.length > 0) {
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
            } else {
                form.append("carts_id", this.orderIds);
                form.append("total_price", this.totalPrice());

                form.append("file1", this.order.file1, this.order.file1.name);
                form.append("file2", this.order.file2, this.order.file2.name);
            }

            return form;
        },

        makeOrder(preorder = false) {
            this.loading = true;
            if (preorder) {
                axios.post("/back/make-order", this.formData(preorder), {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((response) => {
                    this.initialize();
                    this.$toasted.show(response.data[1]);
                    this.count = response.data[0];
                    document.getElementById("cart-count").innerHTML = this.count;
                    this.loading = false;
                }).catch((error) => {
                    console.log(error.message);
                    this.loading = false;
                });
            } else {
                axios.post("/back/make-order", this.formData(), {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((response) => {
                    this.initialize();
                    this.$toasted.show(response.data[1]);
                    this.count = response.data[0];
                    document.getElementById("cart-count").innerHTML = this.count;
                    this.loading = false;
                }).catch((error) => {
                    console.log(error.message);
                    this.loading = false;
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
