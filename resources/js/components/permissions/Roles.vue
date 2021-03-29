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
            roles: [],
            headers: [
                {text: "Role Name", class: "5/12"},
                {text: "Permissions", class: "5/12"},
                {text: "", class: "w-1/12"},
                {text: "", class: "w-1/12"},
            ],
            editButton: 'EditButton',
            deleteButton: 'DeleteButton'
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
    },
    updated() {
        this.dataTable = $('#roles-table').DataTable({});
    },
    mounted() {
        this.readDataFromAPI();
    },
};

</script>
