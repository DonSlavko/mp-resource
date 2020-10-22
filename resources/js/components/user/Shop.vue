<template>
    <v-container>
        <h1>Active ingredients</h1>
        <v-row>
            <v-col cols="12" md="3">
                <!--<v-select outlined dense label="Brands"></v-select>-->
            </v-col>

            <v-col cols="12" md="3">
                <!--<v-select outlined dense label="Categories"></v-select>-->
            </v-col>

        </v-row>

        <v-row class="pb-10">
            <template v-for="(attribute, index) in attributes">
                <v-col cols="12">
                    <h3>{{ attribute.name }}</h3>
                </v-col>

                <v-col cols="12">
                    <v-btn-toggle v-model="filters.attributes[index]" group multiple dense color="primary">
                        <v-btn style="border: 0.5px solid; border-radius: 10px; margin: 6px" v-for="value in attribute.types"
                               :key="value.id" :value="value.id">
                            {{ value.name }}
                        </v-btn>
                    </v-btn-toggle>
                </v-col>
            </template>
        </v-row>
        <v-row>
            <v-col cols="12" md="3">
                <v-select
                    v-model="sort"
                    :items="sorting"
                    name="sorting"
                    label="Sort By:"
                    outlined
                    dense
                >
                    <template v-slot:append-outer>
                        <v-icon @click="changeOrder" v-if="order === 'asc'">
                            mdi-arrow-down
                        </v-icon>
                        <v-icon @click="changeOrder" v-else>
                            mdi-arrow-up
                        </v-icon>
                    </template>
                </v-select>
            </v-col>
            <v-col cols="12" md="3">
                <v-select
                    v-model="per_page"
                    :items="items_per_page"
                    name="view"
                    label="View:"
                    outlined
                    dense
                ></v-select>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12" sm="6" md="3" v-for="item in items" :key="item.id">
                <v-card max-width="400">
                    <a :href="'/shop/product/' + item.id">
                        <v-img :href="'/shop/product/' + item.id" class="black--text align-end"
                               height="300px" :src="item.image"></v-img>
                    </a>
                    <v-card-title>{{ item.name }}</v-card-title>
                    <v-card-actions class="justify-center">
                        <a :href="'/shop/product/' + item.id"> Details </a>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>

        <div class="text-center">
            <v-pagination
                v-model="page"
                :length="pages"
                :total-visible="7"
            ></v-pagination>
        </div>
    </v-container>
</template>

<script>
export default {
    name: "Shop",

    data() {
        return {
            items: [],

            brands: [],
            categories: [],
            attributes: [],
            variations: [],

            filters: {
                brands: [],
                categories: [],
                attributes: [],
                variations: [],
            },

            items_per_page: [
                {
                    text: "16 Products",
                    value: 16,
                },
                {
                    text: "32 Products",
                    value: 32,
                },
                {
                    text: "48 Products",
                    value: 48,
                },
            ],
            sorting: [
                {
                    text: "Default",
                    value: 'id',
                },
                {
                    text: "Name",
                    value: 'name',
                },
                {
                    text: "Date",
                    value: 'created_at',
                },
            ],

            order: 'asc',
            sort: 'id',
            per_page: 16,
            page: 1,
            pages: 1,
        };
    },

    created() {
        this.initialize();
        this.getAttributes();
    },

    watch: {
        page() {
            this.initialize();
        },

        per_page() {
            this.initialize();
        },

        sort() {
            this.initialize();
        },

        order() {
            this.initialize();
        },

        "filters.attributes": function() {
            this.initialize();
        }
    },

    methods: {
        initialize() {
            let params = {};

            params['page'] = this.page;
            params['per_page'] = this.per_page;
            params['sort'] = this.sort;
            params['order'] = this.order;
            this.filters.attributes.forEach((item, index) => {
                params["attributes_values_ids["+index+"]"] = item
            })

            axios
                .get("/back/shop", {
                    params
                })
                .then((response) => {
                    this.items = response.data.data;
                    this.page = response.data.meta.current_page;
                    this.pages = response.data.meta.last_page;
                })
                .catch((error) => {
                    console.log(error.message);
                });
        },

        changeOrder() {
            this.order = this.order === 'asc' ? 'desc' : 'asc';
        },

        getAttributes() {
            axios.get('/back/attributes_values').then(response => {
                this.attributes = response.data;

                this.attributes.forEach((item, index) => {
                    this.filters.attributes[index] = []
                })
            })
        }
    },
};
</script>
<style>
/*body {
    font-family: "Open Sans";
}

.button-group-pills .btn {
    padding: 25px 28px 25px 28px;
    border: 2px solid #ccc;
    background: transparent;
    color: #757575;
    min-width: 200px;
    height: 30px;
    border-radius: 10px;
    margin-top: 10px;
    margin-right: 14px;
    line-height: 0em;
    text-align: center;
    font-size: 15px;
    font-family: ubuntu;
    font-weight: bold;
}

.button-group-pills .btn.focus {
    outline-offset: none !important;
    outline: none;
    outline-color: none;
    color: #86af4a;
}

.button-group-pills .btn.active {
    border: 3px solid #86af4a;
    border-color: 3px solid #86af4a;
    background-color: transparent;
    color: #bbbbbb;
    box-shadow: none;
}

.button-group-pills .btn:hover {
    border-color: #bbbbbb;
    background-color: transparent;
    color: black;
}

.form-group input[type="checkbox"] {
    display: none;
}

.form-group input[type="checkbox"] + .btn-group > label span {
    width: 20px;
}

.form-group input[type="checkbox"] + .btn-group > label span:first-child {
    display: none;
}

.form-group input[type="checkbox"] + .btn-group > label span:last-child {
    display: inline-block;
}

.form-group
input[type="checkbox"]:checked
+ .btn-group
> label
span:first-child {
    display: inline-block;
}

.form-group
input[type="checkbox"]:checked
+ .btn-group
> label
span:last-child {
    display: none;
}

.card {
    border-radius: 4px;
    background: #fff;
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.08), 0 0 6px rgba(0, 0, 0, 0.05);
    transition: 0.3s transform cubic-bezier(0.155, 1.105, 0.295, 1.12),
    0.3s box-shadow,
    0.3s -webkit-transform cubic-bezier(0.155, 1.105, 0.295, 1.12);
    cursor: pointer;
}

.aa {
    background: red !important;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12), 0 4px 8px rgba(0, 0, 0, 0.06);
}

.v-card__title {
    color: black;
}

.link {
    color: black;
}

a {
    color: black !important;
}

.filter_button {
    padding: 22px 28px 22px 28px;
    border: 2px solid #ccc;
    background: transparent;
    color: #c1c1c1;
    min-width: 200px;
    height: 30px;
    border-radius: 10px;
    margin-top: 10px;
    margin-right: 14px;
    line-height: 0em;
    text-align: center;
    font-size: 13px;
    font-family: ubuntu;
    font-weight: bold;
    color: #757575;
}

.filter_button:focus {
    border: 5px solid green;
}*/
</style>
