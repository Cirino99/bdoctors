require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import Home from './pages/PageHome.vue';

import AdvanceSearch from './pages/PageAdvanceSearch.vue';

import PageShow from './pages/PageShow';

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faStar } from '@fortawesome/free-solid-svg-icons'

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

/* add icons to the library */
library.add(faStar)

/* add font awesome icon component */
Vue.component('font-awesome-icon', FontAwesomeIcon)

const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
});
