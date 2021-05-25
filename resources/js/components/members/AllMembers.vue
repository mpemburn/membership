<template>
    <div class="">
        <table id="members-table" class="stripe">
            <thead>
                <tr>
                    <th v-for="header in headers">{{ header.text }}</th>
                </tr>
            </thead>
            <tr>
                <th v-for="header in headers" :data-id="header.value" style="background-color: white">{{ header.filter }}</th>
            </tr>
            <tbody>
                <tr v-for="member in members">
                    <td>{{ member.name }}</td>
                    <td>{{ member.addrress }}</td>
                    <td>{{ member.city }}</td>
                    <td>{{ member.state }}</td>
                    <td>{{ member.zip }}</td>
                    <td>{{ member.phone }}</td>
                    <td>{{ member.email }}</td>
                    <td>{{ member.coven }}</td>
                    <td>{{ member.degree }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<style scoped></style>
<script>
import axios from "axios";

export default {
    name: "AllMembers",
    data() {
        return {
            members: [],
            headers: [
                {text: "Name", value: "name"},
                {text: "Address", value: "address"},
                {text: "City", value: "city"},
                {text: "State", value: "state"},
                {text: "Zip", value: "zip"},
                {text: "Phone", value: "phone"},
                {text: "Email", value: "email"},
                {text: "Coven", value: "coven", filter: this.covenFilter()},
                {text: "Degree", value: "degree"},
            ],
            covens: []
        };
    },
    watch: {
        options: {
            handler() {
                this.readDataFromAPI();
            },
        },
        deep: true,
    },
    methods: {
        getAddressPart(address, part) {
            return address[0]? address[0][part] : '';
        },
        getPhone(phone) {
            return phone[0] ? phone[0].number : '';
        },
        getEmail(email) {
            return email[0] ? email[0].email : '';
        },
        getCoven(coven) {
            return coven[0] ? coven[0].abbreviation : '';
        },
        getDegree(degree) {
            return degree[0] ? degree[0].degree : '';
        },
        covenFilter() {
            let header = $('[data-id="coven"]');
            console.log(header);
            return '';
        },
        readDataFromAPI() {
            axios.get('/api/members')
                .then((response) => {
                    if (! response.data.members) {
                        return;
                    }
                    // this.covens = response.data.covens;
                    // console.log(response.data.degrees);
                    // console.log(this.members);
                    response.data.members.forEach(member => {
                        this.members.push({
                                name: member.last_name + ', ' + member.first_name,
                                addrress: this.getAddressPart(member.primary_address, 'address_1'),
                                city: this.getAddressPart(member.primary_address, 'city'),
                                state: this.getAddressPart(member.primary_address, 'state'),
                                zip: this.getAddressPart(member.primary_address, 'zip'),
                                phone: this.getPhone(member.primary_phone),
                                email: this.getEmail(member.primary_email),
                                coven: this.getCoven(member.current_coven),
                                degree: this.getDegree(member.current_degree)
                            }
                        );
                    });
                    console.log(this.members);

                });
        },
        initDataTable() {
            this.dataTable = $('#members-table').DataTable({
                pageLength: 100,
                lengthMenu: [10, 25, 50, 75, 100],
            });
        },
    },
    updated() {
        this.initDataTable()
    },
    mounted() {
        this.readDataFromAPI();
    },
};

</script>
