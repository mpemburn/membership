<template>
    <div>
        <h3 class="text-center">All Members</h3><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="member in members" :key="member.id">
                <td>{{ member.id }}</td>
                <td>{{ member.first_name }}</td>
                <td>{{ member.last_name }}</td>
                <td>{{ member.phone_number[0].number }} ({{ member.phone_number[0].type }})</td>
                <td>{{ member.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: member.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteMember(member.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            members: []
        }
    },
    created() {
        this.axios
            .get('https://membership.test/api/members')
            .then(response => {
                this.members = response.data.members;
            });
    },
    methods: {
        deleteMember(id) {
            this.axios
                .delete(`https://membership.test/api/member/delete/${id}`)
                .then(response => {
                    let i = this.members.map(item => item.id).indexOf(id); // find index of your object
                    this.members.splice(i, 1)
                });
        }
    }
}
</script>
