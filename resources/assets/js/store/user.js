import { create, get } from '../api/user'

const state = {
    user: {}
}

const actions = {

    createUser({ commit }, data) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await create(data)
                const json = response.data
                commit('setUser', json)
                resolve()
            } catch (e) {
                reject(e.response)
            }
        })
    },

    fetchUser({ commit }) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await get()
                const json = response.data
                commit('setUser', json)
                resolve()
            } catch (e) {
                reject(e.response)
            }
        })
    }

}

const mutations = {

    setUser(state, user) {
        state.user = user
    }

}

const getters = {
    getUser: state => state.user
}

export default {
    state,
    actions,
    mutations,
    getters
}
