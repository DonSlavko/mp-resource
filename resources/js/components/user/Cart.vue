<template>
  <div>
    <div>
      <v-container>
        <h2 class="mb-3">You Have {{ items.length }} Items In Your Cart</h2>
        <v-data-table
            :headers="headers"
            :items="items"
            :items-per-page="15"
            class="elevation-1"
        >
          <template v-slot:item.price="{ item }"
          >{{ item.price }} €
          </template
          >
          <template v-slot:item.total="{ item }"
          >{{ item.quantity * item.price }} €
          </template
          >
          <template v-slot:item.actions="{ item }">
            <v-icon small @click="removeItem(item)"> mdi-delete</v-icon>
          </template>
          <template v-slot:no-data> Cart is empty</template>
          <template v-slot:footer>
            <v-row align="center" justify="center" class="text-center">
              <!-- <v-col cols="12" md="6" order="2" order-md="1">
                <v-btn @click="makeOrder()" :disabled="!hasItems"
                  >Vorbestellen</v-btn
                >
              </v-col> -->
              <!-- <v-col cols="12" md="6" order="1" order-md="2">
                <p class="mb-0">Total price: {{ totalPrice }} €</p>
              </v-col> -->
            </v-row>
          </template>
        </v-data-table>
      </v-container>
    </div>
    <div class="container row">
      <div class="col-md-8"></div>
      <div class="col-md-4">
        <h1>Shopping cart total</h1>
        <hr/>
        <table class="table table-borderless" style="border-spacing: 10px">
          <tbody>
          <tr>
            <th>{{ this.headers[4].text }}</th>
            <td>{{ this.totalPrice }}€</td>
          </tr>
          </tbody>
        </table>
        <div>
          <p class="row ml-4">
            <v-checkbox
                v-model="checkbox_value"
                class="mt-0"
                @change="checking(this.checkbox_value)"
            ></v-checkbox>
            I accept the <strong> <a href="#"> Terms and Conditions</a></strong></p>
          <div>
            <div class="ml-5" v-if="this.true_Value">
              <a
                  :disabled="!hasItems"
                  class="btn btn-primary text-white preorder mb-2"
                  href="/payment"
              >Pre Order</a>
              <!-- <a class="btn btn-danger" href="{{route('user.payment')}}">Pay-Out</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <br/>
  </div>
</template>

<script>
export default {
  name: "Cart",

  data() {
    return {
      headers: [
        {
          text: "Product Name",
          value: "product_name",
          sortable: false,
        },
        {
          text: "variation value name",
          value: "variation_value_name",
          sortable: false,
        },
        {
          text: "Quantity",
          value: "quantity",
          sortable: false,
        },
        {
          text: "Price",
          value: "price",
          sortable: false,
        },
        {
          text: "Total Price",
          value: "total",
          sortable: false,
        },
        {
          text: "Options",
          value: "actions",
          sortable: false,
        },
      ],
      items: [],
      product_detail: [],
      checkbox_value: "",
      true_Value: false,
    };
  },

  computed: {
    totalPrice() {
      let total_total = 0;

      this.items.forEach((item) => {
        total_total += item.quantity * item.price;
      });

      return total_total;
    },

    cartIds() {
      return this.items.map((item) => {
        return item.id;
      });
    },
    checking(value) {
      if (value.checkbox_value == true) {
        this.true_Value = true;
      } else {
        this.true_Value = false;
      }
    },
    hasItems() {
      return this.items[0].quantity > 0;
    },
  },

  created() {
    this.initialize();
  },
  mounted() {
    this.checking();
    this.initialize();
  },

  methods: {
    initialize() {
      axios
          .get("/back/in-cart")
          .then((response) => {
            this.items = response.data.data;
            this.product_detail = response.data.data.map((item) => {
              return (item = {
                quantity: item.quantity,
              });
            });
          })
          .catch((error) => {
            console.log(error.message);
          });
    },

    removeItem(item) {
      axios
          .delete("/back/remove-from-cart/" + item.id)
          .then((response) => {
            this.initialize();
            this.count = response.data;
            document.getElementById("cart-count").innerHTML = this.count;
            this.initialize();
          })
          .catch((error) => {
            console.log(error.message);
          });
    },

    formData() {
      return {
        carts_id: this.cartIds,
        total_price: this.totalPrice,
        // product_id: this.product_detail,
      };
    },

    makeOrder() {
      axios
          .post("/back/make-order", this.formData())
          .then((response) => {
            console.log(response.data);
            this.initialize();
            this.$toasted.show(response.data);
            window.location.href = "/vorbestellungen/my-pre-orders";
          })
          .catch((error) => {
            console.log(error.message);
          });
    },
  },
};
</script>