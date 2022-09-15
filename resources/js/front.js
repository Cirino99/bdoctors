require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import Home from './pages/PageHome.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    }
];

const router = new VueRouter({
    routes,
    mode: 'history',
});

Vue.use(VueRouter);

const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
});
