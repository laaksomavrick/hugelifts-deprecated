import Vue from 'vue'

import { sync } from 'vuex-router-sync'

import Store from './store/store'
import Router from './routes'
import App from './views/App'

sync(Store, Router)

const app = new Vue({
    el: '#app',
    components: { App },
    router: Router,
    store: Store
})
