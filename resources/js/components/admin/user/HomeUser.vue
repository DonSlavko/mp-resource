<template>
	<v-container>
		<v-card>
			<v-tabs color="light-green darken-1" left>
				<v-tab>Users</v-tab>
				<v-tab>Declined Users</v-tab>

				<v-tab-item key="1">
					<v-data-table show-select
					              :headers="table.headers"
					              :items="table.data"
					              :items-per-page="5"
					              class="elevation-1">

						<template v-slot:item.btmnr="{ item }">
							<v-btn v-if="item.files" small dense @click="showFiles(item)">Show Files</v-btn>
							<v-btn v-else small dense disabled>No Files</v-btn>

							<v-list-item-group color="primary" v-if="item.show_files">
								<template v-for="file in item.files">
									<v-list-item dense>
										<v-list-item-content>
											<a :href="file.path" download>{{ file.name }}</a>
										</v-list-item-content>
									</v-list-item>
								</template>
							</v-list-item-group>
						</template>

						<template v-slot:item.email_verified="{ item }">
							<span v-if="item.email_verified_at === null">Unverified</span>
							<span v-else>Verified</span>
						</template>

						<template v-slot:item.activated="{ item }">
							<v-btn small dense v-if="item.active" @click="deactivateAcc(item)">Deactivate</v-btn>
							<v-btn small dense v-else @click="activateAcc(item)">Activate</v-btn>
						</template>
					</v-data-table>
				</v-tab-item>

				<v-tab-item key="2">
					<v-data-table show-select
					              :headers="declinedTable.headers"
					              :items="declinedTable.data"
					              :items-per-page="5"
					              class="elevation-1">
						<template v-slot:top>
							<v-toolbar flat color="white">
								<v-spacer></v-spacer>
								<v-btn small dense :disabled="!deleteAllBtn" @click="deleteAllDeclinedUsers()">
									Delete All Declined Users
								</v-btn>
							</v-toolbar>
						</template>
						<template v-slot:item.action="{ item }">
							<v-btn @click="deleteUser(item)" small dense>Delete</v-btn>
						</template>
					</v-data-table>
				</v-tab-item>
			</v-tabs>
		</v-card>
	</v-container>
</template>

<script>
export default {
	name: "HomeUser",

	data() {
		return {
			tab: null,
			declinedData: [],
			deleteAllBtn: false,
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
			declinedTable: {
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
						text: 'Phone',
						value: 'phone',
					},
					{
						text: 'Action',
						value: 'action'
					}
				],
				data: []
			}
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
		this.initialize();
		this.declinedUsers();
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

		declinedUsers() {
			axios.get('/back/declinedUsers/').then(response => {
				console.log(response.data.data.length);
				if (response.data.data.length > 0) {
					this.deleteAllBtn = true;
				} else {
					this.deleteAllBtn = false;
				}
				this.declinedTable.data = response.data.data;
			})
		},

		showFiles(item) {
			item.show_files = !item.show_files;
		},

		activateAcc(item) {
			axios.post('/back/users/' + item.id + '/activate').then(response => {
				this.$toasted.show(response.data.message);
				item.active = true;
				this.declinedUsers();
			});
		},

		deactivateAcc(item) {
			axios.post('/back/users/' + item.id + '/deactivate').then(response => {
				this.$toasted.show(response.data.message);
				item.active = false;
				this.declinedUsers();
			});
		},

		deleteUser(item) {
			if (confirm('Are you sure?')) {
				axios.post('/back/users/' + item.id + '/delete').then(response => {
					this.declinedUsers();
					this.initialize();
					this.$toasted.show(response.data.message);
				});
			}
		},

		deleteAllDeclinedUsers() {
			if (confirm('Are you sure you want to delete all declined users?')) {
				axios.get('/back/deleteUsers/').then(response => {
					this.declinedUsers();
					this.initialize();
					this.deleteAllBtn = false;
					this.$toasted.show(response.data.message);
				})
			}
		},
	},
}
</script>
