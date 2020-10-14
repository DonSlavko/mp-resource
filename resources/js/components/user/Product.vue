<template>
  <v-container>
    <v-row>
      <!-- <v-col cols="12" sm="6" md="5">
        <v-carousel hide-delimiters>
          <v-carousel-item
          style=""
            v-for="(item, i) in item.images"
            :key="i"
            :src="item.path"
          ></v-carousel-item>
        </v-carousel>
      </v-col> -->
      <v-col cols="12" sm="6" md="7">
        <h2 class="text-h5 mb-3" style="text-transform: uppercase">
          {{ item.name }}
        </h2>
        <hr
            style="
            background: #efefef;
            color: rgba(68, 68, 68, 1);
            height: 1px;
            width: 80%;
            border: none;
          "
        />
        <p v-html="this.$sanitize(item.description)"></p>
        <!-- <h3 class="text-subtitle-1  primary--text"><strong>In Stock:</strong> {{ item.stock_quantity }}</h3> -->
        <h3 class="text-subtitle-1 primary--text">
          <strong>SKU:</strong> {{ item.sku }}
        </h3>
        <v-row v-if="this.stock_count()">
          <v-col cols="12">
            <p>Variation Value Name</p>
            <v-btn-toggle v-model="selected" rounded>
              <template v-for="value in item.variationValues">
                <!-- Price:<strong class=""
                   >{{ value.pivot.price }}€</strong> -->
                <v-btn :value="value.variation_id">
                  {{ value.name }}
                </v-btn>

              </template>
            </v-btn-toggle>
            <div class="row mt-3">
              <p>Price for variations</p>
              <div v-for="value in item.variations">,
                <strong>{{ value.pivot.price }}</strong>
              </div>
            </div>

          </v-col>

          <v-col cols="12" md="3">
            <v-text-field v-model="quantity" label="Quantity" solo flat>
              <v-icon @click="addProduct()" slot="append" color="red"
              >mdi-plus
              </v-icon
              >
              <v-icon @click="subProduct()" slot="prepend" color="green"
              >mdi-minus
              </v-icon
              >
            </v-text-field>
          </v-col>

          <v-col cols="12" md="3">
            <v-btn @click="addToCart()">In Den Warenkorb</v-btn>
            <!-- :disabled="canAddToCart" -->
          </v-col>
        </v-row>
        <v-row v-else>
          <h3 class="btn btn-danger">Out of Stock</h3>
        </v-row>
      </v-col>

      <v-col cols="12">
        <template>
          <div class="text-center">
            Arzneibroschüre
            <v-btn
                :href="item.brochure"
                target="_blank"
                class="ma-2"
                outlined
                color="primary"
            >Download
            </v-btn
            >
            Chargenanalyse
            <v-btn
                :href="item.analysis"
                target="_blank"
                class="ma-2"
                outlined
                color="primary"
            >Download
            </v-btn
            >
          </div>
        </template>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "Product",

  props: {
    item_id: null,
  },

  data() {
    return {
      item: null,
      selected: "",
      quantity: 1,
      count: "",
    };
  },

  computed: {
    canAddToCart() {
      // return this.selected && this.quantity < this.item.stock_quantity;
    },
  },

  created() {
    this.initialize();
    this.countcart();
    this.stock_count();
  },

  methods: {
    addProduct() {
      this.quantity++;
    },
    stock_count() {
      if (this.item.variation_stock == "0") {
        return false;
      } else {
        return true;
      }
      //return this.item.variation_stock;
    },

    subProduct() {
      if (this.quantity > 1) {
        this.quantity--;
      }
    },

    initialize() {
      axios
          .get("/back/shop/" + this.item_id)
          .then((response) => {
            this.item = response.data;
          })
          .catch((error) => {
            console.log(error.message);
          });
    },
    formData() {
      return {
        product_id: this.item_id,
        variation_id: this.selected,
        quantity: this.quantity,
      };
    },
    countcart() {
      axios.get("/back/getcount").then((response) => {
        console.log("count");
      });
    },

    addToCart() {
      axios.post("/back/add-to-cart", this.formData()).then((response) => {
        this.$toasted.show(response.data[1]);
        this.stock_count();
        this.count = response.data[0];
        document.getElementById("cart-count").innerHTML = this.count;
        this.selected = null;
        this.quantity = 1;
      });
    },
  },
};
</script>
