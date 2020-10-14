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
          <v-toolbar-title>Call Services</v-toolbar-title>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <!--<v-icon
            small
            class="mr-2"
            @click="editItem(item)"
        >
            mdi-pencil
        </v-icon>-->
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
  name: "HomeAttribute",

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
            text: 'Telephone number',
            value: 'telephone'
          },
          {
            text: 'Email',
            value: 'email'
          },
          {
            text: 'Recall period',
            value: 'recall'
          },
          {
            text: 'Message',
            value: 'message'
          },
          {
            text: 'Actions',
            value: 'actions'
          }
        ],
        data: []
      },

      errors: [],

      dialog: false,

      editedIndex: -1,

      editedItem: {
        name: '',
        description: '',
      },

      defaultItem: {
        name: '',
        description: '',
      },
    }
  },

  watch: {
    dialog(val) {
      val || this.close()
    },
  },

  created() {
    this.initialize()
  },

  methods: {
    initialize() {
      axios.get('/back/call-service').then(response => {
        this.table.data = response.data.data;
      }).catch(error => {
        console.log(error.message);
      });
    },

    editItem(item) {
      this.editedIndex = this.table.data.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem(item) {
      const index = this.table.data.indexOf(item)
      confirm('Are you sure you want to delete this item?') &&
      axios.delete('/back/attributes/' + item.id).then(respones => {
        this.initialize();
      });
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
          axios.patch('/back/attributes/' + this.editedItem.id, this.editedItem).then((response) => {
            this.initialize();
            this.close()
          }).catch((error) => {
            this.errors = error.response.data;
          });
        } else {
          axios.post('/back/attributes', this.editedItem).then((response) => {
            this.initialize();
            this.close()
          }).catch((error) => {
            this.errors = error.response.data;
          });
        }
      }
    }
  },
}
</script>
