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
        },
        readDataFromAPI() {
            axios
                .get("https://membership.test/api/members")
                .then((response) => {
                    this.members = response.data.members ? response.data.members: null;
                    if (this.members === null) {
                        return;
                    }
                    this.covens = response.data.covens;
                    // console.log(response.data.degrees);
                    // console.log(this.members);
                    this.members.forEach(member => {
                        this.dataTable.row.add(
                            [
                                member.last_name + ', ' + member.first_name,
                                this.getAddressPart(member.primary_address, 'address_1'),
                                this.getAddressPart(member.primary_address, 'city'),
                                this.getAddressPart(member.primary_address, 'state'),
                                this.getAddressPart(member.primary_address, 'zip'),
                                this.getPhone(member.primary_phone),
                                this.getEmail(member.primary_email),
                                this.getCoven(member.current_coven),
                                this.getDegree(member.current_degree)
                            ]
                        ).draw(false);
                    });

                });
        },
    },
    mounted() {
        this.dataTable = $('#members-table').DataTable({});
        this.readDataFromAPI();
    },
};
</script>
