import Comparator from "./comparator";
import RequestAjax from "./request-ajax";
import Modal from './modal';
import Confirmation from './confirmation';
import DatatablesManager from './datatables-manager';
import PermissionsManager from './permissions-manager';
import UserRolesManager from './user-roles-manager';

import App from './App.vue';
import Vue from 'vue/dist/vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';

window.Vue = require('vue');

window.$ = require('jquery');
require('./bootstrap');
require('alpinejs');
require('datatables.net')
require('datatables.net-dt')

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});

let ajax = new RequestAjax();
let comparator = new Comparator();
let modal = new Modal();
let confirmation = new Confirmation();
let dtManager = new DatatablesManager();

new PermissionsManager({
    comparator: comparator,
    ajax: ajax,
    modal: modal,
    confirmation: confirmation,
    dtManager: dtManager
});

new UserRolesManager({
    comparator: comparator,
    ajax: ajax,
    modal: modal,
    confirmation: confirmation,
    dtManager: dtManager
});


