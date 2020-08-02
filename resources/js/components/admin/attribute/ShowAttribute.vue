<template>
  <v-container v-if="item">
    <v-data-table show-select
                  :headers="table.headers"
                  :items="table.data"
                  :items-per-page="5"
                  class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-toolbar-title>Attribute: {{ item.name }}</v-toolbar-title>
          <v-divider
              class="mx-4"
              inset
              vertical
          ></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                  color="primary"
                  dark
                  class="mb-2"
                  v-bind="attrs"
                  v-on="on"
              >New Value</v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12">
                      <v-text-field v-model="editedItem.name" label="Attribute name"></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-textarea
                          v-model="editedItem.description"
                          solo
                          name="input-7-4"
                          label="Description"
                      ></v-textarea>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-btn
            small
            class="mr-2"
            :href="'variation/'+item.id"
            icon
        >
          <v-icon small
          >mdi-magnify</v-icon>
        </v-btn>
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
  name: "ShowAttribute",

  props: {
    item_id: null,
  },

  data () {
    return {
      item: null,

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
            text: 'Description',
            value: 'description'
          },
          {
            text: 'Actions',
            value: 'actions'
          }
        ],
        data: []
      },

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

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'New Value' : 'Edit Value'
    },
  },

  watch: {
    dialog (val) {
      val || this.close()
    },
  },

  created () {
    this.initialize()
  },

  methods: {
    initialize() {
      axios.get('/back/attributes/'+this.item_id).then(response => {
        this.item = response.data.data;
      }).catch(error => {
        console.log(error.message);
      });
    },

    editItem (item) {
      this.editedIndex = this.table.data.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      const index = this.table.data.indexOf(item)
      confirm('Are you sure you want to delete this item?') &&
      axios.delete('/back/attribute-values/'+item.id).then(respones => {
        this.initialize();
      });
    },

    close () {
      this.dialog = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    save () {
      if (this.editedIndex > -1) {
        axios.patch('/back/attribute-values/'+this.editedItem.id, this.editedItem).then(response => {
          this.initialize();
        })
      } else {
        axios.post('/back/attribute-values', this.editedItem).then(response => {
          this.initialize();
        })
      }
      this.close()
    },
  },
}
</script>

<style scoped>

</style>