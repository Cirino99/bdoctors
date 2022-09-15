require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';

const routes = [];

const router = new VueRouter({
    routes,
    mode: 'history',
});

const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
});
