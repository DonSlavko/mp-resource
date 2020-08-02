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
                                            <v-text-field v-model="editedItem.name" :rules="rules" label="Produktname"></v-text-field>
                                        </v-col>

                                        <v-col cols="12">
                                            <v-textarea
                                                :rules="rules"
                                                v-model="editedItem.description"
                                                solo
                                                name="input-7-4"
                                                label="Beschreibung"
                                            ></v-textarea>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="6">
                                            <v-select
                                                :rules="rules"
                                                v-model="editedItem.category"
                                                :items="categories"
                                                name="category"
                                                label="Kategorie"
                                                outlined dense></v-select>
                                        </v-col>

                                        <v-col cols="12" md="6">
                                            <v-select
                                                :rules="rules"
                                                v-model="editedItem.variation"
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
                                            <v-text-field :rules="rules" v-model="editedItem.sku" label="SKU"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field :rules="rules" v-model="editedItem.price" label="Price"></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="4">
                                            <v-text-field :rules="rules" v-model="editedItem.stock" label="Stock"></v-text-field>
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
                        value: 'category',
                        sortable: false,
                    },
                    {
                        text: 'Date',
                        value: 'date'
                    },
                    {
                        text: 'Options',
                        value: 'actions'
                    },
                ],
                data: [

                ]
            },

            categories: [],
            variations: [],
            attributes: [],

            dialog: false,

            editedIndex: -1,

            editedItem: {
                name: '',
                category: '',
                description: '',
                variation: null,
                attribute: {
                    ids: [],
                    values: []
                },
                price: 0,
                stock: 0,
                sku: null,
            },

            defaultItem: {
                name: '',
                category: '',
                description: '',
                variation: null,
                attribute: {
                    ids: [],
                    values: []
                },
                price: 0,
                stock: 0,
                sku: null,
            },
          rules: [
            value => !!value || "This field can't be empty"
          ]

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
                this.table.data = response.data.data;
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
                    if (this.editedItem.attribute.values.includes(value.id))
                    {
                        let index = this.editedItem.attribute.values.indexOf(value.id)

                        if (index >  -1) {
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

        save() {
          if (this.$refs.modal.validate()) {
            if (this.editedIndex > -1) {
              axios.patch('/back/products/' + this.editedItem.id, this.editedItem).then(response => {
                this.initialize();
              })
            } else {
              axios.post('/back/products', this.editedItem).then(response => {
                this.initialize();
              })
            }
            this.close()
          }
        },
    },
}
</script>
