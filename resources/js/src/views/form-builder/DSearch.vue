<template>
    <vx-card ref="filterCard" title="Filters" class="user-list-filters mb-8" actionButtons @refresh="resetColFilters"
        @remove="resetColFilters">
        <div class="vx-row">
            <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
                <label class="text-sm opacity-75">Role</label>
                <v-select :options="roleOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="roleFilter"
                    class="mb-4 md:mb-0" />
            </div>
            <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
                <label class="text-sm opacity-75">Status</label>
                <v-select :options="statusOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="statusFilter"
                    class="mb-4 md:mb-0" />
            </div>
            <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
                <label class="text-sm opacity-75">Verified</label>
                <v-select :options="isVerifiedOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'"
                    v-model="isVerifiedFilter" class="mb-4 sm:mb-0" />
            </div>
            <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
                <label class="text-sm opacity-75">Department</label>
                <v-select :options="departmentOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'"
                    v-model="departmentFilter" />
            </div>
        </div>
    </vx-card>
</template>

<script>
import { AgGridVue } from "ag-grid-vue"
import '@sass/vuexy/extraComponents/agGridStyleOverride.scss'
import vSelect from 'vue-select'

// Store Module
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

// Cell Renderer
// import CellRendererLink from "./cell-renderer/CellRendererLink.vue"
// import CellRendererStatus from "./cell-renderer/CellRendererStatus.vue"
// import CellRendererVerified from "./cell-renderer/CellRendererVerified.vue"
// import CellRendererActions from "./cell-renderer/CellRendererActions.vue"


export default {
    components: {
        AgGridVue,
        vSelect,

    
    },
    data() {
        return {
            usersLiked: [
                { name: 'Trina Lynes', img: require("@assets/images/portrait/small/avatar-s-1.jpg") },
                { name: 'Lilian Nenez', img: require("@assets/images/portrait/small/avatar-s-2.jpg") },
                { name: 'Alberto Glotzbach', img: require("@assets/images/portrait/small/avatar-s-3.jpg") },
                { name: 'George Nordick', img: require("@assets/images/portrait/small/avatar-s-4.jpg") },
                { name: 'Vennie Mostowy', img: require("@assets/images/portrait/small/avatar-s-5.jpg") },
                { name: 'George Nordick', img: require("@assets/images/portrait/small/avatar-s-4.jpg") },
                { name: 'Vennie Mostowy', img: require("@assets/images/portrait/small/avatar-s-5.jpg") },
            ],
            // Filter Options
            roleFilter: { label: 'All', value: 'all' },
            roleOptions: [
                { label: 'All', value: 'all' },
                { label: 'Admin', value: 'admin' },
                { label: 'User', value: 'user' },
                { label: 'Staff', value: 'staff' },
            ],

            statusFilter: { label: 'All', value: 'all' },
            statusOptions: [
                { label: 'All', value: 'all' },
                { label: 'Active', value: 'active' },
                { label: 'Deactivated', value: 'deactivated' },
                { label: 'Blocked', value: 'blocked' },
            ],

            isVerifiedFilter: { label: 'All', value: 'all' },
            isVerifiedOptions: [
                { label: 'All', value: 'all' },
                { label: 'Yes', value: 'yes' },
                { label: 'No', value: 'no' },
            ],

            departmentFilter: { label: 'All', value: 'all' },
            departmentOptions: [
                { label: 'All', value: 'all' },
                { label: 'Sales', value: 'sales' },
                { label: 'Development', value: 'development' },
                { label: 'Management', value: 'management' },
            ],

            searchQuery: "",

            // AgGrid
            gridApi: null,
            gridOptions: {},
            defaultColDef: {
                sortable: true,
                resizable: true,
                suppressMenu: true
            },
            columnDefs: [
                {
                    headerName: 'ID',
                    field: 'id',
                    width: 125,
                    filter: true,
                    checkboxSelection: true,
                    headerCheckboxSelectionFilteredOnly: true,
                    headerCheckboxSelection: true,
                },
                {
                    headerName: 'Username',
                    field: 'username',
                    filter: true,
                    width: 210,
                    cellRendererFramework: 'CellRendererLink'
                },
                {
                    headerName: 'Email',
                    field: 'email',
                    filter: true,
                    width: 225,
                },
                {
                    headerName: 'Name',
                    field: 'name',
                    filter: true,
                    width: 200,
                },
                {
                    headerName: 'Country',
                    field: 'country',
                    filter: true,
                    width: 150,
                },
                {
                    headerName: 'Role',
                    field: 'role',
                    filter: true,
                    width: 150,
                },
                {
                    headerName: 'Status',
                    field: 'status',
                    filter: true,
                    width: 150,
                    cellRendererFramework: 'CellRendererStatus'
                },
                {
                    headerName: 'Verified',
                    field: 'is_verified',
                    filter: true,
                    width: 125,
                    cellRendererFramework: 'CellRendererVerified',
                    cellClass: "text-center"
                },
                {
                    headerName: 'Department',
                    field: 'department',
                    filter: true,
                    width: 150,
                },
                {
                    headerName: 'Actions',
                    field: 'transactions',
                    width: 150,
                    cellRendererFramework: 'CellRendererActions',
                },
            ],

            // Cell Renderer Components
            components: {
               
            }
        }
    },
    watch: {
        roleFilter(obj) {
            this.setColumnFilter("role", obj.value)
        },
        statusFilter(obj) {
            this.setColumnFilter("status", obj.value)
        },
        isVerifiedFilter(obj) {
            let val = obj.value === "all" ? "all" : obj.value == "yes" ? "true" : "false"
            this.setColumnFilter("is_verified", val)
        },
        departmentFilter(obj) {
            this.setColumnFilter("department", obj.value)
        },
    },
    computed: {
        usersData() {
            return this.$store.state.userManagement.users
        },
        paginationPageSize() {
            if (this.gridApi) return this.gridApi.paginationGetPageSize()
            else return 10
        },
        totalPages() {
            if (this.gridApi) return this.gridApi.paginationGetTotalPages()
            else return 0
        },
        currentPage: {
            get() {
                if (this.gridApi) return this.gridApi.paginationGetCurrentPage() + 1
                else return 1
            },
            set(val) {
                this.gridApi.paginationGoToPage(val - 1)
            }
        }
    },
    methods: {
        setColumnFilter(column, val) {
            const filter = this.gridApi.getFilterInstance(column)
            let modelObj = null

            if (val !== "all") {
                modelObj = { type: "equals", filter: val }
            }

            filter.setModel(modelObj)
            this.gridApi.onFilterChanged()
        },
        resetColFilters() {
            // Reset Grid Filter
            this.gridApi.setFilterModel(null)
            this.gridApi.onFilterChanged()

            // Reset Filter Options
            this.roleFilter = this.statusFilter = this.isVerifiedFilter = this.departmentFilter = { label: 'All', value: 'all' }

            this.$refs.filterCard.removeRefreshAnimation()
        },
        updateSearchQuery(val) {
            this.gridApi.setQuickFilter(val)
        }
    },
    mounted() {
        this.gridApi = this.gridOptions.api

        /* =================================================================
          NOTE:
          Header is not aligned properly in RTL version of agGrid table.
          However, we given fix to this issue. If you want more robust solution please contact them at gitHub
        ================================================================= */
        if (this.$vs.rtl) {
            const header = this.$refs.agGridTable.$el.querySelector(".ag-header-container")
            header.style.left = "-" + String(Number(header.style.transform.slice(11, -3)) + 9) + "px"
        }
    },
    created() {
        if (!moduleUserManagement.isRegistered) {
            this.$store.registerModule('userManagement', moduleUserManagement)
            moduleUserManagement.isRegistered = true
        }
        this.$store.dispatch("userManagement/fetchUsers").catch(err => { console.error(err) })
    }
}

</script>

<style lang="scss">
#page-user-list {
    .user-list-filters {
        .vs__actions {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-58%);
        }
    }
}
</style>
