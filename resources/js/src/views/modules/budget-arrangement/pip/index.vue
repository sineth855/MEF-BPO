<!-- =========================================================================================
  File Name: DataListListView.vue
  Description: Data List - List View
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="data-list-list-view" class="data-list-container">

    <data-view-sidebar :isSidebarActive="addNewDataSidebar" @closeSidebar="toggleDataSidebar" :data="sidebarData" />

      <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">

        <div class="flex flex-wrap-reverse items-center data-list-btn-container">

          <!-- ACTION - DROPDOWN -->
          <vs-dropdown vs-trigger-click class="dd-actions cursor-pointer mr-4 mb-4">

            <div class="p-4 shadow-drop rounded-lg d-theme-dark-bg cursor-pointer flex items-center justify-center text-lg font-medium w-32 w-full">
              <span class="mr-2">{{$t("Action")}}</span>
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
                  <span>Another Action</span>
                </span>
              </vs-dropdown-item>

            </vs-dropdown-menu>
          </vs-dropdown>

          <!-- ADD NEW -->
          <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
              <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
              <span class="ml-2 text-base text-primary">{{$t("AddNew")}}</span>
          </div>
        </div>

        <!-- ITEMS PER PAGE -->
        <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4 items-per-page-handler">
          <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
            <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ products.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : products.length }} of {{ queriedItems }}</span>
            <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
          </div>
          <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
          <vs-dropdown-menu>

            <vs-dropdown-item @click="itemsPerPage=4">
              <span>4</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=10">
              <span>10</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=15">
              <span>15</span>
            </vs-dropdown-item>
            <vs-dropdown-item @click="itemsPerPage=20">
              <span>20</span>
            </vs-dropdown-item>
          </vs-dropdown-menu>
        </vs-dropdown>
      </div>

      <div id="ag-grid-demo">
        <vx-card>
          <div class="clearfix"></div>
              <div class="_container-inner">
                  <center>
                      <span class="font-mef2">
                          ព្រះរាជាណាចក្រកម្ពុជា
                          <br/>
                          ជាតិ សាសនា ព្រះមហាក្សត្រ
                          <br/><center>***</center>
                      </span>
                  </center>
                  <div class="font-mef2" style="float: left;">
                    <!-- <img width="120px" src="../../../../assets/images/logo/logo.png"/> -->
                    ក្រសួងសេដ្ឋកិច្ច និងហិរញ្ញវត្ថុ<br/>
                    អគ្គលេខាធិការដ្ឋានក្រសួងសេដ្ឋកិច្ចនិងហិរញ្ញវត្ថុ<br/>
                    នាយកដា្ឋនរដ្ឋបាលនិងហិរញ្ញវត្ថុ<br/>
                    ការិយាល័យផែនការថវិកា
                  </div><br/><br/>
                  <div class="clearfix"></div>
                  <center>    
                      <!-- <span class="font-mef2" style="color: #0d72a2; font-size: 12pt">
                          បញ្ជីសរុប<br/>
                      </span> -->
                      <br/>
                      <span class="font-mef2" style="color: #0d72a2; font-size: 12pt">
                        តារាងសរុបគម្រោងវិនិយោគរបស់ក្រសួងសេដ្ឋកិច្ចនិងហិរញ្ញវត្ថុ សម្រាប់ដាក់បញ្ចុលក្នុង ក.វ.ស. ៣ ឆ្នាំរំកិល ២០២០-២០២២(តាមប្រភេទគម្រោង)<br/>
                      </span>
                      <div class="clearfix"></div>
                      <br/>
                  </center>
              </div>
              <div class="clearfix"></div>
              
          <!-- TABLE ACTION ROW -->
          <div class="flex flex-wrap justify-between items-center">

            <!-- ITEMS PER PAGE -->
            <div class="mb-4 md:mb-0 mr-4 ag-grid-table-actions-left">
              <vs-dropdown vs-trigger-click class="cursor-pointer">
                <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
                  <span class="mr-2">{{ currentPage * paginationPageSize - (paginationPageSize - 1) }} - {{ contacts.length - currentPage * paginationPageSize > 0 ? currentPage * paginationPageSize : contacts.length }} of {{ contacts.length }}</span>
                  <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
                </div>
                <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
                <vs-dropdown-menu>

                  <vs-dropdown-item @click="gridApi.paginationSetPageSize(20)">
                    <span>20</span>
                  </vs-dropdown-item>
                  <vs-dropdown-item @click="gridApi.paginationSetPageSize(50)">
                    <span>50</span>
                  </vs-dropdown-item>
                  <vs-dropdown-item @click="gridApi.paginationSetPageSize(100)">
                    <span>100</span>
                  </vs-dropdown-item>
                  <vs-dropdown-item @click="gridApi.paginationSetPageSize(150)">
                    <span>150</span>
                  </vs-dropdown-item>
                </vs-dropdown-menu>
              </vs-dropdown>
            </div>

            <!-- TABLE ACTION COL-2: SEARCH & EXPORT AS CSV -->
            <div class="flex flex-wrap items-center justify-between ag-grid-table-actions-right">
              <vs-input class="mb-4 md:mb-0 mr-4" v-model="searchQuery" @input="updateSearchQuery" placeholder="Search..." />
              <vs-button class="mb-4 md:mb-0" @click="gridApi.exportDataAsCsv()"><feather-icon icon="DownloadIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" /></vs-button>
            </div>
          </div>

          
          <!-- Table -->
          <vs-table :data="users">

          <!-- <template slot="thead">
            <vs-th>បរិយាយមុខសញ្ញា</vs-th>
            <vs-th>ច្បាប់ឆ្នាំ២០២២</vs-th>
            <vs-th>ចំណាយមិនប្រចាំ</vs-th>
            <vs-th>ចំណាយប្រចាំ</vs-th>
            <vs-th>ពិដានចំណាយចរន្ត</vs-th>
            <vs-th>អាត្រាកំណើនប្រចាំឆ្នាំ</vs-th>
          </template> -->

          <template>
              <vs-tr style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                <vs-td style="width: auto" rowspan="2"><center>ឈ្មោះកម្មវិធី/ ឈ្មោះអនុកម្មវិធី /ឈ្មោះគម្រោង</center></vs-td>
                <vs-td style="" rowspan="2"><center>លេខ PIP</center></vs-td>
                <vs-td style="" rowspan="2"><center>ស្ថានភាពគម្រោង</center></vs-td>
                <vs-td style="" rowspan="2"><center>ប្រភេទគម្រោង</center></vs-td>
                <vs-td style="width: 300px" colspan="3"><center>ចំណាត់ថ្នាក់ប៉ាន់ស្ថានសរុប</center></vs-td>
                <vs-td style="width: 300px" colspan="3"><center>ហិរញ្ញប្បទានសន្យាផ្តល់</center></vs-td>
                <vs-td style="" rowspan="2">សម្គាល់</vs-td>
              </vs-tr>

              <vs-tr style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                <!-- <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td> -->

                <vs-td>២០២៣</vs-td>
                <vs-td>២០២៤</vs-td>
                <vs-td>២០២៥</vs-td>

                <vs-td>២០២៣</vs-td>
                <vs-td>២០២៤</vs-td>
                <vs-td>២០២៥</vs-td>

                <!-- <vs-td></vs-td> -->
              </vs-tr>

              <vs-tr>
                <vs-td>1</vs-td>
                <vs-td><small>2</small></vs-td>
                <vs-td><small>3</small></vs-td>
                <vs-td><small>4</small></vs-td>

                <vs-td><small>4</small></vs-td>
                <vs-td><small>5</small></vs-td>
                <vs-td><small>6</small></vs-td>

                <vs-td><small>7</small></vs-td>
                <vs-td><small>8</small></vs-td>
                <vs-td><small>9</small></vs-td>

                <vs-td><small>10</small></vs-td>
              </vs-tr>

              
              <vs-tr :state="'primary'">
                <vs-td>សរុបរួម ក្រសួង​សេដ្ឋ​កិច្ច​និង​ហិរញ្ញវត្ថុ</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>0.00</vs-td>
                <vs-td>0.00</vs-td>
                <vs-td>0.00</vs-td>
                <vs-td>0.00</vs-td>
                <vs-td>0.00</vs-td>
                <vs-td>0.00</vs-td>
                <vs-td></vs-td>
              </vs-tr>
              
              <!-- Part1 -->
              <vs-tr :state="'warning'">
                <vs-td>កម្មវិធីទី៣៖ ការគ្រប់គ្រងចំណូលសាធារណៈ និងទ្រព្យសម្បត្តិរដ្ឋ</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>0.00</vs-td>
                <vs-td>0.00</vs-td>
                <vs-td>0.00</vs-td>
                <vs-td>0.00</vs-td>
                <vs-td>0.00</vs-td>
                <vs-td>0.00</vs-td>
                <vs-td></vs-td>
              </vs-tr>

                <vs-tr>
                  <vs-td>អនុកម្មវិធី ៣.១ ៖ អគ្គនាយកដ្ឋានគយ និងរដ្ឋាករកម្ពុជា</vs-td>
                  <vs-td></vs-td>
                  <vs-td></vs-td>
                  <vs-td></vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td></vs-td>
                </vs-tr>
                <vs-tr>
                  <vs-td>១. គម្រោងប្រព័ន្ធបញ្ជរតែមួយជាតិ (ដំណាក់កាលទី៣)</vs-td>
                  <vs-td>659</vs-td>
                  <vs-td>គម្រោងស្នើសុំថ្មី</vs-td>
                  <vs-td>វិនិយោគជាទុន</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td></vs-td>
                </vs-tr>


                <vs-tr>
                  <vs-td>អនុកម្មវិធី ៣.២ ៖ អគ្គនាយកដ្ឋានពន្ធដារ</vs-td>
                  <vs-td></vs-td>
                  <vs-td></vs-td>
                  <vs-td></vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td></vs-td>
                </vs-tr>
                <vs-tr>
                  <vs-td>១. គម្រោងសាងសង់អគារសាខាពន្ធដារខណ្ឌចំនួន០១ និងអគារការិយាល័យពន្ធដារស្រុកស្ទឹងហាវ ០១</vs-td>
                  <vs-td>492</vs-td>
                  <vs-td>គម្រោងស្នើសុំថ្មី</vs-td>
                  <vs-td>វិនិយោគជាទុន</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td>0.00</vs-td>
                  <vs-td></vs-td>
                </vs-tr>
          </template>
      </vs-table>
          <!-- ####### Table -->

        </vx-card>
      </div>
        
  </div>
</template>

<script>
import DataViewSidebar from './DataViewSidebar.vue'
import moduleDataList from "@/store/data-list/moduleDataList.js"
import { AgGridVue } from "ag-grid-vue"
import contacts from './data.json'

import '@sass/vuexy/extraComponents/agGridStyleOverride.scss'
export default {
  components: {
    DataViewSidebar,
    AgGridVue
  },
  data() {
    return {
      selected: [],
      // products: [],
      itemsPerPage: 4,
      isMounted: false,

      // Data Sidebar
      addNewDataSidebar: false,
      sidebarData: {},

      searchQuery: '',
      gridOptions: {},
      maxPageNumbers: 7,
      gridApi: null,
      defaultColDef: {
        sortable: true,
        editable: true,
        resizable: true,
        suppressMenu: true
      },
      columnDefs: [
        {
          headerName: 'លេខ PIP',
          field: 'pip_no',
          width: 175,
          filter: true,
          checkboxSelection: true,
          headerCheckboxSelectionFilteredOnly: true,
          headerCheckboxSelection: true,
        },
        {
          headerName: 'ស្ថានភាពគម្រោង',
          field: 'pip_status',
          filter: true,
          width: 175,
        },
        {
          headerName: 'ឈ្មោះកម្មវិធី/កម្មវិធី/ឈ្មោះគម្រោង',
          field: 'pip_project',
          filter: true,
          width: 250,
          pinned: 'left'
        },
        {
          headerName: 'ចំណាយប៉ាន់ស្មាន',
          field: 'pip_estimate_expense',
          filter: true,
          width: 250,
        },
        {
          headerName: 'ហិរញ្ញប្បទានសន្យាផ្តល់',
          field: 'pip_promise',
          filter: true,
          width: 150,
        },
        {
          headerName: 'តម្រូវការហិរញ្ញប្បទានបំពេញបន្ថែម',
          field: 'pip_adjustment_budget',
          filter: true,
          width: 150,
        },
        {
          headerName: 'ប្រភពហិរញ្ញប្បទាន',
          field: 'pip_financail_resource',
          filter: true,
          width: 125,
        }
      ],
      contacts: contacts,

    }
  },
  watch: {
    '$store.state.windowWidth'(val) {
      if(val <= 576) {
        this.maxPageNumbers = 4
        this.gridOptions.columnApi.setColumnPinned('email', null)
      }
      else this.gridOptions.columnApi.setColumnPinned('email', 'left')
    }
  },
  computed: {
    // currentPage() {
    //   if(this.isMounted) {
    //     return this.$refs.table.currentx
    //   }
    //   return 0
    // },
    products() {
      return this.$store.state.dataList.products
    },
    queriedItems() {
      return this.$refs.table ? this.$refs.table.queriedResults.length : this.products.length
    },

    paginationPageSize() {
      if(this.gridApi) return this.gridApi.paginationGetPageSize()
      else return 50
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
    updateSearchQuery(val) {
      this.gridApi.setQuickFilter(val)
    },
    addNewData() {
      this.sidebarData = {}
      this.toggleDataSidebar(true)
    },
    deleteData(id) {
      this.$store.dispatch("dataList/removeItem", id).catch(err => { console.error(err) })
    },
    editData(data) {
      // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
      this.sidebarData = data
      this.toggleDataSidebar(true)
    },
    getOrderStatusColor(status) {
      if(status == 'on_hold') return "warning"
      if(status == 'delivered') return "success"
      if(status == 'canceled') return "danger"
      return "primary"
    },
    getPopularityColor(num) {
      if(num > 90) return "success"
      if(num >70) return "primary"
      if(num >= 50) return "warning"
      if(num < 50) return "danger"
      return "primary"
    },
    toggleDataSidebar(val=false) {
      this.addNewDataSidebar = val
    }
  },
  created() {
    if(!moduleDataList.isRegistered) {
      this.$store.registerModule('dataList', moduleDataList)
      moduleDataList.isRegistered = true
    }
    this.$store.dispatch("dataList/fetchDataListItems")
  },
  mounted() {
    this.isMounted = true;
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
  }
}
</script>

<style>
  th.th-width-300{
    min-width: 260px !important;
  }
  td.td-width-150{
    min-width: 150px !important;
  }
  table tr td, th{
    border: 1px solid #d7d7d7;
  }
  th{
    text-align: center !important;
    /* display: inline; */
  }
  th.rotate{
    transform: rotate(-90deg)
  }
.vs-table--thead th .vs-table-text {
    text-transform: uppercase;
    font-weight: 600;
    text-align: center;
    display: inline !important;
}
</style>