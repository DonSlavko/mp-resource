<template>
  <v-container>
    <v-row>
      <v-col cols="12" sm="6" md="5">
        <v-carousel hide-delimiters>
          <v-carousel-item
              v-for="(item,i) in items"
              :key="i"
              :src="item.src"
          ></v-carousel-item>
        </v-carousel>
      </v-col>

      <v-col cols="12" sm="6" md="7">
        product details
      </v-col>

      <v-col cols="12">
        pdf etc.
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "Product",

  props: {
    item_id: null
  },

  data () {
    return {
      items: [
        {
          src: '/storage/Fortis-6-500x601.png',
        },
        {
          src: '/storage/MPR-Canna-Fortis-5-Gramm-500x601.png',
        },
        {
          src: '/storage/Sedation2-500x601.png',
        },
        {
          src: '/storage/Vesper-7-500x601.png',
        },
      ],
    }
  },
}
</script>
