require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import Home from './pages/PageHome.vue';

import AdvanceSearch from './pages/PageAdvanceSearch.vue';

import PageShow from './pages/PageShow';

const routes = [
    {
        path: '/search',
        name: 'AdvanceSearch',
        component: AdvanceSearch,
        props: true,
    },

    {
        path: '/',
        name: 'home',
        component: Home,
    },

    {
        path: '/profile/:id',
        name: 'profile',
        component: PageShow,
        props: true,
    },
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
