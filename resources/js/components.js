import Vue from "vue"

import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';


import HomeAttribute from "./components/admin/attribute/HomeAttribute";
import ShowAttribute from "./components/admin/attribute/ShowAttribute";

import HomeCategory from "./components/admin/category/HomeCategory";

import HomeProduct from "./components/admin/product/HomeProduct";

import HomeUser from "./components/admin/user/HomeUser";

import HomeVariation from "./components/admin/variation/HomeVariation";
import ShowVariation from "./components/admin/variation/ShowVariation";

import HomeOrder from "./components/admin/order/HomeOrder";

import Shop from "./components/user/Shop";
import Product from "./components/user/Product";
import Cart from "./components/user/Cart";
import Order from "./components/user/Order";

import CallService from "./components/modals/CallService";
import HomeCallService from "./components/admin/call-service/HomeCallService";

Vue.component('login', Login);
Vue.component('register', Register);

Vue.component('home-attribute', HomeAttribute);
Vue.component('show-attribute', ShowAttribute);

Vue.component('home-category', HomeCategory);

Vue.component('home-product', HomeProduct);

Vue.component('home-user', HomeUser);

Vue.component('home-variation', HomeVariation);
Vue.component('show-variation', ShowVariation);

Vue.component('home-order', HomeOrder);

Vue.component('home-call-service', HomeCallService)

Vue.component('shop', Shop);
Vue.component('product', Product);
Vue.component('cart', Cart);
Vue.component('order', Order);

Vue.component('call-service', CallService);
