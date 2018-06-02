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
    },

    createExercise({ commit }, data) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await create(data)
                const json = response.data
                console.log(response)
                console.log(json)
                commit('addExercise', json)
                resolve()
            } catch (e) {
                reject(e)
            }
        })
    }

}

const mutations = {

    setExercises(state, exercises) {
        state.exercises = exercises
    },

    addExercise(state, exercise) {
        state.exercises = [...state.exercises, exercise]
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
