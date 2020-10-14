/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import vuetify from './vuetify';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

require('./components');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    vuetify,
    el: '#app',

    data: {
        input: {
            password: null,
            password_repeat: null,
        },
        validate: {
            name: [
                value => !!value || 'Dieses Feld ist erforderlich.'
            ],
            email: [
                value => !!value || 'Dieses Feld ist erforderlich.',
                value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || 'Bitte gib eine gültige E-Mail-Adresse an.'
                },
            ],
            password: [
                value => !!value || 'Passwort angeben',
                value => {
                    const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!\$%&\*?\,\_])(?=.{8,})/;
                    return (
                        pattern.test(value) ||
                        "Minimum 10 Zeichen\n" +
                        "mind. ein Großbuchstaben\n" +
                        "einen Kleinbuchstaben\n" +
                        "eine Zahl\n" +
                        "ein Sonderzeichen ( !$%&?*,_ )"
                    );
                }
            ],
            password_repeat: value => !!value || 'Passwort wiederholen',
        }
    },

    computed: {
        confirmPassword() {
            return (this.input.password === this.input.password_repeat) || 'Die Passwörter stimmen nicht überein';
        },
    },

    methods: {
        logout() {
            axios.post('/logout').then((response) => {
                window.location = "/"
            })
        }
    }
});
