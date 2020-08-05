<template>
    <v-container>
        <v-data-table show-select
                      :headers="table.headers"
                      :items="table.data"
                      :items-per-page="5"
                      class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Products</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="800px">
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="primary"
                                dark
                                class="mb-2"
                                v-bind="attrs"
                                v-on="on"
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
                                                    :error="errors.name" :error-messages="errors.name"
                                                    :rules="rules.name" :counter="255"
                                                    v-model="editedItem.name" label="Name"></v-text-field>
                                            </v-col>

                                            <v-col cols="12">
                                                <v-textarea
                                                    v-model="editedItem.description"
                                                    label="Description"></v-textarea>
                                            </v-col>

                                            <v-col cols="12">
                                                <v-file-input
                                                    v-model="editedItem.images"
                                                    accept="image/png, image/jpeg"
                                                    label="Select product images"
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
                                                    v-model="editedItem.category_id"
                                                    :items="categories"
                                                    name="category"
                                                    label="Category"
                                                    outlined dense></v-select>
                                            </v-col>

                                            <v-col cols="12" md="6">
                                                <v-select
                                                    :rules="rules.select"
                                                    v-model="editedItem.variation_id"
                                                    :items="variations"
                                                    name="variation"
                                                    label="Variation"
                                                    outlined dense></v-select>
                                            </v-col>

                                            <v-col cols="12">
                                                <v-row>
                                                    <template v-for="attribute in attributes">
                                                        <v-col cols="12" md="4">
                                                            <v-checkbox
                                                                v-model="editedItem.attribute.ids"
                                                                color="primary"
                                                                :value="attribute.id"
                                                                :label="attribute.name"
                                                            ></v-checkbox>
                                                        </v-col>
                                                        <v-col cols="12" md="8">
                                                            <v-select
                                                                :disabled="isSelected(attribute)"
                                                                multiple
                                                                :items="getAttributeValues(attribute.attribute_values)"
                                                                v-model="editedItem.attribute.values"
                                                                label="Attribute Values"
                                                                outlined dense></v-select>
                                                        </v-col>
                                                    </template>
                                                </v-row>
                                            </v-col>

                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field
                                                    :error="errors.sku" :error-messages="errors.sku"
                                                    :rules="rules.sku"
                                                    v-model="editedItem.sku" label="SKU"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field
                                                    :error="errors.price" :error-messages="errors.price"
                                                    :rules="rules.price"
                                                    v-model="editedItem.price" type="number" step="0.01"
                                                    label="Price"></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6" md="4">
                                                <v-text-field
                                                    :error="errors.stock" :error-messages="errors.stock"
                                                    :rules="rules.stock"
                                                    v-model="editedItem.stock" type="number"
                                                    label="Stock"></v-text-field>
                                            </v-col>

                                            <v-col cols="12" md="6">
                                                <v-file-input
                                                    v-model="editedItem.brochure"
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
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
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
                        text: 'ID',
                        value: 'id'
                    },
                    {
                        text: 'Name',
                        value: 'name'
                    },
                    {
                        text: 'SKU',
                        value: 'sku'
                    },
                    {
                        text: 'Stock',
                        value: 'stock_quantity',
                        sortable: false,
                    },
                    {
                        text: 'Price',
                        value: 'price'
                    },
                    {
                        text: 'Category',
                        value: 'category.name',
                        sortable: false,
                    },
                    {
                        text: 'Date',
                        value: 'created_at'
                    },
                    {
                        text: 'Options',
                        value: 'actions'
                    },
                ],
                data: [],
            },

            errors: [],

            categories: [],
            variations: [],
            attributes: [],

            dialog: false,

            editedIndex: -1,

            editedItem: {
                name: '',
                category_id: null,
                description: '',
                variation_id: null,
                attribute: {
                    ids: [],
                    values: []
                },
                price: 0,
                stock: 0,
                sku: null,
                images: null,
                brochure: null,
                analysis: null,
            },

            defaultItem: {
                name: '',
                category_id: null,
                description: '',
                variation_id: null,
                attribute: {
                    ids: [],
                    values: []
                },
                price: 0,
                stock: 0,
                sku: null,
                images: null,
                brochure: null,
                analysis: null,
            },

            rules: {
                name: [
                    value => !!value || "Name field is required",
                    value => value.length <= 255 || "Name must be less than 255 characters long",
                ],
                select: [
                    value => !!value || "Please select one of the given values"
                ],
                sku: [
                    value => value.length <= 255 || "SKU must be less than 255 characters long",
                ],
                price: [
                    value => !!value || "Price field is required",
                    value => !isNaN(parseFloat(value)) || "Price must be number",
                    value => value > 0 || "Price must be grater then 0",
                    value => value.length <= 255 || "Price must be less than 255 characters long",
                ],
                stock: [
                    value => !!value || "Stock field is required",
                    value => !isNaN(parseFloat(value)) || "Stock must be number",
                    value => value > 0 || "Stock must be grater then 0",
                    value => value.length <= 255 || "Stock must be less than 255 characters long",
                ],
            },
        }
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New Product' : 'Edit Product'
        },
    },

    watch: {
        dialog(val) {
            val || this.close()
        },
    },

    created() {
        this.initialize();
        this.getCategories();
        this.getVariations();
        this.getAttributes();
    },

    methods: {
        initialize() {
            axios.get('/back/products').then(response => {
                this.table.data = response.data.data.map(item => {
                    let date = new Date(item.created_at);
                    let year = date.getFullYear();
                    let month = (1 + date.getMonth()).toString().padStart(2, '0');
                    let day = date.getDate().toString().padStart(2, '0');

                    item.created_at = year + '/' + month + '/' + day;
                    return item;
                })
            }).catch(error => {
                console.log(error.message);
            });
        },

        getCategories() {
            axios.get('/back/categories').then(response => {
                this.categories = response.data.data.map(item => {
                    return item = {
                        text: item.name,
                        value: item.id
                    }
                });
            })
        },

        getVariations() {
            axios.get('/back/variations').then(response => {
                this.variations = response.data.data.map(item => {
                    return item = {
                        text: item.name,
                        value: item.id
                    }
                });
            })
        },

        getAttributes() {
            axios.get('/back/attributes').then(response => {
                this.attributes = response.data.data.map((item) => {
                    item.attribute_values.map((value) => {
                        value = {
                            text: value.name,
                            value: value.id
                        }

                        return value
                    })

                    return item
                });
            })
        },

        getAttributeValues(value) {
            return value.map(item => {
                return item = {
                    text: item.name,
                    value: item.id
                }
            });
        },

        isSelected(item) {
            let selected = !this.editedItem.attribute.ids.includes(item.id)
            if (selected) {
                item.attribute_values.forEach((value) => {
                    if (this.editedItem.attribute.values.includes(value.id)) {
                        let index = this.editedItem.attribute.values.indexOf(value.id)

                        if (index > -1) {
                            this.editedItem.attribute.values.splice(index)
                        }
                    }
                })
            }

            return selected
        },

        editItem(item) {
            this.editedIndex = this.table.data.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            const index = this.table.data.indexOf(item)
            confirm('Are you sure you want to delete this item?') &&
            axios.delete('/back/products/' + item.id).then(respones => {
                this.initialize();
            })
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        formData() {
            let form = new FormData();

            form.append("name", this.editedItem.name);
            form.append("description", this.editedItem.description);
            form.append("category_id", this.editedItem.category_id);
            form.append("variation_id", this.editedItem.variation_id);

            if (this.editedItem.attribute.ids.length) {
                this.editedItem.attribute.ids.forEach((id, index) => {
                    form.append("attribute[ids][" + index + "]", id);
                })
            }

            if (this.editedItem.attribute.values.length) {
                this.editedItem.attribute.values.forEach((values, index) => {
                    form.append("attribute[values][" + index + "]", values);
                })
            }

            form.append("sku", this.editedItem.sku);
            form.append("price", this.editedItem.price);
            form.append("stock", this.editedItem.stock);

            if (this.editedItem.images.length) {
                for (let i = 0; i < this.editedItem.images.length; i++) {
                    let image = this.editedItem.images[i];
                    form.append('images[' + i + ']', image, image.name);
                }
            }

            if (this.editedItem.brochure) {
                form.append("brochure", this.editedItem.brochure, this.editedItem.brochure.name);
            }

            if (this.editedItem.analysis) {
                form.append("analysis", this.editedItem.analysis, this.editedItem.analysis.name);
            }

            return form;
        },

        save() {
            if (this.$refs.modal.validate()) {
                if (this.editedIndex > -1) {
                    axios.patch('/back/products/' + this.editedItem.id, this.formData(), {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((response) => {
                        this.initialize();
                        this.close()
                    }).catch((error) => {
                        this.errors = error.response.data;
                    });
                } else {
                    axios.post('/back/products', this.formData(), {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((response) => {
                        this.initialize();
                        this.close()
                    }).catch((error) => {
                        this.errors = error.response.data;
                    });
                }
            }
        },
    },
}
</script>
