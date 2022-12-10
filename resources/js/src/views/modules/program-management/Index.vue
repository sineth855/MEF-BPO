<template>
  <div id="invoice-page">
    <modal-objective ref="refModalObjective" ></modal-objective>
    <modal-program ref="refModalProgram"></modal-program>
    <!-- <vs-popup classContent="popup-example" title="Lorem ipsum dolor sit amet" :active.sync="popupActive2">
      <vs-input class="inputx mb-3" placeholder="Placeholder" />
      <vs-input disabled class="inputx mb-3" placeholder="Disabled" />
      <vs-button @click="popupActive3=true" color="primary" type="filled">Open Inner Popup</vs-button>
      <vs-popup title="Inner popup" :active.sync="popupActive3">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </vs-popup>
    </vs-popup> -->

    <div class="flex flex-wrap items-center justify-between">
      <vx-input-group class="mb-base mr-3">
        <vs-input v-model="mailTo" />
        <template slot="append">
          <div class="append-text btn-addon">
            <vs-button type="border" @click="mailTo = ''" class="whitespace-no-wrap">{{$t("Search")}}</vs-button>
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

          <div class="btn-add-new p-3 mr-1 rounded-sm cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="operFormObjective">
            <vx-tooltip color="success" text="បង្កើតគោលបំណង">
              <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
              <span class="ml-2 text-base text-primary">{{$t("AddNew")}}</span>
            </vx-tooltip>
          </div>

        </div>

      </div>
    </div>

    <vs-navbar
      text-color="rgba(255,255,255,.6)"
      active-text-color="rgba(255,255,255,1)" 
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
        <div class="vx-row mr-1">
          <div class="btn-add-new p-3 mr-2 rounded-sm cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="operFormProgram">
            <feather-icon icon="EditIcon" svgClasses="h-4 w-4" />
          </div>
          <div class="btn-add-new p-3 mr-1 rounded-sm cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="operFormProgram">
            <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
          </div>
        </div>
      </vs-navbar-item>
    </vs-navbar>

    <div class="vx-row">

      <!-- Background Color -->
      <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
          <vx-card
              title="ចំណាត់ថ្នាក់ៈ 101"
              title-color="#fff"
              card-background="#BFCAEF"
              content-color="#fff"
              code-toggler
              @click="isVisible = !isVisible">
              <div>កែប្រែ</div>
              <center><h5 class="pb-4" style="line-height: 30px;"><b>កម្មវិធីទី១ៈ <br/>ការគ្រប់គ្រងវិស្ស័យសេដ្ឋកិច្ច</b></h5></center>
              <p class="mb-3​ text-right">សរុបអនុកម្មវិធីៈ 5</p>
          </vx-card>
      </div>
      <!-- Background Color -->
      <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
          <vx-card
              title="ចំណាត់ថ្នាក់ៈ 102"
              title-color="#fff"
              card-background="#8BEABC"
              content-color="#fff"
              code-toggler
              @click="isVisible = !isVisible">
              <center><h5 class="pb-4" style="line-height: 30px;"><b>កម្មវិធីទី២ៈ <br/>ការគ្រប់គ្រងវិស្ស័យហិរញ្ញវត្ថុ</b></h5></center>
              <p class="mb-3​ text-right">សរុបអនុកម្មវិធីៈ ៦</p>
          </vx-card>
      </div>

    </div>

    
    <table-expandable-data v-show="isVisible"></table-expandable-data>

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
            <span>គោលបំណងនយោបាយទី២ៈ ការគ្រប់គ្រងប្រព័ន្ធហិរញ្ញវត្ថុ</span>
          </vs-navbar-title>
        </div>

        <vs-navbar-item index="0">
          <div class="vx-row mr-1">
            <div class="btn-add-new p-3 mr-2 rounded-sm cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary">
              <feather-icon icon="EditIcon" svgClasses="h-4 w-4" />
            </div>

            <div class="btn-add-new p-3 mr-1 rounded-sm cursor-pointer text-right flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary">
              <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
            </div>
          </div>
        </vs-navbar-item>
      </vs-navbar>

      <div class="vx-row">
          <!-- Background Color -->
        <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
            <vx-card
                title="ចំណាត់ថ្នាក់ៈ 103"
                title-color="#fff"
                card-background="#FEC8FF"
                content-color="#fff"
                code-toggler
                @click="isVisible = !isVisible">
                <center><h5 class="pb-4" style="line-height: 30px;"><b>កម្មវិធីទី៣ <br/>ការគ្រប់គ្រងចំណូលសាធារណៈ និងទ្រព្យសម្បត្តិរដ្ឋ</b></h5></center>
                <p class="mb-3​ text-right">សរុបអនុកម្មវិធី</p>
            </vx-card>
        </div>
        <!-- Background Color -->
        <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
            <vx-card
                title="ចំណាត់ថ្នាក់ៈ 104"
                title-color="#fff"
                card-background="#AFC817"
                content-color="#fff"
                code-toggler
                @click="isVisible = !isVisible">
                <center><h5 class="pb-4" style="line-height: 30px;"><b>កម្មវិធីទី៤ <br/>ការគ្រប់គ្រងចំណាយសាធារណៈ និងប្រព័ន្ធហិរញ្ញវត្ថុសាធារណៈ</b></h5></center>
                <p class="mb-3​ text-right">សរុបអនុកម្មវិធី</p>
            </vx-card>
        </div>

        <!-- Background Color -->
        <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
            <vx-card
                title="ចំណាត់ថ្នាក់ៈ 105"
                title-color="#fff"
                card-background="#7A97FB"
                content-color="#fff"
                code-toggler
                @click="isVisible = !isVisible">
                <center><h5 class="pb-4" style="line-height: 30px;"><b>កម្មវិធីទី៥ៈ <br/>កិច្ចការរដ្ឋបាល និងអភិវឌ្ឍស្ថាប័ន</b><br/><br/></h5></center>
                <p class="mb-3​ text-right">សរុបអនុកម្មវិធី</p>
            </vx-card>
        </div>
      </div>
    <table-expandable-data v-show="isVisible"></table-expandable-data>
  </div>
</template>

<script>
  import TableExpandableData from './_TableExpandableData.vue'
  import ModalObjective from './modal/_Objective.vue'
  import ModalProgram from './modal/_Program.vue'
  import ModalSubprogram from './modal/_Subprogram.vue'
  import ModalIndicator from './modal/_Indicator.vue'
  import { ref } from 'vue';

  export default{
      data() {
        return {
          popupActive2: false, 
          popupActive3: false, 
          activeItem: "",
          type: "",
          value1:"",
          value2:"",
          isVisible: false,
          colorx: '#5A8DEE',
          mailTo: "",
          selected: [],
          itemsPerPage: 4,
          isMounted: false,
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
        operFormObjective(){
          this.$refs.refModalObjective.initObjective();
        },
        operFormProgram() {
          this.$refs.refModalProgram.initProgram();
        },
        printInvoice() {
          window.print()
        },
        // addNewData() {
        // this.sidebarData = {}
        // this.toggleDataSidebar(true)
        // },
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
        TableExpandableData,
        ModalObjective,
        ModalProgram,
        ModalSubprogram,
        ModalIndicator
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