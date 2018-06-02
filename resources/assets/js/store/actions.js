import Vuex from 'vuex'
import Vue from 'vue'

import user from './user'
import auth from './auth'
import exercise from './exercise'

export const startup = ({dispatch}) => {
    return new Promise(async (resolve, reject) => {
        try {
            const user = dispatch('getUser')
            const exercises = dispatch('getExercises')
            await Promise.all([user, exercises])
            resolve()
        } catch (e) {
            //TODO
            console.log(e)
        }
    })
}
