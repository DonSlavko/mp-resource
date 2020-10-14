<template>
  <v-container v-if="item">
    <v-data-table show-select
                  :headers="table.headers"
                  :items="item.variation_values"
                  :items-per-page="5"
                  class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-toolbar-title>Variation: {{ item.name }}</v-toolbar-title>
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
              >New Value
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12">
                      <v-text-field
                          :error="errors.name" :error-messages="errors.name"
                          :rules="rules" :counter="255"
                          v-model="editedItem.name" label="Value name"></v-text-field>
                    </v-col>

                    <v-col cols="12">
                      <v-textarea
                          v-model="editedItem.description"
                          label="Description"></v-textarea>
                    </v-col>

                    <v-col cols="12">
                      <v-alert v-if="errors.message" type="error">
                        {{ errors.message }}
                      </v-alert>
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
      <template v-slot:item.description="{ item }">
        {{ item.description ? item.description.slice(0, 60) : '-' }}
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
  name: "ShowVariation",

  props: {
    item_id: null,
  },

  data() {
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

      rules: [
        value => !!value || "Name field is required",
        value => value.length <= 255 || "Name must be less than 255 characters long",
      ],
    }
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? 'New Value' : 'Edit Value'
    },
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
      axios.get('/back/variations/' + this.item_id).then(response => {
        this.item = response.data.data;
      }).catch(error => {
        console.log(error.message);
      });
    },

    editItem(item) {
      this.editedIndex = this.item.variation_values.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem(item) {
      const index = this.item.variation_values.indexOf(item)
      confirm('Are you sure you want to delete this item?') &&
      axios.delete('/back/variation-values/' + item.id).then(respones => {
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

    formData() {
      return {
        name: this.editedItem.name,
        description: this.editedItem.description,
        variation_id: this.item_id,
      }
    },

    save() {
      if (this.editedIndex > -1) {
        axios.patch('/back/variation-values/' + this.editedItem.id, this.formData()).then((response) => {
          this.initialize();
          this.close();
          this.$toasted.show(response.data)
        }).catch((error) => {
          this.errors = error.response.data;
        });
      } else {
        axios.post('/back/variation-values', this.formData()).then((response) => {
          this.initialize();
          this.close();
          this.$toasted.show(response.data)
        }).catch((error) => {
          this.errors = error.response.data;
        });
      }
    },
  },
}
</script>

<style scoped>

</style>
