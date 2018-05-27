import Vuex from 'vuex'
import Vue from 'vue'

import user from './user'
import auth from './auth'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        user,
        auth
    }
})
