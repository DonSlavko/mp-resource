<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="6" md="4" v-for="item in items" :key="item.id">
                <v-card
                    class="mx-auto"
                    max-width="400"
                >
                    <v-img v-if="item.images.length > 0"
                        class="black--text align-end"
                        height="450px"
                        :src="item.images[0].path"
                    >
                        <v-card-title>{{ item.name }}</v-card-title>
                    </v-img>

                    <v-card-subtitle class="pb-0">{{ item.price }} €</v-card-subtitle>

                    <v-card-actions>
                        <v-btn
                            color="orange"
                            text
                        >
                            Ausführung wählen
                        </v-btn>

                        <v-row justify="end" class="pr-3">
              <v-btn
                  color="orange"
                  text
                  :href="'/shop/product/'+item.id"
              >
                Details
              </v-btn>
            </v-row>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: "Shop",

    data () {
        return {
            items: [],
        }
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            axios.get('/back/shop').then(response => {
                this.items = response.data;
            }).catch(error => {
                console.log(error.message);
            });
        },
    }
}
</script>
