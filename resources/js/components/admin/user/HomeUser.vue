<template>
  <v-container>
    <v-data-table show-select
                  :headers="table.headers"
                  :items="table.data"
                  :items-per-page="5"
                  class="elevation-1"
    >
      <template v-slot:item.btmnr="{ item }">
        <v-btn small dense @click="showFiles(item)">Show Files</v-btn>
        <v-list-item-group color="primary" v-if="item.show_files">
          <v-list-item dense :href="item.file_1.path">
            <v-list-item-content>
              <v-list-item-title v-text="item.file_1.name"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item dense :href="item.file_2.path">
            <v-list-item-content>
              <v-list-item-title v-text="item.file_2.name"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item dense :href="item.file_3.path">
            <v-list-item-content>
              <v-list-item-title v-text="item.file_3.name"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </template>
      <template v-slot:item.activated="{ item }">
        <v-btn small dense v-if="!!item.activated_at === false" @click="activateAcc(item)">Activate</v-btn>
        <v-btn small dense v-else @click="deactivateAcc(item)">Deactivate</v-btn>

      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon
            small
            class="mr-2"
        >
          mdi-pencil
        </v-icon>
        <v-icon
            small
        >
          mdi-delete
        </v-icon>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
export default {
  name: "HomeUser",

  data () {
    return {
      table: {
        headers: [
          {
            text: 'ID',
            value: 'id',
          },
          {
            text: 'Username',
            value: 'username',
          },
          {
            text: 'Name',
            value: 'name',
            sortable: false,
          },
          {
            text: 'Email',
            value: 'email',
          },
          {
            text: 'Role',
            value: 'role',
            sortable: false,
          },
          {
            text: 'BTMNR',
            value: 'btmnr',
            sortable: false,
          },
          {
            text: 'registriert seit',
            value: 'created_at',
            sortable: false,
          },
          {
            text: 'bestätigt',
            value: 'email_verified',
            sortable: false,
          },
          {
            text: 'Activate',
            value: 'activated',
            sortable: false,
          },
          {
            text: 'Status',
            value: 'status',
            sortable: false,
          },
          {
            text: 'Actions',
            value: 'actions',
            sortable: false,
          },
        ],
        data: [
          {
            id: 1,
            username: 'Slavconi',
            name: 'Slavco',
            email: 'sl@example.com',
            role: 'customer',
            activated_at: null,
            show_files: false,
            file_1: {
              name: 'fajl 1',
              path: '/assdf/image.png'
            },
            file_2: {
              name: 'fal2',
              path: '/assdfe/image.png'
            },
            file_3: {
              name: 'fajlic 3',
              path: '/assdfw/image.png'
            },
            created_at: 234,
            email_verified: 234,
            status: 234,
          }
        ],
      },
    }
  },

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
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
    initialize () {
      return null;
    },

    showFiles(item) {
      item.show_files = !item.show_files;
    },

    activateAcc(item) {
      return item.activated_at = true;
    },

    deactivateAcc(item) {
      return item.activated_at = false;
    },

    editItem (item) {
      this.editedIndex = this.desserts.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      const index = this.desserts.indexOf(item)
      confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
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
        Object.assign(this.desserts[this.editedIndex], this.editedItem)
      } else {
        this.desserts.push(this.editedItem)
      }
      this.close()
    },
  },
}
</script>