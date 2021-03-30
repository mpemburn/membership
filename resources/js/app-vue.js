import Vue from 'vue/dist/vue';
import VueAxios from 'vue-axios';
import axios from 'axios';


window.Vue = require('vue');

Vue.use(VueAxios, axios);

Vue.component('edit-button', require('./components/buttons/EditButton.vue').default);
Vue.component('edit-button', require('./components/buttons/EditButton.vue').default);
Vue.component('delete-button', require('./components/buttons/DeleteButton.vue').default);
Vue.component('v-modal', require('./components/buttons/DeleteButton.vue').default);
Vue.component('members-all', require('./components/members/AllMembers.vue').default);
Vue.component('roles-all', require('./components/permissions/Roles.vue').default);

const app = new Vue({
    el: '#app',
    components: {},
});
