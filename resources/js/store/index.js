import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

import cart from './modules/cart'

export default new Vuex.Store({
    modules: {
        cart,
    },
    strict: true,
})
