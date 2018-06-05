import Vue from 'vue'
import Router from 'vue-router'

import Home from './views/Home'
import Login from './views/Login'
import Create from './views/Create'
import Schedule from './views/Schedule'
import Routine from './views/Routine'
import CreateRoutine from './views/CreateRoutine'
import EditRoutine from './views/EditRoutine'
import Lifts from './views/Lifts'
import CreateLift from './views/CreateLift'
import EditLift from './views/EditLift'

import Store from'./store/store'

import { checkAndSetAuthenticated } from './utils/auth'
import { 
    ACTIVE_ROUTE, 
    ROUTINES_ROUTE, 
    LIFTS_ROUTE,
    HOME_ROUTE,
    LOGIN_ROUTE,
    CREATE_ROUTE,
    NEW_LIFT_ROUTE,
    EDIT_LIFT_ROUTE,
    NEW_ROUTINE_ROUTE,
    EDIT_ROUTINE_ROUTE,
} from './constants'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: HOME_ROUTE,
            component: Home,
            meta: { auth: true },
            redirect: ACTIVE_ROUTE,
            children: [
                {
                    path: ACTIVE_ROUTE,
                    name: ACTIVE_ROUTE,
                    component: Schedule
                },
                {
                    path: ROUTINES_ROUTE,
                    name: ROUTINES_ROUTE,
                    component: Routine
                },
                {
                    path: NEW_ROUTINE_ROUTE,
                    name: NEW_ROUTINE_ROUTE,
                    component: CreateRoutine
                },
                {
                    path: EDIT_ROUTINE_ROUTE,
                    name: EDIT_ROUTINE_ROUTE,
                    component: EditRoutine
                },
                {
                    path: LIFTS_ROUTE,
                    name: LIFTS_ROUTE,
                    component: Lifts
                },
                {
                    path: NEW_LIFT_ROUTE,
                    name: NEW_LIFT_ROUTE,
                    component: CreateLift
                },
                {
                    path: EDIT_LIFT_ROUTE,
                    name: EDIT_LIFT_ROUTE,
                    component: EditLift
                }
            ]
        },
        {
            path: LOGIN_ROUTE,
            name: LOGIN_ROUTE,
            component: Login
        },
        {
            path: CREATE_ROUTE,
            name: CREATE_ROUTE,
            component: Create
        },
        {
            path: '*',
            redirect: '/'
        }
    ]
})

router.beforeEach((to, from, next) => {
    const authRequired = to.matched.some(route => route.meta.auth)
    let authed = Store.state.auth.authenticated
    if (!authed) {
        checkAndSetAuthenticated()
        authed = Store.state.auth.authenticated
    }
    authRequired && !authed ? next(LOGIN_ROUTE) : next()
})

export default router
