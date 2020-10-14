<template>
  <v-container>
    <v-data-table
        show-select
        :headers="table.headers"
        :items="table.data"
        :items-per-page="5"
        class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-toolbar-title>Variation Value</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on"
              >Create Variation Value
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
                        <v-select
                            :rules="rules.select"
                            v-model="editedItem.variation_id"
                            :items="variation"
                            label="Variation"
                            outlined
                            dense
                        ></v-select>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                            :error="errors.name"
                            :error-messages="errors.name"
                            :rules="rules"
                            :counter="255"
                            v-model="editedItem.name"
                            label="Attribute value name"
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12">
                        <v-textarea
                            v-model="editedItem.description"
                            label="Description"
                        ></v-textarea>
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
                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>

      <template v-slot:item.actions="{ item }">
        <v-btn small class="mr-2" :href="'attribute/' + item.id" icon>
          <v-icon small>mdi-magnify</v-icon>
        </v-btn>
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
  name: "HomeVariationValue",

  data() {
    return {
      table: {
        headers: [
          {
            text: "ID",
            value: "id",
          },
          {
            text: "Variation ID",
            value: "variation_id",
          },
          {
            text: "Name",
            value: "name",
          },
          {
            text: "Description",
            value: "description",
          },
          {
            text: "Actions",
            value: "actions",
          },
        ],
        data: [],
      },

      errors: [],
      variation: [],
      variation_id: "",

      dialog: false,

      editedIndex: -1,

      editedItem: {
        name: "",
        description: "",
        variation_id: "",
      },

      defaultItem: {
        name: "",
        description: "",
      },

      rules: [
        (value) => !!value || "Name field is required",
        (value) =>
            value.length <= 255 || "Name must be less than 255 characters long",
      ],
    };
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Attribute" : "Edit Attribute";
    },
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
    initialize() {
      axios
          .get("/back/variation-values")
          .then((response) => {
            this.table.data = response.data.data;
            this.variation = response.data.data2.map((item) => {
              return (item = {
                text: item.name,
                value: item.id,
              });
            });
          })
          .catch((error) => {
            console.log(error.message);
          });
    },

    editItem(item) {
      this.editedIndex = this.table.data.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.table.data.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
      axios.delete("/back/variation-values/" + item.id).then((respones) => {
        this.initialize();
      });
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.$refs.modal.validate()) {
        if (this.editedIndex > -1) {
          axios
              .patch(
                  "/back/variation-values/" + this.editedItem.id,
                  this.editedItem
              )
              .then((response) => {
                this.initialize();
                this.close();
                this.$toasted.show(response.data)
              })
              .catch((error) => {
                this.errors = error.response.data;
              });
        } else {
          axios
              .post("/back/variation-values", this.editedItem)
              .then((response) => {
                this.initialize();
                this.close();
                this.$toasted.show(response.data)
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
