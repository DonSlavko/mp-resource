<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="6" md="5">
                <v-carousel hide-delimiters>
                    <v-carousel-item
                        v-for="(item,i) in item.images"
                        :key="i"
                        :src="item.path"
                    ></v-carousel-item>
                </v-carousel>
            </v-col>

            <v-col cols="12" sm="6" md="7">
                <h2 class="text-h5 mb-3" style="text-transform: uppercase">{{ item.name }}</h2>
                <h3 class="text-subtitle-1 mb-3 primary--text">{{ item.price }} €</h3>
                <h3 class="text-subtitle-1 mb-8 primary--text">In stock: {{ item.stock_quantity }}</h3>
                <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; width: 80%; border: none;">

                {{ item.description }}


                <v-row>
                    <v-col cols="12">
                        <v-btn-toggle v-model="selected" rounded>
                            <template v-for="value in item.variation.values">
                                <v-btn :value="value.id">
                                    {{ value.name }}
                                </v-btn>
                            </template>
                        </v-btn-toggle>
                    </v-col>

                    <v-col cols="12" md="3">
                        <v-text-field
                            v-model="quantity"
                            label="Quantity"
                            solo flat
                        >
                            <v-icon @click="addProduct()" slot="append" color="red">mdi-plus</v-icon>
                            <v-icon @click="subProduct()" slot="prepend" color="green">mdi-minus</v-icon>
                        </v-text-field>
                    </v-col>

                    <v-col cols="12" md="3">
                        <v-btn @click="addToCart()" :disabled="!canAddToCart">In Den Warenkorb</v-btn>
                    </v-col>
                </v-row>
            </v-col>

            <v-col cols="12">
                <template>
                    <div class="text-center">
                        Arzneibroschüre
                        <v-btn :href="item.brochure[0].path" class="ma-2" outlined color="primary">Download</v-btn>
                        Chargenanalyse
                        <v-btn :href="item.analysis[0].path" class="ma-2" outlined color="primary">Download</v-btn>
                    </div>
                </template>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: "Product",

    props: {
        item_id: null
    },

    data() {
        return {
            item: null,
            selected: null,
            quantity: 1,
        }
    },

    computed: {
        canAddToCart() {
            return this.selected && this.quantity < this.item.stock_quantity
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        addProduct() {
            this.quantity++;
        },

        subProduct() {
            if (this.quantity > 1) {
                this.quantity--;
            }
        },

        initialize() {
            axios.get('/back/shop/' + this.item_id).then(response => {
                this.item = response.data;
            }).catch(error => {
                console.log(error.message);
            });
        },

        formData() {
            return {
                'product': this.item_id,
                'variation_value': this.selected,
                'quantity': this.quantity,
            }
        },

        addToCart() {
            axios.post('/back/add-to-cart', this.formData()).then((response) => {
                console.log(response.data)

                this.selected = null;
                this.quantity = 1;
            })
        },
    }
}
</script>
