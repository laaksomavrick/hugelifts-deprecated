import Vuex from 'vuex'
import Vue from 'vue'

export const startup = ({dispatch}) => {
    return new Promise(async (resolve, reject) => {
        try {
            const user = dispatch('fetchUser')
            const exercises = dispatch('fetchExercises')
            const routines = dispatch('fetchRoutines')
            const schedule = dispatch('fetchSchedule')
            await Promise.all([user, exercises, routines, schedule])
            resolve()
        } catch (e) {
            //TODO
            console.log(e)
        }
    })
}
