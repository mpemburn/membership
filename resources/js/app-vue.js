import Vue from 'vue/dist/vue';
import VueAxios from 'vue-axios';
import axios from 'axios';

window.Vue = require('vue');

Vue.use(VueAxios, axios);

Vue.component('members-all', require('./components/members/AllMembers.vue').default);

const app = new Vue({
    el: '#app',
    components: {},
});
