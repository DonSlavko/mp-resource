<template>
    <v-container>
        <v-data-table
            show-select
            :headers="table.headers"
            :items="table.data"
            :items-per-page="25"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Products</v-toolbar-title>
                    <v-divider class="mx-4" inset vertical></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="1000px">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on"
                            >New Product
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-form ref="modal">
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field
                                                    :error="errors.name"
                                                    :error-messages="errors.name"
                                                    :rules="rules.name"
                                                    :counter="255"
                                                    v-model="editedItem.name"
                                                    label="Name"
                                                ></v-text-field>
                                            </v-col>

                                            <v-col cols="12">
                                                <vue-editor
                                                    v-model="editedItem.description"
                                                    label="Description"
                                                ></vue-editor>
                                            </v-col>

                                            <v-col cols="12" sm="12" md="12">
                                                <v-file-input
                                                    v-model="editedItem.images"
                                                    :error="errors.images"
                                                    :error-messages="errors.images"
                                                    :rules="rules.images"
                                                    name="images[]"
                                                    accept="image/png, image/jpeg"
                                                    label="Select Multiple product images"
                                                    prepend-icon="mdi-image"
                                                    outlined
                                                    :show-size="1000"
                                                    dense
                                                    multiple
                                                    clearable
                                                ></v-file-input>
                                            </v-col>

                                            <v-col cols="12" sm="6" md="6">
                                                <v-select
                                                    :rules="rules.select"
                                                    v-model="editedItem.brand_id"
                                                    :items="brands"
                                                    name="brand_id"
                                                    label="Brand"
                                                    outlined
                                                    dense
                                                ></v-select>
                                            </v-col>

                                            <v-col cols="12" sm="6" md="6">
                                                <v-select
                                                    :rules="rules.select"
                                                    v-model="editedItem.category_id"
                                                    :items="categories"
                                                    name="category"
                                                    label="Category"
                                                    outlined
                                                    dense
                                                ></v-select>
                                            </v-col>

                                            <v-col cols="12" md="4">
                                                <v-text-field
                                                    :error="errors.sku"
                                                    :error-messages="errors.sku"
                                                    :rules="rules.sku"
                                                    v-model="editedItem.sku"
                                                    label="SKU"
                                                ></v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="4">

                                                <v-menu
                                                    v-model="datepicker"
                                                    :close-on-content-click="false"
                                                    :nudge-right="40"
                                                    transition="scale-transition"
                                                    offset-y
                                                    min-width="290px"
                                                >
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-text-field
                                                            :rules="rules.expires"
                                                            v-model="editedItem.expires"
                                                            label="Expire date"
                                                            readonly
                                                            v-bind="attrs"
                                                            v-on="on"
                                                        ></v-text-field>
                                                    </template>
                                                    <v-date-picker
                                                        v-model="editedItem.expires"
                                                        @input="datepicker = false"
                                                    ></v-date-picker>
                                                </v-menu>
                                            </v-col>

                                            <v-col cols="12" md="4">
                                                <v-text-field
                                                    :error="errors.charge"
                                                    :error-messages="errors.charge"
                                                    :rules="rules.charge"
                                                    v-model="editedItem.charge"
                                                    label="Charge"
                                                ></v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="6">
                                                <v-file-input
                                                    v-model="editedItem.brochure"
                                                    name="brochure"
                                                    accept="image/png, image/jpeg, application/pdf"
                                                    label="Arzneibroschüre"
                                                    prepend-icon="mdi-paperclip"
                                                    outlined
                                                    :show-size="1000"
                                                    dense
                                                    clearable
                                                ></v-file-input>
                                            </v-col>

                                            <v-col cols="12" md="6">
                                                <v-file-input
                                                    v-model="editedItem.analysis"
                                                    name="analysis"
                                                    accept="image/png, image/jpeg, application/pdf"
                                                    label="Chargenanalyse"
                                                    prepend-icon="mdi-paperclip"
                                                    outlined
                                                    :show-size="1000"
                                                    dense
                                                    clearable
                                                ></v-file-input>
                                            </v-col>

                                            <v-col cols="12">
                                                <v-divider></v-divider>
                                                <h5>Product Attributes</h5>
                                                <p>Select all Attributes Types that apply for this product.</p>

                                            </v-col>

                                            <v-col cols="12" md="4" v-for="attribute in attributes" :key="attribute.id">
                                                <v-select
                                                    :items="attribute.types"
                                                    v-model="editedItem.attributes[attribute.id]"
                                                    :label="attribute.name"
                                                    outlined
                                                    dense
                                                    clearable
                                                ></v-select>
                                            </v-col>

                                            <v-col cols="12">
                                                <v-divider></v-divider>
                                                <h5>Product Variation</h5>
                                                <p>Select product variation and enter price and quantity for all
                                                    variation types.</p>
                                            </v-col>

                                            <v-col cols="12" md="6">
                                                <v-select
                                                    :rules="rules.select"
                                                    :items="variations"
                                                    v-model="editedItem.variation"
                                                    label="Select Variation"
                                                    outlined
                                                    dense
                                                    clearable
                                                    @change="resetVariationValues(selectedVariation)"
                                                ></v-select>
                                            </v-col>

                                            <v-col cols="12">
                                                <v-simple-table v-if="selectedVariation.length > 0">
                                                    <template v-slot:default>
                                                        <thead>
                                                        <tr>
                                                            <th class="text-left">
                                                                Type
                                                            </th>
                                                            <th class="text-left">
                                                                Price
                                                            </th>
                                                            <th class="text-left">
                                                                Stock quantity
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="type in selectedVariation" :key="type.id">
                                                            <td><p class="mb-3">{{ type.name }}</p></td>
                                                            <td>
                                                                <v-text-field
                                                                    :error="errors.price"
                                                                    :error-messages="errors.price"
                                                                    :rules="rules.price"
                                                                    v-model="editedItem.variations.price[type.id]"
                                                                    dense
                                                                    prefix="€"
                                                                    type="number"
                                                                ></v-text-field>
                                                            </td>
                                                            <td>
                                                                <v-text-field
                                                                    :error="errors.quantity"
                                                                    :error-messages="errors.quantity"
                                                                    :rules="rules.quantity"
                                                                    v-model="editedItem.variations.quantity[type.id]"
                                                                    dense
                                                                    type="number"
                                                                ></v-text-field>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </template>
                                                </v-simple-table>
                                            </v-col>

                                            <v-col cols="12">
                                                <v-alert v-if="errors.message" type="error">
                                                    {{ errors.message }}
                                                </v-alert>
                                            </v-col>
                                        </v-row>
                                    </v-form>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close">Close</v-btn>
                                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>

            <template v-slot:item.type="{ item }">
                <template v-for="type in item.variation_values">{{ type.name }} <br></template>
            </template>

            <template v-slot:item.price="{ item }">
                <template v-for="type in item.variation_values">{{ type.pivot.price }} €<br></template>
            </template>

            <template v-slot:item.quantity="{ item }">
                <template v-for="type in item.variation_values">{{ type.pivot.quantity }} <br></template>
            </template>

            <template v-slot:item.date="{ item }">
                {{ getDate(item.created_at) }}
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil</v-icon>
                <v-icon small @click="deleteItem(item)"> mdi-delete</v-icon>
            </template>
            <template v-slot:no-data>
                <v-btn color="primary" @click="initialize">Reset</v-btn>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
export default {
    name: "HomeProduct",

    data() {
        return {
            table: {
                headers: [
                    {
                        text: "ID",
                        value: "id",
                    },
                    {
                        text: "Name",
                        value: "name",
                    },
                    {
                        text: "Variation Values",
                        value: "type",
                        sortable: false,
                    },
                    {
                        text: "Price Variation Values",
                        value: "price",
                        align: "right",
                        sortable: false,
                    },
                    {
                        text: "Variation Values Quantity",
                        value: "quantity",
                        align: "right",
                        sortable: false,
                    },
                    {
                        text: "SKU",
                        value: "sku",
                        sortable: false,
                    },
                    {
                        text: "Category",
                        value: "category.name",
                        sortable: false,
                    },
                    {
                        text: "Date",
                        value: "date",
                        sortable: false,
                    },
                    {
                        text: "Options",
                        value: "actions",
                        sortable: false,
                    },
                ],
                data: [],
            },

            errors: [],

            categories: [],
            variations: [],
            attributes: [],
            brands: [],

            datepicker: false,
            dialog: false,
            editedIndex: -1,

            editedItem: {
                name: "",
                category_id: null,
                description: "",
                brand_id: null,
                attributes: {},
                variation: null,
                variations: {
                    price: {},
                    quantity: {}
                },
                sku: "",
                expires: null,
                charge: "",
                images: [],
                brochure: null,
                analysis: null,
            },

            defaultItem: {
                name: "",
                category_id: null,
                description: "",
                brand_id: null,
                attributes: {},
                variation: null,
                variations: {
                    price: {},
                    quantity: {}
                },
                sku: "",
                expires: null,
                charge: "",
                images: [],
                brochure: null,
                analysis: null,
            },

            rules: {
                name: [
                    (value) => !!value || "Name field is required",
                    (value) => value.length <= 255 || "Name must be less than 255 characters long",
                ],
                select: [(value) => !!value || "Please select one of the given values"],
                sku: [
                    (value) => value.length <= 255 || "SKU must be less than 255 characters long",
                ],
                expires: [(value) => !!value || "Please select date of expiration"],
                charge: [
                    (value) => !!value || "Charge is required",
                    (value) => value.length <= 255 || "Charge must be less than 255 characters long",
                ],
                price: [
                    (value) => !!value || "Price is required",
                    (value) => value.length <= 255 || "Price must be less than 255 characters long",
                    (value) => value > 0 || "Price must be greater than 0"
                ],
                quantity: [
                    (value) => !!value || "Quantity is required",
                    (value) => value.length <= 255 || "Quantity must be less than 255 characters long",
                    (value) => value > 0 || "Quantity must be greater than 0"
                ],
                images: [
                    (value) => !value || value.length > 0 || "At least on image is required",
                ]
            },
        };
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? "New Product" : "Edit Product";
        },

        selectedVariation() {
            let variation = this.variations.filter(item => item.value === this.editedItem.variation);

            if (variation.length > 0) {
                return variation[0].types;
            }

            return {};
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        /**
         * Initialize all resources from server
         */
        initialize() {
            this.getProducts();
            this.getCategories();
            this.getVariations();
            this.getAttributes();
            this.getBrands();
        },

        /**
         * Get all products from server and pars them to table.data property
         */
        getProducts() {
            axios
                .get("/back/products")
                .then((response) => {
                    this.table.data = response.data.data;
                })
                .catch((error) => {
                    this.$toasted.show(error.message);
                });
        },

        /**
         * Format datetime from server data to more readable format
         * @param date
         * @returns {string}
         *
         * todo do this in backend
         */
        getDate(date) {
            return new Date(date)
                .toLocaleString("en-gb", {
                    year: "numeric",
                    month: "2-digit",
                    day: "2-digit",
                })
                .replace(/(\d+)\/(\d+)\/(\d+)/, "$3/$1/$2");
        },

        /**
         * Get all categories, used for create/update products
         */
        getCategories() {
            axios.get("/back/categories").then((response) => {
                this.categories = response.data.data.map((item) => {
                    return (item = {
                        text: item.name,
                        value: item.id,
                    });
                });
            });
        },

        /**
         * Get all brands, user for create/update products
         */
        getBrands() {
            axios.get("/back/brands").then((response) => {
                this.brands = response.data.data.map((item) => {
                    return (item = {
                        text: item.name,
                        value: item.id,
                    });
                });
            });
        },

        /**
         * Get all variations and pars variation types for dropdown functionality , user for create/update products
         * todo move variation types logic to backend
         */
        getVariations() {
            axios.get("/back/variations", {
                params: {
                    with_values: true,
                    variation_selector: true,
                }
            }).then((response) => {
                this.variations = response.data;
            });
        },

        /**
         * Get all attributes and pars attributes types for dropdown functionality , user for create/update products
         * todo move attributes types logic to backend
         */
        getAttributes() {
            axios.get("/back/attributes", {
                params: {
                    with_values: true,
                    value_selector: true
                }
            }).then((response) => {
                this.attributes = response.data;
            });
        },

        // todo remove this and move logic to backend
        isSelected(item) {
            let selected1 = !this.editedItem.attribute.ids.includes(item.id);
            if (selected1) {
                item.attribute_values.forEach((value) => {
                    if (this.editedItem.attribute.values.includes(value.id)) {
                        let index = this.editedItem.attribute.values.indexOf(value.id);

                        if (index > -1) {
                            this.editedItem.attribute.values.splice(index);
                        }
                    }
                });
            }
            return selected1;
        },

        // todo remove this and move logic to backend
        isSelectedForVariation(item) {
            let selected2 = !this.editedItem.product_variations.ids.includes(item.id);
            if (selected2) {
                item.variation_values.forEach((value) => {
                    if (this.editedItem.product_variations.values.includes(value.id)) {
                        let index = this.editedItem.product_variations.values.indexOf(
                            value.id
                        );
                        if (index > -1) {
                            this.editedItem.product_variations.values.splice(index);
                            this.editedItem.product_variations.stocks.splice(index);
                            this.editedItem.product_variations.prices.splice(index);
                        }
                    }
                });
            }
            return selected2;
        },

        /**
         * Open edit product modal
         * @param item
         */
        editItem(item) {
            this.editedIndex = this.table.data.indexOf(item);

            this.editedItem = {
                name: item.name,
                category_id: item.category_id,
                description: item.description,
                brand_id: item.brand_id,
                attributes: item.attributes_values,
                variation: item.variation[0].id,
                variations: item.variations_values,
                sku: item.sku,
                expires: item.expires,
                charge: item.charge,
                images: [],
                brochure: null,
                analysis: null,
            };

            this.dialog = true;
        },

        resetVariationValues(selectedVariation) {
            if (this.dialog) {
                this.editedItem.variations.price = {};
                this.editedItem.variations.quantity = {};

                selectedVariation.forEach(item => {
                    this.editedItem.variations.price[item.id] = 0;
                    this.editedItem.variations.quantity[item.id] = 0;
                });
            }
        },

        /**
         * Delete selected item from database
         * @param item
         */
        deleteItem(item) {
            const index = this.table.data.indexOf(item);
            confirm("Are you sure you want to delete this item?") &&
            axios.delete("/back/products-delete/" + item.id).then((respones) => {
                this.initialize();
            });
        },

        /**
         * Close Create/Edit product modal and reset modal data
         */
        close() {
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        /**
         * Prepare data from editedItem for form
         * @returns {FormData}
         */
        formData() {
            let form = new FormData();

            form.append("name", this.editedItem.name);
            form.append("description", this.editedItem.description);
            form.append("category_id", this.editedItem.category_id);
            form.append("brand_id", this.editedItem.brand_id);

            if (this.editedItem.attributes) {
                let attributes = Object.entries(this.editedItem.attributes);

                attributes.forEach(item => {
                    if (item[1] !== undefined) {
                        form.append("attributes[" + item[0] + "]", item[1]);
                    }
                });
            }

            form.append("variation", this.editedItem.variation);

            if (this.editedItem.variations.price) {
                let price = Object.entries(this.editedItem.variations.price);

                price.forEach(item => {
                    if (item[1] !== undefined) {
                        form.append("variations[" +  item[0] + "][price]", item[1]);
                    }
                });
            }

            if (this.editedItem.variations.quantity) {
                let quantity = Object.entries(this.editedItem.variations.quantity);

                quantity.forEach(item => {
                    if (item[1] !== undefined) {
                        form.append("variations[" +  item[0] + "][quantity]", item[1]);
                    }
                });
            }

            form.append("sku", this.editedItem.sku);
            form.append("charge", this.editedItem.charge);
            form.append("expires", this.editedItem.expires);
            form.append("images", this.editItem.images);
            form.append("brochure", this.editItem.brochure);
            form.append("analysis", this.editItem.analysis);

            if (this.editedItem.images.length) {
                for (let i = 0; i < this.editedItem.images.length; i++) {
                    let image = this.editedItem.images[i];
                    form.append("images[" + i + "]", image, image.name);
                }
            }

            if (this.editedItem.brochure) {
                form.append(
                    "brochure",
                    this.editedItem.brochure,
                    this.editedItem.brochure.name
                );
            }

            if (this.editedItem.analysis) {
                form.append(
                    "analysis",
                    this.editedItem.analysis,
                    this.editedItem.analysis.name
                );
            }

            return form;
        },

        /**
         * Save products to database
         */
        save() {
            if (this.$refs.modal.validate()) {
                if (this.editedIndex > -1) {
                    axios
                        .post(
                            "/back/update-products/" + this.editedItem.id,
                            this.formData(),
                            {
                                headers: {
                                    "Content-Type": "multipart/form-data",
                                },
                            }
                        )
                        .then((response) => {
                            this.initialize();
                            this.close();
                            this.$toasted.show(response.data);
                        })
                        .catch((error) => {
                            this.errors = error.response.data;
                        });
                } else {
                    axios
                        .post("/back/products", this.formData(), {
                            headers: {
                                "Content-Type": "multipart/form-data",
                            },
                        })
                        .then((response) => {
                            this.initialize();
                            this.close();
                            this.$toasted.show(response.data);
                        })
                        .catch((error) => {
                            this.errors = error.response.data;
                        });
                }
            }
        },
    },
};
</script>
