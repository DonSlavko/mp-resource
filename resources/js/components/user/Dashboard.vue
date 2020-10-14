<template>
	<v-container>
		<v-card>
			<v-toolbar
					flat
					color="white"
					white
			>
				<v-toolbar-title>User Profile</v-toolbar-title>
			</v-toolbar>
			<v-tabs vertical>
				<v-tab class="justify-start">
					<v-icon left>mdi-account</v-icon>
					Benutzerkonto bearbeiten
					<v-spacer></v-spacer>
					<v-icon right>mdi-menu-right-outline</v-icon>
				</v-tab>
				<v-tab class="justify-start">
					<v-icon left>mdi-newspaper-variant</v-icon>
					Rechnungen
					<v-spacer></v-spacer>
					<v-icon right>mdi-menu-right-outline</v-icon>
				</v-tab>
				<v-tab class="justify-start">
					<v-icon left>mdi-clipboard-text</v-icon>
					Bestellungen
					<v-spacer></v-spacer>
					<v-icon right>mdi-menu-right-outline</v-icon>
				</v-tab>
				<v-tab class="justify-start">
					<v-icon left>mdi-delete</v-icon>
					Konto löschen
					<v-spacer></v-spacer>
					<v-icon right>mdi-menu-right-outline</v-icon>
				</v-tab>

				<v-tab-item>
					<v-card flat>
						<v-card-text>
							<h3 class="pb-8">Konto</h3>

							<p class="pb-4">Eine Bearbeitung der Anschrift (Betriebsstätte=Lieferadresse)
								und E-Mail Adresse ist nicht gestattet!</p>

							<p class="pb-4">Nach unseren <a href="" download class="text-decoration-underline">allgemeinen
								Geschäftsbedingungen</a>
								<span class="font-weight-bold">gem. Ziffer 3.3</span>, sind Sie als „Kunde“
								verpflichtet, uns „dem Verkäufer“ unverzüglich via E-Mail oder Fax und zusätzlich
								via Telefon oder Rückrufservice anzuzeigen, wenn Veränderungen bei den in
								<span class="font-weight-bold">Ziffer 3.1</span> genannten Nachweisen stattgefunden haben.</p>

							<p class="pb-10">Melden Sie sich bitte zeitnah über E-Mail oder Fax und rufen Sie uns oder veranlassen
								Sie einen Rückruf über unseren Rückrufservice im Onlineshop an.</p>

							<p class="font-weight-bold">Hotline und E-Mail: Ärzte:</p>
							<p>02173 \ 940 9601 | aertze@mp-resource.shop</p>
							<p class="font-weight-bold">Apotheker:</p>
							<p>02173 \ 940 9602| apotheker@mp-resource.shop </p>
						</v-card-text>
					</v-card>
				</v-tab-item>
				<v-tab-item>
					<v-card flat>
						<v-card-text>
							<h3 class="pb-8">
								<v-icon left>mdi-newspaper-variant</v-icon>
								Rechnungen
							</h3>

							<v-data-table
									:headers="bills.headers"
									:items="bills.data"
									class="elevation-1"
							>
								<template v-slot:item.status="{ item }">
									<v-chip v-if="item.status === 'paid'"
									        small color="blue darken-1"
									        text-color="white">
										{{ item.status }}
									</v-chip>
									<v-chip v-else class="ma-2"
									        small color="red darken-1"
											    text-color="white">
										{{ item.status }}
									</v-chip>
								</template>

								<template v-slot:no-data>
									<p>Keine Rechnungen vorhanden.</p>
								</template>
							</v-data-table>
						</v-card-text>
					</v-card>
				</v-tab-item>

				<v-tab-item>
					<v-card flat>
						<v-card-text>
							<h3 class="pb-8">
								<v-icon left>mdi-clipboard-text</v-icon>
								Bestellungen
							</h3>

							<v-data-table
									:headers="orders.headers"
									:items="orders.data"
									class="elevation-1"
							>
								<template v-slot:no-data>
									<p>Keine Rechnungen vorhanden.</p>
								</template>
							</v-data-table>
						</v-card-text>
					</v-card>
				</v-tab-item>

				<v-tab-item>
					<v-card flat>
						<v-card-text>
							<h3 class="pb-8">
								<v-icon left>mdi-delete</v-icon>
								Konto löschen
							</h3>

							<h5 class="font-weight-bold">Mega Warning!</h5>
							<p>You are going to delete absolutely everything you've ever done in MP Resource
								Shop. Orders,
								Hearts, Comments, your profile... everything even your assets.</p>
							<p>You don’t need to delete your account to change your username, profile name, or
								email address.
								You can update your account information in your account settings.</p>
							<v-alert border="left" color="red darken-1" dark class="text-body-2">
								After you click the “Delete Account” button, your account will be permanently deleted from our site.
								This action can not be undone. A warning will pop up, if you are sure you want to delete your account,
								click the button that says “OK”.
							</v-alert>

							<v-btn color="red" class="font-weight-bold text-white"
							       large
							       dark
							       onclick="return confirm('Are you sure you want to delete account?')"
							       href="/delete-account">
								I Understand, Please Delete My Account
							</v-btn>
						</v-card-text>
					</v-card>
				</v-tab-item>
			</v-tabs>
		</v-card>
	</v-container>
</template>

<script>
export default {
	name: "Dashboard",

	data() {
		return {
			bills: {
				headers: [
					{
						text: '#',
						value: 'iteration'
					},
					{
						text: 'Customer Name',
						value: 'customer_name'
					},
					{
						text: 'Order Id',
						value: 'order_id'
					},
					{
						text: 'Amount',
						value: 'payment_amount'
					},
					{
						text: 'Status',
						value: 'status'
					},
					{
						text: 'Created',
						value: 'created_at'
					}
				],
				data: []
			},
			orders: {
				headers: [
					{
						text: '#',
						value: 'iteration'
					},
					{
						text: 'Total Amount',
						value: 'total_price'
					},
					{
						text: 'Status',
						value: 'status'
					},
					{
						text: 'Created',
						value: 'created_at'
					}
				],
				data: []
			},
		};
	},

	created() {
		this.getPayments();
		this.getOrders();
	},

	methods: {
		getOrders() {
			axios.get('/back/user/orders')
					.then((response) => {
						this.orders.data = response.data.data.map((item, index) => {

							let date = new Date(item.created_at);
							let year = date.getFullYear();
							let month = (1 + date.getMonth()).toString().padStart(2, '0');
							let day = date.getDate().toString().padStart(2, '0');

							item.created_at = year + '/' + month + '/' + day;
							item.iteration = index + 1;

							return item;
						});
					})
					.catch((error) => {
						console.log(error.message);
					});
		},

		getPayments() {
			axios.get('/back/user/payments')
					.then((response) => {
						this.bills.data = response.data.data.map((item, index) => {

							let date = new Date(item.created_at);
							let year = date.getFullYear();
							let month = (1 + date.getMonth()).toString().padStart(2, '0');
							let day = date.getDate().toString().padStart(2, '0');

							item.created_at = year + '/' + month + '/' + day;
							item.iteration = index + 1;

							return item;
						});
					})
					.catch((error) => {
						console.log(error.message);
					});
		}
	},
}
</script>

<style scoped>

</style>