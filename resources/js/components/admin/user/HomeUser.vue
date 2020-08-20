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
                    <template v-for="file in item.files">
                        <v-list-item dense :href="file.path" >
                            <v-list-item-content>
                                <v-list-item-title v-text="file.name"></v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-list-item-group>
            </template>
            <template v-slot:item.email_verified="{ item }">

                <p v-if="item.email_verified_at === null">Unverified</p>
                <p v-else>Verified</p>

            </template>
            <template v-slot:item.activated="{ item }">
                <v-btn small dense v-if="item.active" @click="deactivateAcc(item)">Deactivate</v-btn>
                <v-btn small dense v-else @click="activateAcc(item)">Activate</v-btn>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
export default {
    name: "HomeUser",

    data() {
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
                ],
                data: [],
            },
        }
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
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
            axios.get('/back/users').then(response => {
                this.table.data = response.data.data.map(item => {
                    let date = new Date(item.created_at);
                    let year = date.getFullYear();
                    let month = (1 + date.getMonth()).toString().padStart(2, '0');
                    let day = date.getDate().toString().padStart(2, '0');

                    item.created_at = year + '/' + month + '/' + day;

                    item.show_files = false;
                    return item;
                })
            })
        },

        showFiles(item) {
            item.show_files = !item.show_files;
        },

        activateAcc(item) {
            axios.post('/back/users/' + item.id + '/activate').then(response => {
                item.active = true;
            });
        },

        deactivateAcc(item) {
            axios.post('/back/users/' + item.id + '/deactivate').then(response => {
                item.active = false;
            });
        },
    },
}
</script>
