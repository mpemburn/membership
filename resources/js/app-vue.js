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
import VueTailwindModal from "vue-tailwind-modal"
Vue.component("VueTailwindModal", VueTailwindModal)

Vue.component('edit-button', require('./components/buttons/EditButton.vue').default);
Vue.component('delete-button', require('./components/buttons/DeleteButton.vue').default);
Vue.component('members-all', require('./components/members/AllMembers.vue').default);

Vue.mixin({
    methods: {
        handleUnauthenticated(responseData) {
            if (responseData.message && responseData.message === 'Unauthenticated.') {
                this.errorMessage = 'Error: Your session has timed out...reloading.';
                setTimeout(() => {
                    location.reload();
                }, 3000);
            }
        }
    }
});

const app = new Vue({
    el: '#app',
    components: {},
});
