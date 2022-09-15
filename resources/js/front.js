require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';

import AdvanceSearch from './pages/PageAdvanceSearch.vue';

const routes = [
    {
        path: '/search',
        name: 'AdvanceSearch',
        component: AdvanceSearch,
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
