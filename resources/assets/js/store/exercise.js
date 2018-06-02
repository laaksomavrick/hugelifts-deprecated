import { get, create } from '../api/exercise'

const state = {
    exercises: []
}

const actions = {

    fetchExercises({ commit }) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await get()
                const json = response.data
                commit('setExercises', json)
                resolve()
            } catch (e) {
                reject(e.response)
            }
        })
    }

}

const mutations = {

    setExercises(state, exercises) {
        state.exercises = exercises
    }

}

const getters = {
    getExercises: state => state.exercises
}

export default {
    state,
    actions,
    mutations,
    getters
}
