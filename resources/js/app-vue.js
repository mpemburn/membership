import Vue from 'vue/dist/vue';
import VueAxios from 'vue-axios';
import axios from 'axios';

window.Vue = require('vue');

Vue.use(VueAxios, axios);

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
window.csrftoken = token.content;

if (token) {
    window.axios.defaults.headers.common = {
        'X-CSRF-TOKEN': token.content,
        'X-Requested-With': 'XMLHttpRequest'
    };
}

Vue.component('edit-button', require('./components/buttons/EditButton.vue').default);
Vue.component('edit-button', require('./components/buttons/EditButton.vue').default);
Vue.component('delete-button', require('./components/buttons/DeleteButton.vue').default);
Vue.component('v-modal', require('./components/buttons/DeleteButton.vue').default);
Vue.component('members-all', require('./components/members/AllMembers.vue').default);
Vue.component('roles-all', require('./components/permissions/Roles.vue').default);
Vue.component('permissions-all', require('./components/permissions/Permissions.vue').default);

const app = new Vue({
    el: '#app',
    components: {},
});
