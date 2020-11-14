import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store/index';

Vue.use(VueRouter)

import App from './views/App';
import Home from './views/Home';
import NotFound from './views/NotFound';

const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '*',
            name: '404',
            component: NotFound
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});