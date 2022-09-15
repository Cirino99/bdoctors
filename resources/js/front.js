require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';

import PageShow from './pages/PageShow';

const routes = [
    {
        path: '/profile',
        name: 'profile',
        component: PageShow
    },
];

const router = new VueRouter({
    routes,
    mode: 'history',
});

const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
});
