<template>
    <v-container>
        <v-row>
            <v-col cols="12" md="4" class="py-8">
                <v-sheet class="mx-auto"
                         elevation="8"
                         max-width="400"
                         max-height="400">
                    <v-expand-x-transition>
                        <v-img
                            :src="item.images[model].path" :key="model"
                            width="400"
                            max-height="400"
                            contain
                        ></v-img>
                    </v-expand-x-transition>
                </v-sheet>

                <v-sheet class="mx-auto"
                         elevation="8"
                         max-width="400">
                    <v-slide-group v-model="model"
                                   active-class="success" show-arrows>
                        <v-slide-item
                            v-for="image in item.images"
                            :key="item.path"
                            v-slot:default="{ active, toggle }"
                        >
                            <v-card
                                :color="active ? undefined : 'white'"
                                class="ma-4"
                                height="100"
                                width="100"
                                @click="toggle"
                            >
                                <v-img
                                    :src="image.path"
                                    width="100px"
                                    max-height="100px"
                                    contain
                                ></v-img>
                            </v-card>
                        </v-slide-item>
                    </v-slide-group>
                </v-sheet>
            </v-col>

            <v-col cols="12" md="8">
                <h3 class="mb-3">{{ item.name }}</h3>

                <v-divider></v-divider>
                <v-divider></v-divider>

                <p v-html="this.$sanitize(item.description)"></p>

                <p><i>(Originalverpackung kann vom Abbild abweichen)</i></p>

                <p class="text-subtitle-1">
                    <strong>SKU:</strong> {{ item.sku }}
                </p>

                <template v-for="value in item.variationValues">
                    <p class="text-subtitle-1">
                        <strong>{{ value.name }}:</strong> {{ value.pivot.price }} €
                    </p>
                </template>

                <v-divider></v-divider>

                <h4>By Product:</h4>

                <v-row>
                    <v-col cols="12">
                        <v-btn-toggle v-model="selected" dense group>
                            <v-btn :disabled="value.pivot.quantity === 0" style="border: 0.5px solid; border-radius: 5px" v-for="value in item.variationValues"
                                   :key="value.id" :value="value.id">
                                {{ value.name }}
                            </v-btn>
                        </v-btn-toggle>
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-btn-toggle >
                            <v-btn height="40" @click="subProduct()">
                                <v-icon color="red"
                                >mdi-minus
                                </v-icon>
                            </v-btn>
                        <v-text-field v-model="quantity" label="Quantity" dense outlined flat>
                        </v-text-field>
                            <v-btn height="40" @click="addProduct()">
                                <v-icon color="green"
                                >mdi-plus
                                </v-icon>
                            </v-btn>
                        </v-btn-toggle>
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-btn height="40" @click="addToCart()" depressed color="primary" :disabled="!canAddToCart">In Den Warenkorb</v-btn>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>

        <v-row justify="center" class="pb-16">
            <v-expansion-panels accordion>
                <v-expansion-panel>
                    <v-expansion-panel-header color="primary text-white">Vorbestellen</v-expansion-panel-header>
                    <v-expansion-panel-content>
                        <v-row>
                            <v-col cols="12" md="5">
                                <v-row>
                                    <v-col cols="12">
                                        <v-btn-toggle v-model="preorder.selected" dense group>
                                            <v-btn style="border: 0.5px solid; border-radius: 5px" v-for="value in item.variationValues"
                                                   :key="value.id" :value="value.id">
                                                {{ value.name }}
                                            </v-btn>
                                        </v-btn-toggle>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-btn-toggle >
                                            <v-btn height="40" @click="subProduct(true)">
                                                <v-icon color="red"
                                                >mdi-minus
                                                </v-icon>
                                            </v-btn>
                                            <v-text-field v-model="preorder.quantity" label="Quantity" dense outlined flat>
                                            </v-text-field>
                                            <v-btn height="40" @click="addProduct(true)">
                                                <v-icon color="green"
                                                >mdi-plus
                                                </v-icon>
                                            </v-btn>
                                        </v-btn-toggle>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-btn height="40" @click="addToCart(true)" depressed color="primary">Vorbestellen</v-btn>
                                    </v-col>
                                </v-row>
                            </v-col>

                            <v-col cols="12" md="7">
                                Sie haben nun hier die Möglichkeit, die Arznei unverbindlich zu reservieren.
                                Sie bekommen 5 Werktage vor der tatsächlichen Verfügbarkeit eine Benachrichtigung per
                                E-Mail (vorbestellung@mp-resource.shop). Diese Benachrichtigung wird ebenfalls nur
                                eine Gültigkeit von 5 Werktagen haben. In diesem Zeitraum haben Sie nun die Möglichkeit,
                                Ihre unverbindliche Vorbestellung, in eine verbindliche Bestellung umzuwandeln.
                                Nach Ablauf der Gültigkeit wird Ihre unverbindliche Vorbestellung gelöscht und für
                                andere Kunden wieder freigegeben. Vielen Dank für Ihr Verständnis.
                            </v-col>
                        </v-row>
                    </v-expansion-panel-content>
                </v-expansion-panel>

                <v-expansion-panel>
                    <v-expansion-panel-header color="primary text-white">
                        Arzneibroschüre & Chargenanalyse
                    </v-expansion-panel-header>
                    <v-expansion-panel-content class="pt-4 text-subtitle-1 font-weight-bold">
                        Arzneibroschüre

                        <v-btn :disabled="item.brochure"
                            :href="item.brochure"
                            target="_blank"
                            class="ma-2"
                            outlined
                            color="primary">Download
                        </v-btn>

                        Chargenanalyse

                        <v-btn :disabled="item.brochure"
                            :href="item.analysis"
                            target="_blank"
                            class="ma-2"
                            outlined
                            color="primary">Download
                        </v-btn>

                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: "Product",

    props: {
        item_id: null,
    },

    data() {
        return {
            model: 0,
            item: null,
            selected: null,
            quantity: 1,
            count: "",

            preorder: {
                selected: null,
                quantity: 1
            }
        };
    },

    computed: {
        canAddToCart() {
            return !!this.selected && this.quantity < this.getAvailableQuantity;
        },

        getAvailableQuantity() {
            if (!!this.selected) {
                let value = this.item.variationValues.filter(item => item.id === this.selected);
                return value[0].pivot.quantity;
            }

            return 0;
        }
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            axios
                .get("/back/shop/" + this.item_id)
                .then((response) => {
                    this.item = response.data;
                })
                .catch((error) => {
                    console.log(error.message);
                });
        },

        addProduct(preorder = false) {
            if (preorder) {
                this.preorder.quantity++;
            } else {
                this.quantity++;
            }
        },

        subProduct(preorder = false) {
            if (preorder) {
                if (this.preorder.quantity > 1) {
                    this.preorder.quantity--;
                }
            } else {
                if (this.quantity > 1) {
                    this.quantity--;
                }
            }

        },

        formData(preorder = false) {
            if (preorder) {
                return {
                    product_id: this.item.id,
                    variation_value_id: this.preorder.selected,
                    quantity: this.preorder.quantity,
                    preorder: true,
                }
            } else {
                return {
                    product_id: this.item.id,
                    variation_value_id: this.selected,
                    quantity: this.quantity,
                };
            }
        },

        addToCart(preorder = false) {
            axios.post("/back/add-to-cart", this.formData(preorder)).then((response) => {
                this.$toasted.show(response.data[1]);
                this.count = response.data[0];
                document.getElementById("cart-count").innerHTML = this.count;
                this.selected = null;
                this.quantity = 1;
                this.preorder.selected = null;
                this.preorder.quantity = 1;
            });
        },
    },
};
</script>
