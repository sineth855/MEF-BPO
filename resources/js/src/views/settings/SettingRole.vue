<!-- =========================================================================================
  File Name: UserList.vue
  Description: User List page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>

  <div id="page-user-list pt-6">
    <div class="flex flex-wrap items-center justify-between">
        <vx-input-group class="mb-base mr-3">
          <vs-input :placeholder="$t('Search Area')" />

          <template slot="append">
            <div class="append-text btn-addon">
              <vs-button type="border" class="whitespace-no-wrap">{{$t("Search")}}</vs-button>
            </div>
          </template>
        </vx-input-group>
        <div class="flex items-center">
          
          <div class="vx-row mr-1">
            <div class="btn-add-new p-3 mr-2 rounded-sm cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-default">
              <feather-icon icon="FilterIcon" svgClasses="h-4 w-4" />
            </div>

            <div class="btn-add-new p-3 mr-2 rounded-sm cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-default">
              <feather-icon icon="FileIcon" svgClasses="h-4 w-4" />
            </div>

            <div class="btn-add-new p-3 mr-1 rounded-sm cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary">
              <vx-tooltip color="success" text="បង្កើតគោលបំណង">
              <!-- <vs-button color="success" type="border">Color success</vs-button> -->
                <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
                <span class="ml-2 text-base text-primary">{{$t("AddNew")}}</span>
              </vx-tooltip>
            </div>

          </div>

        </div>
      </div>
    <div class="vx-row mt-6">
      <!-- Grid -->
      <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
        <vx-card
            title="Administrator(Default)"
            title-color="#000000"
            card-background="default"
            content-color="#000000">
            <center><h5 class="pb-4" style="line-height: 30px;">Total 5 users</h5></center>

            <div class="flex justify-between">
              <div class="flex items-center">
                <!-- <div class="flex items-center"><feather-icon class="mr-2" icon="HeartIcon" svgClasses="h-5 w-5"></feather-icon> <span>{{ post.likes }}</span></div> -->
                <ul class="users-liked user-list ml-3 sm:ml-6">
                  <li v-for="(user, userIndex) in usersLiked" :key="userIndex">
                    <vx-tooltip :text="user.name" position="bottom">
                      <vs-avatar :src="user.img" size="30px" class="border-2 border-white border-solid -m-1"></vs-avatar>
                    </vx-tooltip>
                  </li>
                </ul>
                <!-- <small class="ml-2">+{{ post.likes - 5 }} more</small> -->
              </div>

              <div class="btn-add-new p-3 mr-2 rounded-sm cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary">
                <feather-icon icon="EditIcon" svgClasses="h-4 w-4" />
              </div>
              <!-- <div class="flex items-center"><feather-icon class="mr-2" icon="MessageSquareIcon" svgClasses="h-5 w-5"></feather-icon> <span>{{ post.comments }}</span></div> -->
            </div>
            
            <!-- <p class="mb-3​">
              <center><vs-button class="mt-4 mr-2 shadow-lg" type="border" color="#ffffff" gradient-color-secondary="#CE9FFC">{{$t("Download")}}</vs-button></center>
            </p> -->
        </vx-card>
      </div>
      <!-- Grid -->
      <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
        <vx-card
            title="Supervisor"
            title-color="#000000"
            card-background="default"
            content-color="#000000">
            <center><h5 class="pb-4" style="line-height: 30px;">Total 5 users</h5></center>

            <div class="flex justify-between">
              <div class="flex items-center">
                <!-- <div class="flex items-center"><feather-icon class="mr-2" icon="HeartIcon" svgClasses="h-5 w-5"></feather-icon> <span>{{ post.likes }}</span></div> -->
                <ul class="users-liked user-list ml-3 sm:ml-6">
                  <li v-for="(user, userIndex) in usersLiked" :key="userIndex">
                    <vx-tooltip :text="user.name" position="bottom">
                      <vs-avatar :src="user.img" size="30px" class="border-2 border-white border-solid -m-1"></vs-avatar>
                    </vx-tooltip>
                  </li>
                </ul>
                <!-- <small class="ml-2">+{{ post.likes - 5 }} more</small> -->
              </div>

              <div class="btn-add-new p-3 mr-2 rounded-sm cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary">
                <feather-icon icon="EditIcon" svgClasses="h-4 w-4" />
              </div>
              <!-- <div class="flex items-center"><feather-icon class="mr-2" icon="MessageSquareIcon" svgClasses="h-5 w-5"></feather-icon> <span>{{ post.comments }}</span></div> -->
            </div>
            
            <!-- <p class="mb-3​">
              <center><vs-button class="mt-4 mr-2 shadow-lg" type="border" color="#ffffff" gradient-color-secondary="#CE9FFC">{{$t("Download")}}</vs-button></center>
            </p> -->
        </vx-card>
      </div>
      <!-- Grid -->
      <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
        <vx-card
            title="Monitoring"
            title-color="#000000"
            card-background="default"
            content-color="#000000">
            <center><h5 class="pb-4" style="line-height: 30px;">Total 5 users</h5></center>

            <div class="flex justify-between">
              <div class="flex items-center">
                <!-- <div class="flex items-center"><feather-icon class="mr-2" icon="HeartIcon" svgClasses="h-5 w-5"></feather-icon> <span>{{ post.likes }}</span></div> -->
                <ul class="users-liked user-list ml-3 sm:ml-6">
                  <li v-for="(user, userIndex) in usersLiked" :key="userIndex">
                    <vx-tooltip :text="user.name" position="bottom">
                      <vs-avatar :src="user.img" size="30px" class="border-2 border-white border-solid -m-1"></vs-avatar>
                    </vx-tooltip>
                  </li>
                </ul>
                <!-- <small class="ml-2">+{{ post.likes - 5 }} more</small> -->
              </div>

              <div class="btn-add-new p-3 mr-2 rounded-sm cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary">
                <feather-icon icon="EditIcon" svgClasses="h-4 w-4" />
              </div>
              <!-- <div class="flex items-center"><feather-icon class="mr-2" icon="MessageSquareIcon" svgClasses="h-5 w-5"></feather-icon> <span>{{ post.comments }}</span></div> -->
            </div>
            
            <!-- <p class="mb-3​">
              <center><vs-button class="mt-4 mr-2 shadow-lg" type="border" color="#ffffff" gradient-color-secondary="#CE9FFC">{{$t("Download")}}</vs-button></center>
            </p> -->
        </vx-card>
      </div>
      <!-- Grid -->
      <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
        <vx-card
            title="Editor"
            title-color="#000000"
            card-background="default"
            content-color="#000000">
            <center><h5 class="pb-4" style="line-height: 30px;">Total 5 users</h5></center>

            <div class="flex justify-between">
              <div class="flex items-center">
                <!-- <div class="flex items-center"><feather-icon class="mr-2" icon="HeartIcon" svgClasses="h-5 w-5"></feather-icon> <span>{{ post.likes }}</span></div> -->
                <ul class="users-liked user-list ml-3 sm:ml-6">
                  <li v-for="(user, userIndex) in usersLiked" :key="userIndex">
                    <vx-tooltip :text="user.name" position="bottom">
                      <vs-avatar :src="user.img" size="30px" class="border-2 border-white border-solid -m-1"></vs-avatar>
                    </vx-tooltip>
                  </li>
                </ul>
                <!-- <small class="ml-2">+{{ post.likes - 5 }} more</small> -->
              </div>

              <div class="btn-add-new p-3 mr-2 rounded-sm cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary">
                <feather-icon icon="EditIcon" svgClasses="h-4 w-4" />
              </div>
              <!-- <div class="flex items-center"><feather-icon class="mr-2" icon="MessageSquareIcon" svgClasses="h-5 w-5"></feather-icon> <span>{{ post.comments }}</span></div> -->
            </div>
            
            <!-- <p class="mb-3​">
              <center><vs-button class="mt-4 mr-2 shadow-lg" type="border" color="#ffffff" gradient-color-secondary="#CE9FFC">{{$t("Download")}}</vs-button></center>
            </p> -->
        </vx-card>
      </div>
    </div>

    <vx-card ref="filterCard" title="Filters" class="user-list-filters mb-8" actionButtons @refresh="resetColFilters" @remove="resetColFilters">
      <div class="vx-row">
        <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
          <label class="text-sm opacity-75">Role</label>
          <v-select :options="roleOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="roleFilter" class="mb-4 md:mb-0" />
        </div>
        <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
          <label class="text-sm opacity-75">Status</label>
          <v-select :options="statusOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="statusFilter" class="mb-4 md:mb-0" />
        </div>
        <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
          <label class="text-sm opacity-75">Verified</label>
          <v-select :options="isVerifiedOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="isVerifiedFilter" class="mb-4 sm:mb-0" />
        </div>
        <div class="vx-col md:w-1/4 sm:w-1/2 w-full">
          <label class="text-sm opacity-75">Department</label>
          <v-select :options="departmentOptions" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-model="departmentFilter" />
        </div>
      </div>
    </vx-card>

    <div class="vx-card p-6">

      <div class="flex flex-wrap items-center">

        <!-- ITEMS PER PAGE -->
        <div class="flex-grow">
          <vs-dropdown vs-trigger-click class="cursor-pointer">
            <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
              <span class="mr-2">{{ currentPage * paginationPageSize - (paginationPageSize - 1) }} - {{ usersData.length - currentPage * paginationPageSize > 0 ? currentPage * paginationPageSize : usersData.length }} of {{ usersData.length }}</span>
              <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
            </div>
            <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
            <vs-dropdown-menu>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(5)">
                <span>5</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(10)">
                <span>10</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(20)">
                <span>20</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(25)">
                <span>25</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(30)">
                <span>30</span>
              </vs-dropdown-item>
            </vs-dropdown-menu>
          </vs-dropdown>
        </div>

        <!-- TABLE ACTION COL-2: SEARCH & EXPORT AS CSV -->
          <vs-input class="sm:mr-4 mr-0 sm:w-auto w-full sm:order-normal order-3 sm:mt-0 mt-4" v-model="searchQuery" @input="updateSearchQuery" placeholder="Search..." />
          <!-- <vs-button class="mb-4 md:mb-0" @click="gridApi.exportDataAsCsv()">Export as CSV</vs-button> -->

          <!-- ACTION - DROPDOWN -->
          <vs-dropdown vs-trigger-click class="cursor-pointer">

            <div class="p-3 shadow-drop rounded-lg d-theme-dark-light-bg cursor-pointer flex items-end justify-center text-lg font-medium w-32">
              <span class="mr-2 leading-none">Actions</span>
              <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
            </div>

            <vs-dropdown-menu>

              <vs-dropdown-item>
                <span class="flex items-center">
                  <feather-icon icon="TrashIcon" svgClasses="h-4 w-4" class="mr-2" />
                  <span>Delete</span>
                </span>
              </vs-dropdown-item>

              <vs-dropdown-item>
                <span class="flex items-center">
                  <feather-icon icon="ArchiveIcon" svgClasses="h-4 w-4" class="mr-2" />
                  <span>Archive</span>
                </span>
              </vs-dropdown-item>

              <vs-dropdown-item>
                <span class="flex items-center">
                  <feather-icon icon="FileIcon" svgClasses="h-4 w-4" class="mr-2" />
                  <span>Print</span>
                </span>
              </vs-dropdown-item>

              <vs-dropdown-item>
                <span class="flex items-center">
                  <feather-icon icon="SaveIcon" svgClasses="h-4 w-4" class="mr-2" />
                  <span>CSV</span>
                </span>
              </vs-dropdown-item>

            </vs-dropdown-menu>
          </vs-dropdown>
      </div>


      <!-- AgGrid Table -->
      <ag-grid-vue
        ref="agGridTable"
        :components="components"
        :gridOptions="gridOptions"
        class="ag-theme-material w-100 my-4 ag-grid-table"
        :columnDefs="columnDefs"
        :defaultColDef="defaultColDef"
        :rowData="usersData"
        rowSelection="multiple"
        colResizeDefault="shift"
        :animateRows="true"
        :floatingFilter="true"
        :pagination="true"
        :paginationPageSize="paginationPageSize"
        :suppressPaginationPanel="true"
        :enableRtl="$vs.rtl">
      </ag-grid-vue>

      <vs-pagination
        :total="totalPages"
        :max="7"
        v-model="currentPage" />

    </div>
  </div>

</template>

<script>
import { AgGridVue } from "ag-grid-vue"
import '@sass/vuexy/extraComponents/agGridStyleOverride.scss'
import vSelect from 'vue-select'

// Store Module
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'

// Cell Renderer
import CellRendererLink from "./cell-renderer/CellRendererLink.vue"
import CellRendererStatus from "./cell-renderer/CellRendererStatus.vue"
import CellRendererVerified from "./cell-renderer/CellRendererVerified.vue"
import CellRendererActions from "./cell-renderer/CellRendererActions.vue"


export default {
  components: {
    AgGridVue,
    vSelect,

    // Cell Renderer
    CellRendererLink,
    CellRendererStatus,
    CellRendererVerified,
    CellRendererActions,
  },
  data() {
    return {
      usersLiked : [
        { name: 'Trina Lynes',       img: require("@assets/images/portrait/small/avatar-s-1.jpg") },
        { name: 'Lilian Nenez',      img: require("@assets/images/portrait/small/avatar-s-2.jpg") },
        { name: 'Alberto Glotzbach', img: require("@assets/images/portrait/small/avatar-s-3.jpg") },
        { name: 'George Nordick',    img: require("@assets/images/portrait/small/avatar-s-4.jpg") },
        { name: 'Vennie Mostowy',    img: require("@assets/images/portrait/small/avatar-s-5.jpg") },
        { name: 'George Nordick',    img: require("@assets/images/portrait/small/avatar-s-4.jpg") },
        { name: 'Vennie Mostowy',    img: require("@assets/images/portrait/small/avatar-s-5.jpg") },
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
        CellRendererLink,
        CellRendererStatus,
        CellRendererVerified,
        CellRendererActions,
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
      if(this.gridApi) return this.gridApi.paginationGetPageSize()
      else return 10
    },
    totalPages() {
      if(this.gridApi) return this.gridApi.paginationGetTotalPages()
      else return 0
    },
    currentPage: {
      get() {
        if(this.gridApi) return this.gridApi.paginationGetCurrentPage() + 1
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

      if(val !== "all") {
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
    if(this.$vs.rtl) {
      const header = this.$refs.agGridTable.$el.querySelector(".ag-header-container")
      header.style.left = "-" + String(Number(header.style.transform.slice(11,-3)) + 9) + "px"
    }
  },
  created() {
    if(!moduleUserManagement.isRegistered) {
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
