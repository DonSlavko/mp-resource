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
            <template v-slot:item.preorder="{ item }">
                <span v-if="item.preorder">Preorder</span>
                <span v-else>Order</span>
            </template>
            <template v-slot:item.is_paid="{ item }">
                <span v-if="!item.is_paid && item.preorder" small>-</span>
                <v-chip v-else-if="!item.is_paid && !item.preorder" color="red" small>
                    Not Paid
                </v-chip>
                <v-chip v-else color="blue" small>
                    Paid
                </v-chip>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-btn small outlined v-if="!item.is_paid && !item.preorder">Process to payment</v-btn>
                <v-btn small outlined v-if="item.preorder">Process to order</v-btn>
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
                You have no orders
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
                    text: 'Number of Products',
                    value: 'products',
                    sortable: false,
                },
                {
                    text: 'Price',
                    value: 'price',
                    sortable: false,
                },
                {
                    text: 'Status',
                    value: 'status',
                    sortable: false
                },
                {
                    text: 'Date',
                    value: 'date',
                    sortable: false,
                },
                {
                    text: 'Type',
                    value: 'preorder',
                    sortable: false,
                },
                {
                    text: 'Paid',
                    value: 'is_paid',
                    sortable: false
                },
                {
                    text: 'Actions',
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
    }
}
</script>
