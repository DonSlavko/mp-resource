<template>
  <v-container>
    <v-data-table
        :headers="headers"
        :items="data"
        :items-per-page="15"
        class="elevation-1">
      <template v-slot:item.products="{ item }">
        {{ item.carts.length }}
      </template>
      <template v-slot:item.price="{ item }">
        {{ item.total_price }} €
      </template>
      <template v-slot:item.date="{ item }">
        {{ getDate(item.created_at) }}
      </template>
      <template v-slot:no-data>
        You have no orders
      </template>
    </v-data-table>

  </v-container>
</template>

<script>
export default {
  name: "Order",

  data() {
    return {
      headers: [
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
      data: [],
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
        this.data = response.data.data;
      }).catch((error) => {
        console.log(error.message);
      });
    },
  }
}
</script>
