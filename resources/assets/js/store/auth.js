import { authenticate } from '../api/auth'

const state = {
    authenticated: false,
    accessToken: null,
    expiresIn: null
}

const actions = {

    createToken({ commit }, data) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await authenticate(data)
                const json = response.data
                commit('setAccessToken', json.access_token)
                commit('setExpiresIn', json.expires_in)
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
    },

    setAccessToken(state, token) {
        state.accessToken = token
    },

    setExpiresIn(state, expiry) {
        state.expiresIn = expiry
    }

}

const getters = {
    getAuthenticated: state => state.authenticated,
    getAccessToken: state => state.accessToken,
}

export default {
    state,
    actions,
    mutations,
    getters
}
