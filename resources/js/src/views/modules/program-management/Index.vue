<template>
    <div id="invoice-page">

        <div class="flex flex-wrap items-center justify-between">
          <vx-input-group class="mb-base mr-3">
            <vs-input v-model="mailTo" :placeholder="$t('Search Area')" />

            <template slot="append">
              <div class="append-text btn-addon">
                <vs-button type="border" @click="mailTo = ''" class="whitespace-no-wrap">{{$t("Search")}}</vs-button>
              </div>
            </template>
          </vx-input-group>
          <div class="flex items-center">
            <!-- ADD NEW -->
            <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-warning" @click="addNewData">
                <feather-icon icon="DownloadIcon" svgClasses="h-4 w-4" />
                <span class="ml-2 text-base text-primary">{{$t("Download")}}</span>
            </div>
            <!-- ADD NEW -->
            <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-danger" @click="printInvoice">
                <feather-icon icon="FileIcon" svgClasses="h-4 w-4" />
                <span class="ml-2 text-base text-primary">{{$t("Print")}}</span>
            </div>
            <!-- ADD NEW -->
            <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
              <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
              <span class="ml-2 text-base text-primary">{{$t("AddNew")}}</span>
            </div>
          </div>
        </div>

        <vs-navbar
          text-color="rgba(255,255,255,.6)"
          active-text-color="rgba(255,255,255,1)" 
          :type="type" 
          color="#F4F4F4"
          v-model="activeItem" 
          style="box-shadow: 1px 5px 15px;"
          class="p-2 mb-6">

          <div slot="title">
            <vs-navbar-title>
              <span>គោលបំណងនយោបាយទី១ៈ ការគ្រប់គ្រងសេដ្ឋកិច្ច និងហិរញ្ញវត្ថុ</span>
            </vs-navbar-title>
          </div>

          <vs-navbar-item index="0">
              <a href="#" style="color: #000000;">សរុបកម្មវិធី</a>
          </vs-navbar-item>
        </vs-navbar>

        <div class="vx-row">

          <!-- Background Color -->
          <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
              <vx-card
                  title="ចំណាត់ថ្នាក់ៈ 101"
                  title-color="#fff"
                  card-background="primary"
                  content-color="#fff"
                  code-toggler>
                  <center><h5 class="pb-4" style="line-height: 30px;">កម្មវិធីទី១ៈ <br/>ការគ្រប់គ្រងវិស្ស័យសេដ្ឋកិច្ច</h5></center>
                  <p class="mb-3​ text-right">សរុបអនុកម្មវិធី</p>
              </vx-card>
          </div>
          <!-- Background Color -->
          <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
              <vx-card
                  title="ចំណាត់ថ្នាក់ៈ 101"
                  title-color="#fff"
                  card-background="danger"
                  content-color="#fff"
                  code-toggler>
                  <center><h5 class="pb-4" style="line-height: 30px;">កម្មវិធីទី១ៈ <br/>ការគ្រប់គ្រងវិស្ស័យសេដ្ឋកិច្ច</h5></center>
                  <p class="mb-3​ text-right">សរុបអនុកម្មវិធី</p>
              </vx-card>
          </div>

          <!-- Background Color -->
          <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
              <vx-card
                  title="ចំណាត់ថ្នាក់ៈ 101"
                  title-color="#fff"
                  card-background="warning"
                  content-color="#fff"
                  code-toggler>
                  <center><h5 class="pb-4" style="line-height: 30px;">កម្មវិធីទី១ៈ <br/>ការគ្រប់គ្រងវិស្ស័យសេដ្ឋកិច្ច</h5></center>
                  <p class="mb-3​ text-right">សរុបអនុកម្មវិធី</p>
              </vx-card>
          </div>

          <!-- Background Color -->
          <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
              <vx-card
                  title="ចំណាត់ថ្នាក់ៈ 101"
                  title-color="#fff"
                  card-background="primary"
                  content-color="#fff"
                  code-toggler>
                  <center><h5 class="pb-4" style="line-height: 30px;">កម្មវិធីទី១ៈ <br/>ការគ្រប់គ្រងវិស្ស័យសេដ្ឋកិច្ច</h5></center>
                  <p class="mb-3​ text-right">សរុបអនុកម្មវិធី</p>
              </vx-card>
          </div>

        </div>

        <vs-navbar
          text-color="rgba(255,255,255,.6)"
          active-text-color="rgba(255,255,255,1)" 
          :type="type" 
          color="#F4F4F4"
          v-model="activeItem" 
          style="box-shadow: 1px 5px 15px;"
          class="p-2 mb-6">

          <div slot="title">
            <vs-navbar-title>
              <span>គោលបំណងនយោបាយទី១ៈ ការគ្រប់គ្រងសេដ្ឋកិច្ច និងហិរញ្ញវត្ថុ</span>
            </vs-navbar-title>
          </div>

          <vs-navbar-item index="0">
              <a href="#" style="color: #000000;">សរុបកម្មវិធី</a>
          </vs-navbar-item>
        </vs-navbar>

        <div class="vx-row">
            <!-- Background Color -->
          <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
              <vx-card
                  title="ចំណាត់ថ្នាក់ៈ 101"
                  title-color="#fff"
                  card-background="primary"
                  content-color="#fff"
                  code-toggler>
                  <center><h5 class="pb-4" style="line-height: 30px;">កម្មវិធីទី១ៈ <br/>ការគ្រប់គ្រងវិស្ស័យសេដ្ឋកិច្ច</h5></center>
                  <p class="mb-3​ text-right">សរុបអនុកម្មវិធី</p>
              </vx-card>
          </div>
          <!-- Background Color -->
          <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
              <vx-card
                  title="ចំណាត់ថ្នាក់ៈ 101"
                  title-color="#fff"
                  card-background="danger"
                  content-color="#fff"
                  code-toggler>
                  <center><h5 class="pb-4" style="line-height: 30px;">កម្មវិធីទី១ៈ <br/>ការគ្រប់គ្រងវិស្ស័យសេដ្ឋកិច្ច</h5></center>
                  <p class="mb-3​ text-right">សរុបអនុកម្មវិធី</p>
              </vx-card>
          </div>

          <!-- Background Color -->
          <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
              <vx-card
                  title="ចំណាត់ថ្នាក់ៈ 101"
                  title-color="#fff"
                  card-background="warning"
                  content-color="#fff"
                  code-toggler>
                  <center><h5 class="pb-4" style="line-height: 30px;">កម្មវិធីទី១ៈ <br/>ការគ្រប់គ្រងវិស្ស័យសេដ្ឋកិច្ច</h5></center>
                  <p class="mb-3​ text-right">សរុបអនុកម្មវិធី</p>
              </vx-card>
          </div>

          <!-- Background Color -->
          <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
              <vx-card
                  title="ចំណាត់ថ្នាក់ៈ 101"
                  title-color="#fff"
                  card-background="primary"
                  content-color="#fff"
                  code-toggler>
                  <center><h5 class="pb-4" style="line-height: 30px;">កម្មវិធីទី១ៈ <br/>ការគ្រប់គ្រងវិស្ស័យសេដ្ឋកិច្ច</h5></center>
                  <p class="mb-3​ text-right">សរុបអនុកម្មវិធី</p>
              </vx-card>
          </div>

        </div>

        <vs-navbar
          text-color="rgba(255,255,255,.6)"
          active-text-color="rgba(255,255,255,1)" 
          :type="type" 
          color="#F4F4F4"
          v-model="activeItem" 
          style="box-shadow: 1px 5px 15px;"
          class="p-2 mb-6">

          <div slot="title">
            <vs-navbar-title>
              <span>គោលបំណងនយោបាយទ៣១ៈ ការគ្រប់គ្រងសេដ្ឋកិច្ច និងហិរញ្ញវត្ថុ</span>
            </vs-navbar-title>
          </div>

          <vs-navbar-item index="0">
              <a href="#" style="color: #000000;">សរុបកម្មវិធី</a>
          </vs-navbar-item>
        </vs-navbar>

        <!-- <div class="vx-row text-center">
          <center>
            <vs-button type="border" class="whitespace-no-wrap">{{$t("បង្កើតកម្មវិធីថ្មី")}}</vs-button>
          </center>
        </div> -->
        
        <!-- List Data View -->
        <!-- <data-list-view></data-list-view> -->
         <table-expandable-data></table-expandable-data>

    </div>
</template>

<script>
    import DataViewSidebar from './DataViewSidebar.vue'
    import moduleDataList from "@/store/data-list/moduleDataList.js"
    import DataListView from './_DataListView.vue'
    import TableExpandableData from './TableExpandableData.vue'
  export default{
      data() {
          return {
                colorx: '#5A8DEE',
              mailTo: "",
              companyDetails: {
                  name: 'Microsion Technologies Pvt. Ltd.',
                  addressLine1: '9 N. Sherwood Court',
                  addressLine2: 'Elyria, OH',
                  zipcode: '94203',
                  mailId: 'hello@pixinvent.net',
                  mobile: '+91 999 999 9999',
              },
              recipientDetails: {
                  fullName: 'Peter Stark',
                  addressLine1: '8577 West West Drive ',
                  addressLine2: 'Holbrook, NY',
                  zipcode: '90001',
                  mailId: 'peter@mail.com',
                  mobile: '+91 988 888 8888',
              },
              invoiceDetails: {
                  invoiceNo: '001/2019',
                  invoiceDate: 'Mon Dec 10 2018 07:46:00 GMT+0000 (GMT)',
              },
              invoiceData: {
                  tasks: [
                      {
                          id: 1,
                          task: 'Website Redesign',
                          hours: 60,
                          rate: 15,
                          amount: 90000,
                      },
                      {
                          id: 2,
                          task: 'Newsletter template design',
                          hours: 20,
                          rate: 12,
                          amount: 24000,
                      },
                  ],
                  subtotal: 114000,
                  discountPercentage: 5,
                  discountedAmount: 5700,
                  total: 108300,
              },

                selected: [],
                // products: [],
                itemsPerPage: 4,
                isMounted: false,

                // Data Sidebar
                addNewDataSidebar: false,
                sidebarData: {},
          }
      },
      computed: {
        currentPage() {
        if(this.isMounted) {
            return this.$refs.table.currentx
        }
        return 0
        },
        products() {
        return this.$store.state.dataList.products
        },
        queriedItems() {
        return this.$refs.table ? this.$refs.table.queriedResults.length : this.products.length
        }
      },
      methods: {
        printInvoice() {
          window.print()
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
      components: {
        DataViewSidebar,
        DataListView,
        TableExpandableData
      },
      mounted() {
        this.$emit("setAppClasses", "invoice-page")
      }
  }
</script>

<style lang="scss">
  @media print {
    .invoice-page {
      * {
        visibility: hidden;
      }

      #content-area {
        margin: 0 !important;
      }

      #invoice-container,
      #invoice-container * {
        visibility: visible;
      }
      #invoice-container {
        position: absolute;
        left: 0;
        top: 0;
        box-shadow: none;
      }
    }
  }
</style>