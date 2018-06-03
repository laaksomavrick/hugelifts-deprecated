import { get, create, update } from '../api/exercise'

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

    updateExercise({ commit }, data) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await update(data)
                const json = response.data
                commit('editExercise', json)
                resolve()
            } catch (e) {
                reject(e)
            }
        })
    },

    createExercise({ commit }, data) {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await create(data)
                const json = response.data
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
    },

    editExercise(state, exercise) {
        const filtered = state.exercises.filter(e => e.id !== exercise.id)
        state.exercises = [...filtered, exercise]
    },

}

const getters = {
    getExercises: state => state.exercises,
    getExercise: state => id => state.exercises.find(e => e.id === id)
}

export default {
    state,
    actions,
    mutations,
    getters
}
