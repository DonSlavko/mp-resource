import Vue from "vue"
import {VueEditor} from "vue2-editor";

import Toasted from 'vue-toasted';
import VueSanitize from "vue-sanitize";
import dropdown from 'vue-dropdowns';

import Profile from "./components/user/profile";
import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';

import Newsletter from "./components/admin/newsletter/Newsletter.vue";
import HomeAttribute from "./components/admin/attribute/HomeAttribute";
import ShowAttribute from "./components/admin/attribute/ShowAttribute";

import HomeAttributeValue from "./components/admin/attribute_value/HomeAttributeValue";

import HomeBrands from "./components/admin/brand/HomeBrand";


import HomeCategory from "./components/admin/category/HomeCategory";

import HomeProduct from "./components/admin/product/HomeProduct";

import HomeUser from "./components/admin/user/HomeUser";

import HomeVariation from "./components/admin/variation/HomeVariation";
import ShowVariation from "./components/admin/variation/ShowVariation";

import HomeVariationValue from "./components/admin/variation_value/HomeVariationValue";

import HomeOrder from "./components/admin/order/HomeOrder";

import HomeCallService from "./components/admin/call-service/HomeCallService";

import Shop from "./components/user/Shop";


import Product from "./components/user/Product";
import Cart from "./components/user/Cart";
import Order from "./components/user/Order";
import PreOrder from "./components/user/PreOrder";
import vuetify from "./vuetify";
import CallService from "./components/modals/CallService";
import Dashboard from "./components/user/Dashboard";

Vue.component('login', Login);
Vue.component('register', Register);

Vue.component('home-attribute', HomeAttribute);
Vue.component('show-attribute', ShowAttribute);

Vue.component('home-brand', HomeBrands);
Vue.component('newsletter', Newsletter);
Vue.component('home-attribute-value', HomeAttributeValue);

Vue.component('home-category', HomeCategory);

Vue.component('home-product', HomeProduct);

Vue.component('home-user', HomeUser);

Vue.component('home-variation', HomeVariation);
Vue.component('show-variation', ShowVariation);

Vue.component('home-variation-value', HomeVariationValue);

Vue.component('home-order', HomeOrder);

Vue.component('home-call-service', HomeCallService);

Vue.component('profile', Profile);

Vue.component('shop', Shop);

Vue.component('product', Product);
Vue.component('cart', Cart);
Vue.component('order', Order);
Vue.component('preorder', PreOrder);
Vue.component('vue-editor', VueEditor);
Vue.component('dashboard', Dashboard)

Vue.component('call-service', CallService);

Vue.use(VueSanitize);

Vue.config.productionTip = false
Vue.use(Toasted, {
    duration: 3000
});
