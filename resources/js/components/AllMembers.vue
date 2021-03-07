<template>
    <div id="app">
        <h3 class="title">v-Datatable example</h3>
        <DataTable
            :header-fields="headerFields"
            :sort-field="sortField"
            :sort="sort"
            :data="data || []"
            :is-loading="isLoading"
            :css="datatableCss"
            not-found-msg="Items not found"
            @onUpdate="dtUpdateSort"
            trackBy="first_name"
        >
            <input
                slot="actions"
                slot-scope="props"
                type="button"
                class="btn btn-info"
                value="Edit"
                @click="dtEditClick(props);"
            >
            <Pagination
                slot="pagination"
                :page="currentPage"
                :total-items="totalItems"
                :items-per-page="itemsPerPage"
                :css="paginationCss"
                @onUpdate="changePage"
                @updateCurrentPage="updateCurrentPage"
            />
            <div class="items-per-page" slot="ItemsPerPage">
                <label>Items per page</label>
                <ItemsPerPageDropdown
                    :list-items-per-page="listItemsPerPage"
                    :items-per-page="itemsPerPage"
                    :css="itemsPerPageCss"
                    @onUpdate="updateItemsPerPage"
                />
            </div>
            <Spinner slot="spinner"/>
        </DataTable>
    </div>
</template>
<style>
#app {
    font-family: "Avenir", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}

#app .title {
    margin-bottom: 30px;
}

#app .items-per-page {
    height: 100%;
    display: flex;
    align-items: center;
    color: #337ab7;
}

#app .items-per-page label {
    margin: 0 15px;
}

/* Datatable CSS */
#v-datatable-light .header-item {
    cursor: pointer;
    color: #337ab7;
    transition: color 0.15s ease-in-out;
}

#v-datatable-light .header-item:hover {
    color: #ed9b19;
}

#v-datatable-light .header-item.no-sortable {
    cursor: default;
}
#v-datatable-light .header-item.no-sortable:hover {
    color: #337ab7;
}

#v-datatable-light .header-item .th-wrapper {
    display: flex;
    width: 100%;
    height: 100%;
    font-weight: bold;
}

#v-datatable-light .header-item .th-wrapper.checkboxes {
    justify-content: center;
}

#v-datatable-light .header-item .th-wrapper .arrows-wrapper {
    display: flex;
    flex-direction: column;
    margin-left: 10px;
    justify-content: space-between;
}

#v-datatable-light .header-item .th-wrapper .arrows-wrapper.centralized {
    justify-content: center;
}

#v-datatable-light .arrow {
    transition: color 0.15s ease-in-out;
    width: 0;
    height: 0;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
}

#v-datatable-light .arrow.up {
    border-bottom: 8px solid #337ab7;
}

#v-datatable-light .arrow.up:hover {
    border-bottom: 8px solid #ed9b19;
}

#v-datatable-light .arrow.down {
    border-top: 8px solid #337ab7;
}

#v-datatable-light .arrow.down:hover {
    border-top: 8px solid #ed9b19;
}

#v-datatable-light .footer {
    display: flex;
    justify-content: space-between;
    width: 500px;
}
/* End Datatable CSS */

/* Pagination CSS */
#v-datatable-light-pagination {
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin: 0;
    padding: 0;
    width: 300px;
    height: 30px;
}

#v-datatable-light-pagination .pagination-item {
    width: 30px;
    margin-right: 5px;
    font-size: 16px;
    transition: color 0.15s ease-in-out;
}

#v-datatable-light-pagination .pagination-item.selected {
    color: #ed9b19;
}

#v-datatable-light-pagination .pagination-item .page-btn {
    background-color: transparent;
    outline: none;
    border: none;
    color: #337ab7;
    transition: color 0.15s ease-in-out;
}

#v-datatable-light-pagination .pagination-item .page-btn:hover {
    color: #ed9b19;
}

#v-datatable-light-pagination .pagination-item .page-btn:disabled {
    cursor: not-allowed;
    box-shadow: none;
    opacity: 0.65;
}
/* END PAGINATION CSS */

/* ITEMS PER PAGE DROPDOWN CSS */
.item-per-page-dropdown {
    background-color: transparent;
    min-height: 30px;
    border: 1px solid #337ab7;
    border-radius: 5px;
    color: #337ab7;
}
.item-per-page-dropdown:hover {
    cursor: pointer;
}
/* END ITEMS PER PAGE DROPDOWN CSS */
</style>

<script>
import Spinner from "vue-simple-spinner";
import { DataTable, ItemsPerPageDropdown, Pagination } from "v-datatable-light";
import orderBy from "lodash.orderby";

const addZero = value => ("0" + value).slice(-2);

const formatDate = value => {
    if (value) {
        const dt = new Date(value);
        return `${addZero(dt.getDate())}/${addZero(
            dt.getMonth() + 1
        )}/${dt.getFullYear()}`;
    }
    return "";
};

export default {
    name: "app",
    components: {
        DataTable,
        ItemsPerPageDropdown,
        Pagination,
        Spinner
    },
    created() {
        this.axios
            .get('https://membership.test/api/members')
            .then(response => {
                this.loadData(response.data.members);
            });
    },
    data: function() {
        return {
            headerFields: [
                "__slot:checkboxes",
                {
                    name: "first_name",
                    label: "First Name",
                    sortable: true
                },
                {
                    name: "last_name",
                    label: "Last Name",
                    sortable: true
                },
                {
                    name: "primary_address",
                    label: "Address",
                    sortable: true,
                    format: this.getAddress
                },
                {
                    name: "date_of_birth",
                    label: "Date of Birth",
                    format: formatDate,
                    sortable: true
                },
                {
                    name: "current_coven",
                    label: "Coven",
                    sortable: true,
                    format: this.getCovenAbbrev
                },
                {
                    name: "primary_email",
                    label: "Email",
                    sortable: true,
                    format: this.getEmail
                },
                "__slot:actions"
            ],
            data: [],
            datatableCss: {
                table: "table table-bordered table-hover table-striped table-center",
                th: "header-item",
                thWrapper: "th-wrapper",
                thWrapperCheckboxes: "th-wrapper checkboxes",
                arrowsWrapper: "arrows-wrapper",
                arrowUp: "arrow up",
                arrowDown: "arrow down",
                footer: "footer"
            },
            paginationCss: {
                paginationItem: "pagination-item",
                moveFirstPage: "move-first-page",
                movePreviousPage: "move-previous-page",
                moveNextPage: "move-next-page",
                moveLastPage: "move-last-page",
                pageBtn: "page-btn"
            },
            itemsPerPageCss: {
                select: "item-per-page-dropdown"
            },
            isLoading: false,
            sort: "asc",
            sortField: "first_name",
            listItemsPerPage: [5, 10, 20, 50, 100],
            itemsPerPage: 10,
            currentPage: 1,
            totalItems: 16
        };
    },
    methods: {
        getAddress: value => {
            return value[0].address_1;
        },

        getCovenAbbrev: value => {
            return value[0] ? value[0].abbreviation : null;
        },

        getEmail: value => {
            return value[0].email;
        },

        dtEditClick: props => alert("Click props:" + JSON.stringify(props)),

        dtUpdateSort: function ({sortField, sort}) {
            const sortedData = orderBy(initialData, [sortField], [sort]);
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = this.currentPage * this.itemsPerPage;
            this.data = sortedData.slice(start, end);
            console.log("load data based on new sort", this.currentPage);
        },

        updateItemsPerPage: function (itemsPerPage) {
            this.itemsPerPage = itemsPerPage;
            if (itemsPerPage >= initialData.length) {
                this.data = initialData;
            } else {
                this.data = initialData.slice(0, itemsPerPage);
            }
            console.log("load data with new items per page number", itemsPerPage);
        },

        changePage: function (currentPage) {
            this.currentPage = currentPage;
            const start = (currentPage - 1) * this.itemsPerPage;
            const end = currentPage * this.itemsPerPage;
            this.data = initialData.slice(start, end);
            console.log("load data for the new page", currentPage);
        },

        updateCurrentPage: function (currentPage) {
            this.currentPage = currentPage;
            console.log("update current page without need to load data", currentPage);
        },

        loadData: function (data) {
            this.data = data;
        }
    }
};
</script>
