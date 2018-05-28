import Vuex from 'vuex'
import Vue from 'vue'

import user from './user'
import auth from './auth'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        user,
        auth
    }
})

store.subscribe((mutation, state) => {
    switch (mutation.type) {
        case "setAccessToken":
            localStorage.setItem("accessToken", mutation.payload)
            break
        case "setExpiresIn":
            localStorage.setItem("expiresIn", mutation.payload)
            break
        default: break
    }
})

export default store
