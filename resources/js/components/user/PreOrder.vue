<template>
    <v-container>
        <v-data-table
            :headers="headers"
            :items="items"
            :items-per-page="15"
            class="elevation-1"
            :expanded="expandedItems"
            show-expand>
            <template v-slot:item.products="{ item }">
                {{ item.carts.length }}
            </template>
            <template v-slot:item.price="{ item }">
                {{ item.total_price }} €
            </template>
            <template v-slot:item.date="{ item }">
                {{ getDate(item.created_at) }}
            </template>
            <template v-slot:item.actions="{ item }">
                <v-btn small outlined
                       v-if="item.status === 'Approved'"
                       @click="processPreorder(item)">Bestellung aufgeben
                </v-btn>
            </template>
            <template v-slot:expanded-item="{ headers, item }">
                <td class="px-0" :colspan="headers.length">
                    <v-data-table :headers="expanded"
                                  :items="item.carts"
                                  :items-per-page="99"
                                  dense
                                  hide-default-footer>
                        <template v-slot:item.price="{ item }">{{ item.price }} €</template>
                        <template v-slot:item.total="{ item }">{{ item.quantity * item.price }} €</template>
                    </v-data-table>
                </td>
            </template>
            <template v-slot:no-data>
                Sie haben keine Vorbestellungen
            </template>
        </v-data-table>

    </v-container>
</template>

<script>
export default {
    name: "PreOrder",

    data() {
        return {
            headers: [
                {
                    text: 'Anzahl',
                    value: 'products',
                    sortable: false,
                },
                {
                    text: 'Preis',
                    value: 'price',
                    sortable: false,
                },
                {
                    text: 'Status',
                    value: 'status',
                    sortable: false
                },
                {
                    text: 'Datum',
                    value: 'date',
                    sortable: false,
                },
                {
                    text: 'Optionen',
                    value: 'actions',
                    sortable: false
                }
            ],
            expandedItems: [],
            expanded: [
                {
                    text: 'Product Name',
                    value: 'product_name',
                    sortable: false,
                },
                {
                    text: 'Variation',
                    value: 'variation_value_name',
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
            ],
            items: [],
        }
    },

    created() {
        this.initialize();
    },

    methods: {
        getDate(date) {
            return new Date(date).toLocaleString('en-gb', {
                year: 'numeric', month: '2-digit', day: '2-digit'
            }).replace(/(\d+)\/(\d+)\/(\d+)/, '$3/$1/$2');
        },

        initialize() {
            axios.get('/back/get-orders').then((response) => {
                this.items = response.data.data;
            }).catch((error) => {
                console.log(error.message);
            });
        },

        formData(item) {
            return {
                item_id: item.id,
            }
        },

        processPreorder(item) {
            axios.post("/back/move-to-order", {
                preorder_id: item.id,
            }).then((response) => {
                this.$toasted.show(response.data[1]);
                document.getElementById("cart-count").innerHTML = response.data[0];
                this.initialize();
            }).catch((error) => {
                this.$toasted.show(error.message);
            });
        }
    }
}
</script>
