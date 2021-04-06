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
                <td>
                    <component :is="editButton" v-bind="{ editId: role.id }"
                               @messageFromEditButton="editButtonMessageRecieved">Edit
                    </component>
                </td>
                <td>
                    <component :is="deleteButton" v-bind="{ deleteId: role.id }">Delete</component>
                </td>
            </tr>
            </tbody>
        </table>
        <section>
            <component v-if="showModal" :is="modal" v-bind="{ title: 'Roles', width: 'full' }">
                <form v-on:submit="submitForm">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <input type="hidden" name="role_id" :value="roleId"/>
                        <div class="form-group font-bold">
                            <div>Role Name:</div>
                            <input type="text" name="role_name" :value="roleName"/>
                            <div id="name_protected" class="w-2/3 text-gray-600 font-normal hidden">
                                <b>NOTICE:</b> This <b>Role Name</b> is flagged as protected and cannot be changed.
                            </div>
                            <div id="name_caution" class="w-2/3 text-red-600 font-normal hidden">
                                <b>CAUTION:</b> Changing the <b>Role Name</b> may affect existing permissions.
                            </div>
                        </div>
                        <div class="form-group font-bold" id="permissions_for_role">
                            Permissions:
                            <div class="border-solid border-gray-300 border-2 overflow-scroll">
                                <ul id="role_permissions" class="p-4">
                                    <div v-for="permission in permissions">
                                        <input
                                            type="checkbox"
                                            name="role_permissions"
                                            v-model="permission.checked"
                                            :value="permission.id"
                                        >
                                        {{ permission.name }}
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="text-right mt-4">
                    <button @click="showModal = false"
                            class="modal-close ml-3 rounded px-3 py-1 bg-gray-300 hover:bg-gray-200 focus:shadow-outline focus:outline-none">
                        Cancel
                    </button>
                    <button @click="updateRole"
                            class="rounded px-3 py-1 bg-blue-700 hover:bg-blue-500 disabled:opacity-50 text-white focus:shadow-outline focus:outline-none">
                        Update
                    </button>
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
            roleId: null,
            roleName: null,
            roles: [],
            permissions: [],
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
                    if (response.data.roles === null) {
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
        editButtonMessageRecieved(roleId) {
            this.roleId = roleId;
            this.roleName = null;
            this.permissions = [];
            axios.get('https://membership.test/api/roles/permissions?id=' + roleId)
                .then(response => {
                    let role = response.data.role;

                    this.roleId = role.id;
                    this.roleName = role.name;
                    this.hydrate(response.data.role.permissions, true);
                    this.hydrate(response.data.diff, false);
                    this.showModal = true;
                });
        },
        hydrate(permissions, shouldCheck) {
            permissions.forEach(permission => {
                let checkbox = {
                    id: permission.id,
                    name: permission.name,
                    checked: shouldCheck
                }
                this.permissions.push(checkbox);
            });
        },
        submitForm() {
            if (this.roleId === null) {
                this.createRole()
            } else {
                this.updateRole()
            }

        },
        createRole() {

        },
        updateRole() {
            axios.put('https://membership.test/api/roles/update', {
                id: this.roleId,
                name: this.roleName,
                role_permission: this.permissions
            }).then(response => {
                this.showModal = false;
            });
        }
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
