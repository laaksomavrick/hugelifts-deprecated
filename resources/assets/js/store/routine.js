import { get, create, update, destroy } from '../api/routine'

const state = {
    routines: []
}

const actions = {

    fetchRoutines({ commit }) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await get()
                const json = response.data
                commit('setRoutines', json)
                resolve()
            } catch (e) {
                reject(e.response)
            }
        })
    },

    updateRoutine({ commit }, data) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await update(data)
                const json = response.data
                commit('editRoutine', json)
                resolve()
            } catch (e) {
                reject(e)
            }
        })
    },

    createRoutine({ commit }, data) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await create(data)
                const json = response.data
                commit('addRoutine', json)
                resolve()
            } catch (e) {
                reject(e)
            }
        })
    },

    destroyRoutine({ commit }, id) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await destroy(id)
                const json = response.data
                commit('removeRoutine', id)
                resolve()
            } catch (e) {
                reject(e)
            }
        })
    },

}

const mutations = {

    setRoutines(state, routines) {
        state.routines = routines
    },

    addRoutine(state, routine) {
        state.routines = [...state.routines, routine]
    },

    editRoutine(state, routine) {
        const filtered = state.routines.filter(e => e.id !== routine.id)
        state.routines = [...filtered, routine]
    },

    removeRoutine(state, id) {
        const filtered = state.routines.filter(e => e.id !== id)
        state.routines = [...filtered]
    }

}

const getters = {
    getRoutines: state => state.routines,
    getRoutine: state => id => state.routines.find(e => e.id === id)
}

export default {
    state,
    actions,
    mutations,
    getters
}
