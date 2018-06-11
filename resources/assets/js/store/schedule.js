import { get, update } from '../api/schedule'

const state = {
    schedule: {}
}

const actions = {

    fetchSchedule({ commit }) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await get()
                const json = response.data
                console.log(response)
                commit('setSchedule', json)
                resolve()
            } catch (e) {
                reject(e.response)
            }
        })
    },

    updateSchedule({ commit }, data) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await update(data)
                const json = response.data
                commit('setSchedule', json)
                resolve()
            } catch (e) {
                reject(e)
            }
        })
    },

}

const mutations = {

    setSchedule(state, schedule) {
        state.schedule = schedule
    }

}

const getters = {
    getSchedule: state => state.schedule,
}

export default {
    state,
    actions,
    mutations,
    getters
}
