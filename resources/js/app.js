import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store/index';
import AsyncComputed from 'vue-async-computed'

Vue.use(VueRouter)
Vue.use(AsyncComputed)

import App from './views/App';
import Home from './views/Home';
import About from './views/About';
import EmailVerify from './views/EmailVerify';
import NotFound from './views/NotFound';
import RegisterModal from './components/RegisterModal';

const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/',
            name: 'register',
            component: RegisterModal
        },
        {
            path: '/verify',
            name: 'verify',
            component: EmailVerify,
            props: (route) => ({ verifyQuery: route.query.verifyLink })
        },
        {
            path: '/about',
            name: 'about',
            component: About
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
    store,
});