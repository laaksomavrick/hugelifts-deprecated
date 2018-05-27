import { create } from '../api/auth'

const state = {
    authenticated: false,
    accessToken: null,
    expiresIn: null
}

const actions = {

    createToken({ commit }, data) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await create(data)
                const json = response.data
                commit('setAuthenticated', true)
                resolve()
            } catch (e) {
                reject(e)
            }
        })
    }

}

const mutations = {

    setAuthenticated(state, authenticated) {
        state.authenticated = authenticated
    }

}

const getters = {
    getAuthenticated: state => state.authenticated
}

export default {
    state,
    actions,
    mutations,
    getters
}
