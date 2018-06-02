import Vue from 'vue'
import Router from 'vue-router'

import Home from './views/Home'
import Login from './views/Login'
import Create from './views/Create'

import RoutineSchedule from './components/RoutineSchedule'
import RoutineManager from './components/RoutineManager'
import LiftManager from './components/LiftManager'

import Store from'./store/store'

import { checkAndSetAuthenticated } from './utils/auth'
import { 
    ACTIVE_ROUTE, 
    ROUTINES_ROUTE, 
    LIFTS_ROUTE,
    HOME_ROUTE,
    LOGIN_ROUTE,
    CREATE_ROUTE
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
                    component: RoutineSchedule
                },
                {
                    path: ROUTINES_ROUTE,
                    name: ROUTINES_ROUTE,
                    component: RoutineManager
                },
                {
                    path: LIFTS_ROUTE,
                    name: LIFTS_ROUTE,
                    component: LiftManager
                },
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
    authRequired && !authed ? next('/login') : next()
})

export default router
