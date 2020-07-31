import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader

Vue.use(Vuetify)

const opts = {
    icons: {
        iconfont: 'mdi', // default - only for display purposes
    },
    theme: {
        themes: {
            light: {
                primary: '#86af49',
                secondary: '#e5e5e5',
                accent: '#8c9eff',
                error: '#b71c1c',
            },
        },
    },
}

export default new Vuetify(opts)
