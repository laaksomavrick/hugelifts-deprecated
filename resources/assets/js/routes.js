import Vue from 'vue'
import Router from 'vue-router'

import Home from './views/Home'
import Login from './views/Login'
import Create from './views/Create'
import CreateLift from './views/CreateLift'
import EditLift from './views/EditLift'
import Schedule from './views/Schedule'
import Routine from './views/Routine'
import Lifts from './views/Lifts'

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
    EDIT_LIFT_ROUTE
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
    console.log(authRequired)
    let authed = Store.state.auth.authenticated
    if (!authed && authRequired) {
        console.log('here')
        checkAndSetAuthenticated()
        authed = Store.state.auth.authenticated
    }
    authRequired && !authed ? next(LOGIN_ROUTE) : next()
})

export default router
