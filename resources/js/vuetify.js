import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

const opts = {
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
