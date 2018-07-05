import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import { sync } from 'vuex-router-sync';
import Store from './store/store';
import Router from './routes';
import App from './components/App';
import _ from './api/api';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.use(BootstrapVue);


sync(Store, Router);

const app = new Vue({
    el: '#app',
    components: { App },
    router: Router,
    store: Store
});