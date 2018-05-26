import { create } from '../api/user'

const state = {
    user: {},
    authenticated: false
}

const actions = {

    createUser({ commit }, data) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await create(data)
                const json = response.data
                commit('setUser', json)
                commit('setAuthenticated', true)
                resolve()
            } catch (e) {
                reject(e)
            }
        })
    }

}

const mutations = {

    setUser(state, user) {
        state.user = user
    },

    setAuthenticated(state, authed) {
        state.authenticated = authed
    }

}

const getters = {
    getUser: state => state.user,
    getAuthenticated: state => state.authenticated
}

export default {
    state,
    actions,
    mutations,
    getters
}
