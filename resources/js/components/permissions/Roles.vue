<template>
    <div class="">
        <button @click="addRoleDialog"
                class="rounded px-3 py-1 m-2 bg-blue-700 hover:bg-blue-500 disabled:opacity-50 text-white focus:shadow-outline focus:outline-none">
            Add Role
        </button>

        <div v-if="errorMessage && ! showModal" class="m-2 text-danger">{{ errorMessage }}</div>

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
                               @messageFromDeleteButton="deleteButtonMessageRecieved">Delete
                    </component>
                </td>
            </tr>
            </tbody>
        </table>
        <section>
            <vue-tailwind-modal
                :showing="showModal"
                @close="showModal = false"
                :showClose="true"
                :backgroundClose="true"
            >
                <div class="mb-1 text-xl font-bold">
                    {{ modalTitle }}
                </div>
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
                    <div v-if="errorMessage" class="text-danger">{{ errorMessage }}</div>
                    <button @click="closeModal()"
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
            </vue-tailwind-modal>
        </section>
        <section>
            <vue-tailwind-modal
                :showing="showConfirm"
                @close="showConfirm = false"
                :showClose="true"
                :backgroundClose="true"
            >
                <div>
                    {{ confirmMessage }}
                </div>
                <div class="text-center mt-4">
                    <div v-if="errorMessage" class="text-danger">{{ errorMessage }}</div>
                    <button @click="closeModal()"
                            class="modal-close ml-3 rounded px-3 py-1 bg-gray-300 hover:bg-gray-200 focus:shadow-outline focus:outline-none">
                        Cancel
                    </button>
                    <button @click="deleteRole"
                            class="rounded px-3 py-1 bg-red-700 hover:bg-red-500 text-white focus:shadow-outline focus:outline-none">
                        Okay
                    </button>
                </div>
            </vue-tailwind-modal>
        </section>
    </div>
</template>

<style scoped></style>
<script>
import axios from "axios";
import EditButton from '../buttons/EditButton.vue';
import DeleteButton from '../buttons/DeleteButton.vue';

export default {
    name: "Roles",
    data() {
        return {
            dataTables: null,
            showModal: false,
            showConfirm: false,
            modalContext: null,
            modalTitle: null,
            confirmMessage: null,
            errorMessage: null,
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
    watch: {
        roles(val) {
            this.refreshTable();
        }
    },
    methods: {
        readRolesFromAPI() {
            this.roles = [];
            axios
                .get("/api/roles")
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
            axios.get('/api/permissions')
                .then(response => {
                    this.roleName = null;
                    this.permissions = this.hydrate(response.data.permissions, false);
                    this.modalContext = 'Add';
                    this.modalTitle = 'Add New Role';
                    this.showModal = true;
                }).catch(error => {
                    this.showError(error);
            });
        },
        editButtonMessageRecieved(roleId) {
            this.roleId = roleId;
            this.roleName = null;
            this.permissions = [];
            axios.get('/api/roles/permissions?id=' + roleId)
                .then(response => {
                    this.populateEditorCheckboxes(response);
                    this.modalContext = 'Edit';
                    this.modalTitle = 'Edit ' + this.roleName + ' Role';
                    this.showModal = true;
                }).catch(error => {
                    this.showError(error);
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

            let permissions = this.hydrate(response.data.role_permissions, true);
            let diff = this.hydrate(response.data.diff, false);

            this.permissions = permissions.concat(diff);
        },
        submitForm() {
            if (this.roleId === null) {
                this.createRole()
            } else {
                this.updateRole()
            }

        },
        closeModal() {
            this.showModal = false;
            this.showConfirm = false;
            this.errorMessage = null;
        },
        createRole() {
            this.errorMessage = null;
            axios.post('/api/roles/create', {
                name: this.roleName,
                role_permissions: this.permissions
            }).then(response => {
                this.showModal = false;
                this.readRolesFromAPI();
            }).catch(error => {
                this.showError(error);
            });
        },
        updateRole() {
            axios.put('/api/roles/update', {
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
            }).catch(error => {
                this.showError(error);
            });
        },
        deleteRole() {
            axios.delete('/api/roles/delete?id=' + this.currentRoleId)
                .then(response => {
                    this.showConfirm = false;
                    this.readRolesFromAPI();
                }).catch(error => {
                    this.showError(error);
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
        },
        initDataTable() {
            this.dataTable = $('#roles-table').DataTable({});
        },
        refreshTable() {
            if (this.dataTable !== undefined) {
                this.dataTable.destroy();
                this.$nextTick(() => {
                    this.initDataTable();
                })
            }
        }
    },
    components: {
        EditButton,
        DeleteButton,
    },
    updated() {
        if (this.dataTable === undefined) {
            this.initDataTable();
        }
    },
    mounted() {
        this.readRolesFromAPI();
    },
};

</script>
