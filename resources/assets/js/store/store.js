import Vuex from 'vuex'
import Vue from 'vue'

import { startup } from './actions'

import user from './user'
import auth from './auth'
import exercise from './exercise'
import ui from './ui'
import routine from './routine'
import schedule from './schedule'

Vue.use(Vuex)

const store = new Vuex.Store({
    actions: {
        startup   
    },
    modules: {
        user,
        auth,
        exercise,
        ui,
        routine,
        schedule
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
