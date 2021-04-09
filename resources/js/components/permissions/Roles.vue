<template>
    <div class="">
        <button @click="addRoleDialog"
                class="rounded px-3 py-1 bg-blue-700 hover:bg-blue-500 disabled:opacity-50 text-white focus:shadow-outline focus:outline-none">
            Add Role
        </button>

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
                    <component :is="deleteButton" v-bind="{ deleteId: role.id }"
                                @messageFromDeleteButton="deleteButtonMessageRecieved">Delete</component>
                </td>
            </tr>
            </tbody>
        </table>
        <section>
            <component v-if="showModal" :is="modal" v-bind="{ title: modalTitle, width: 'full' }" @closeModal="showModal = false">
                <form v-on:submit="submitForm">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <input type="hidden" name="role_id" :value="roleId"/>
                        <div class="form-group font-bold">
                            <div>Role Name:</div>
                            <input type="text" name="role_name" v-model="roleName"/>
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
                                    <li v-for="permission in permissions">
                                        <input
                                            type="checkbox"
                                            name="role_permissions"
                                            v-model="permission.checked"
                                            :value="permission.id"
                                        >
                                        {{ permission.name }}
                                    </li>
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
                    <button v-if="modalContext === 'Add'" @click="createRole"
                            class="rounded px-3 py-1 bg-blue-700 hover:bg-blue-500 disabled:opacity-50 text-white focus:shadow-outline focus:outline-none">
                        Submit
                    </button>
                    <button v-if="modalContext === 'Edit'" @click="updateRole"
                            class="rounded px-3 py-1 bg-blue-700 hover:bg-blue-500 disabled:opacity-50 text-white focus:shadow-outline focus:outline-none">
                        Update
                    </button>
                </div>
            </component>
        </section>
        <section>
            <component v-if="showConfirm" :is="modal" v-bind="{ title: 'Delete', width: 'full' }" @closeModal="showConfirm = false">
                <div>
                    {{ confirmMessage }}
                </div>
                <div class="text-center mt-4">
                    <button @click="showConfirm = false"
                            class="modal-close ml-3 rounded px-3 py-1 bg-gray-300 hover:bg-gray-200 focus:shadow-outline focus:outline-none">
                        Cancel
                    </button>
                    <button @click="deleteRole"
                            class="rounded px-3 py-1 bg-red-700 hover:bg-red-500 text-white focus:shadow-outline focus:outline-none">
                        Okay
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
            showConfirm: false,
            modalContext: null,
            modalTitle: null,
            confirmMessage: null,
            roleId: null,
            currentRoleId: null,
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
        readRolesFromAPI() {
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
        addRoleDialog() {
            axios.get('https://membership.test/api/permissions')
                .then(response => {
                    this.roleName = null;
                    this.permissions = [];
                    this.hydrate(response.data.permissions, false);
                    this.modalContext = 'Add';
                    this.modalTitle = 'Add New Role';
                    this.showModal = true;
                });
        },
        editButtonMessageRecieved(roleId) {
            this.roleId = roleId;
            this.roleName = null;
            this.permissions = [];
            axios.get('https://membership.test/api/roles/permissions?id=' + roleId)
                .then(response => {
                    this.populateEditorCheckboxes(response);
                    this.modalContext = 'Edit';
                    this.modalTitle = 'Edit Role';
                    this.showModal = true;
                });
        },
        deleteButtonMessageRecieved(roleId) {
            let role = this.getRoleById(roleId);
            if (role !== null) {
                this.confirmMessage = 'Do you really want to delete "' + role.name + '"?';
                this.currentRoleId = roleId;
                this.showConfirm = true;
            }
        },
        populateEditorCheckboxes(response) {
            let role = response.data.role;

            this.roleId = role.id;
            this.roleName = role.name;
            this.hydrate(response.data.role.permissions, true);
            this.hydrate(response.data.diff, false);
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
            axios.post('https://membership.test/api/roles/create', {
                name: this.roleName,
                role_permissions: this.permissions
            }).then(response => {
                this.showModal = false;
                // TODO: Figure out how to reload and refresh DataTables
                // https://stackoverflow.com/questions/51436441/how-to-refresh-datatables-with-new-data-in-vuejs
                document.location.reload();
            });
        },
        updateRole() {
            axios.put('https://membership.test/api/roles/update', {
                id: this.roleId,
                name: this.roleName,
                role_permissions: this.permissions
            }).then(response => {
                if (response.data.success) {
                    this.roles.forEach(role => {
                        if (role.id === response.data.roleId) {
                            role.permissions = response.data.permissions;
                        }
                    });

                    this.showModal = false;
                }
            });
        },
        deleteRole() {
            axios.delete('https://membership.test/api/roles/delete?id=' + this.currentRoleId)
                .then(response => {
                    this.showConfirm = false;
                    document.location.reload();
                });
        },
        getRoleById(roleId) {
            let found = null;

            this.roles.forEach(role => {
                if (role.id === roleId) {
                    found = role;
                }
            });

            return found;
        }
    },
    components: {
        EditButton,
        DeleteButton,
        Modal
    },
    updated() {
        if (this.dataTable === undefined) {
            this.dataTable = $('#roles-table').DataTable({});
        }
    },
    mounted() {
        this.readRolesFromAPI();
    },
};

</script>
