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
Vue.component('user-roles-all', require('./components/permissions/UserRoles.vue').default);

Vue.mixin({
    methods: {
        hydrate(entities, shouldCheck) {
            let results = [];

            entities.forEach(entity => {
                let checkbox = {
                    id: entity.id,
                    name: entity.name,
                    checked: shouldCheck
                }
                results.push(checkbox);
            });

            return results;
        },
        showError(error) {
            if (! error || this.errorMessage === undefined) {

                return;
            }

            if (error.response.data.error) {
                this.errorMessage = 'Error: ' + error.response.data.error;

                return;
            }

            this.handleUnauthenticated(error.response.data);
        },
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
