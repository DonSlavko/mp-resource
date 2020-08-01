import Vue from "vue"

import Login from './components/auth/Login.vue';


import HomeAttribute from "./components/admin/attribute/HomeAttribute";
import ShowAttribute from "./components/admin/attribute/ShowAttribute";

import HomeCategory from "./components/admin/category/HomeCategory";

import HomeProduct from "./components/admin/product/HomeProduct";

import HomeUser from "./components/admin/user/HomeUser";

import HomeVariation from "./components/admin/variation/HomeVariation";
import ShowVariation from "./components/admin/variation/ShowVariation";

Vue.component('login', Login);

Vue.component('home-attribute', HomeAttribute);
Vue.component('show-attribute', ShowAttribute);

Vue.component('home-category', HomeCategory);

Vue.component('home-product', HomeProduct);

Vue.component('home-user', HomeUser);

Vue.component('home-variation', HomeVariation);
Vue.component('show-variation', ShowVariation);

