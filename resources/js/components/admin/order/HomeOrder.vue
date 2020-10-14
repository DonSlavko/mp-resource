<template>
  <v-container>
    <v-data-table show-select
                  :headers="table.headers"
                  :items="table.data"
                  :items-per-page="5"
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
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
export default {
  name: "HomeOrder",

  data() {
    return {
      table: {
        headers: [
          {
            text: 'ID',
            value: 'id'
          },
          {
            text: 'User',
            value: 'user.username'
          },
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
        ],
        data: [],
      },
      dialog: false,
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      axios.get('/back/orders').then(response => {
        this.table.data = response.data.data

      }).catch(error => {
        console.log(error.message);
      });
    },

    getDate(date) {
      return new Date(date).toLocaleString('en-gb', {
        year: 'numeric', month: '2-digit', day: '2-digit'
      }).replace(/(\d+)\/(\d+)\/(\d+)/, '$3/$1/$2');
    },
  },
}
</script>
