<template>
    <div class="">
        <table id="roles-table" class="stripe">
            <thead>
            <tr>
                <th v-for="header in headers" :class="header.class">{{ header.text }}</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="role in roles">
                    <td>{{ role.name }}</td>
                    <td>
                        <ul v-for="permission in role.permissions">
                            <li>{{ permission.name }}</li>
                        </ul>
                    </td>
                    <td><component :is="editButton" v-bind="{ editId: role.id }">Edit</component></td>
                    <td><component :is="deleteButton" v-bind="{ deleteId: role.id }">Delete</component></td>
                </tr>
            </tbody>
        </table>
        <section>
            <component v-if="showModal" :is="modal" v-bind="{ title: 'Roles', width: 'full' }">
                <p class="text-gray-800">
                    Role and its Permissions go here.
                </p>

                <div class="text-right mt-4">
                    <button @click="showModal = false" class="modal-close ml-3 rounded px-3 py-1 bg-gray-300 hover:bg-gray-200 focus:shadow-outline focus:outline-none">Cancel</button>
                    <button class="rounded px-3 py-1 bg-blue-700 hover:bg-blue-500 disabled:opacity-50 text-white focus:shadow-outline focus:outline-none">Update</button>
                </div>
            </component>
        </section>
    </div>
</template>

<style scoped></style>
<script>
import axios from "axios";
import EditButton from '../buttons/EditButton.vue';
import DeleteButton from '../buttons/DeleteButton.vue';
import Modal from '../Modal.vue';

export default {
    name: "Roles",
    data() {
        return {
            showModal: false,
            roles: [],
            headers: [
                {text: "Role Name", class: "5/12"},
                {text: "Permissions", class: "5/12"},
                {text: "", class: "w-1/12"},
                {text: "", class: "w-1/12"},
            ],
            editButton: 'EditButton',
            deleteButton: 'DeleteButton',
            modal: 'Modal',
        };
    },
    methods: {
        readDataFromAPI() {
            axios
                .get("https://membership.test/api/roles")
                .then((response) => {
                    if (response.data.roles  === null) {
                        return;
                    }
                    response.data.roles.forEach(role => {
                        this.roles.push({
                            'id': role.id,
                            'name': role.name,
                            'permissions': role.permissions
                        });
                    });
                });
        },
    },
    components: {
        EditButton,
        DeleteButton,
        Modal
    },
    updated() {
        if (this.dataTable === 'undefined') {
            this.dataTable = $('#roles-table').DataTable({});
        }
    },
    mounted() {
        this.readDataFromAPI();
    },
};

</script>
