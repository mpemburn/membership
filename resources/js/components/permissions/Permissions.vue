<template>
    <div class="">
        <button @click="addPermissionDialog"
                class="rounded px-3 py-1 m-2 bg-blue-700 hover:bg-blue-500 disabled:opacity-50 text-white focus:shadow-outline focus:outline-none">
            Add Permission
        </button>

        <div v-if="errorMessage && ! showModal" class="m-2 text-danger">{{ errorMessage }}</div>

        <table id="permissions-table" class="stripe">
            <thead>
            <tr>
                <th v-for="header in headers" :class="header.class">{{ header.text }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="permission in permissions">
                <td>{{ permission.name }}</td>
                <td>
                    <component :is="editButton" v-bind="{ editId: permission.id }"
                               @messageFromEditButton="editButtonMessageRecieved">Edit
                    </component>
                </td>
                <td>
                    <component :is="deleteButton" v-bind="{ deleteId: permission.id }"
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
                        <input type="hidden" name="permission_id" :value="permissionId"/>
                        <div class="form-group font-bold">
                            <div>Permission Name:</div>
                            <input
                                class="w-80"
                                type="text"
                                name="permission_name"
                                v-model="permissionName"
                                placeholder="Enter a permission name"
                            />
                            <div id="name_caution" class="w-2/3 text-red-600 font-normal hidden">
                                <b>CAUTION:</b> Changing the <b>Permission Name</b> may affect existing permissions.
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
                    <button v-if="modalContext === 'Add'" @click="createPermission"
                            class="rounded px-3 py-1 bg-blue-700 hover:bg-blue-500 disabled:opacity-50 text-white focus:shadow-outline focus:outline-none">
                        Submit
                    </button>
                    <button v-if="modalContext === 'Edit'" @click="updatePermission"
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
                    <button @click="deletePermission"
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
import Modal from '../Modal.vue';

export default {
    name: "Permissions",
    data() {
        return {
            dataTables: null,
            showModal: false,
            showConfirm: false,
            showConfirmx: false,
            modalContext: null,
            modalTitle: null,
            confirmMessage: null,
            errorMessage: null,
            permissionId: null,
            currentPermissionId: null,
            permissionName: null,
            permissions: [],
            headers: [
                {text: "Permission Name", class: "w-10/12"},
                {text: "", class: "w-1/12"},
                {text: "", class: "w-1/12"},
            ],
            editButton: 'EditButton',
            deleteButton: 'DeleteButton',
            modal: 'Modal',
        };
    },
    watch: {
        permissions(val) {
            this.refreshTable();
        }
    },
    methods: {
        readPermissionsFromAPI() {
            this.permissions = [];
            axios
                .get("/api/permissions")
                .then((response) => {
                    if (response.data.permissions === null) {
                        return;
                    }
                    response.data.permissions.forEach(permission => {
                        this.permissions.push({
                            'id': permission.id,
                            'name': permission.name
                        });
                    });
                });
        },
        addPermissionDialog() {
            this.permissionId = null;
            this.permissionName = null;
            this.modalContext = 'Add';
            this.modalTitle = 'Add New Permission';
            this.showModal = true;
        },
        editButtonMessageRecieved(permissionId) {
            this.permissionId = permissionId;
            this.permissionName = null;
            axios.get('/api/permissions/' + permissionId)
                .then(response => {
                    this.modalContext = 'Edit';
                    this.modalTitle = 'Edit Permission';
                    this.permissionName = response.data.permission.name;
                    this.showModal = true;
                }).catch(error => {
                    this.showError(error);
            });
        },
        deleteButtonMessageRecieved(permissionId) {
            let permission = this.getPermissionById(permissionId);
            if (permission !== null) {
                this.confirmMessage = 'Do you really want to delete "' + permission.name + '"?';
                this.currentPermissionId = permissionId;
                this.showConfirm = true;
            }
        },
        submitForm() {
            if (this.permissionId === null) {
                this.createPermission()
            } else {
                this.updatePermission()
            }

        },
        closeModal() {
            this.showModal = false;
            this.showConfirm = false;
            this.errorMessage = null;
        },
        createPermission() {
            axios.post('/api/permissions/create', {
                name: this.permissionName,
                permission_permissions: this.permissions
            }).then(response => {
                this.showModal = false;
                this.readPermissionsFromAPI();
            }).catch(error => {
                this.showError(error);
            });
        },
        updatePermission() {
            axios.put('/api/permissions/update', {
                id: this.permissionId,
                name: this.permissionName,
                permission_permissions: this.permissions
            }).then(response => {
                if (response.data.success) {
                    this.permissions.forEach(permission => {
                        if (permission.id === response.data.permissionId) {
                            permission.permissions = response.data.permissions;
                        }
                    });
                    this.showModal = false;
                }
            }).catch(error => {
                this.showError(error);
            });
        },
        deletePermission() {
            axios.delete('/api/permissions/delete?id=' + this.currentPermissionId)
                .then(response => {
                    this.showConfirm = false;
                    this.readPermissionsFromAPI();
                }).catch(error => {
                    this.showError(error);
            });
        },
        getPermissionById(permissionId) {
            let found = null;

            this.permissions.forEach(permission => {
                if (permission.id === permissionId) {
                    found = permission;
                }
            });

            return found;
        },
        initDataTable() {
            this.dataTable = $('#permissions-table').DataTable({});
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
        Modal
    },
    updated() {
        if (this.dataTable === undefined) {
            this.initDataTable();
        }
    },
    mounted() {
        this.readPermissionsFromAPI();
    },
};

</script>
