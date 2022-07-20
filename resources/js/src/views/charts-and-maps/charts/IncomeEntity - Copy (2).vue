<!-- =========================================================================================
    File Name: DashboardEcommerce.vue
    Description: Dashboard - Ecommerce
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <vx-card title="% ចំណូលតាមតាមវិស័យ">
    <!-- <template slot="actions">
      <change-time-duration-dropdown />
    </template> -->
    <div v-for="(browser, index) in browserAnalytics" :key="browser.id" :class="{'mt-4': index}">
      <div class="flex justify-between">
          <div class="flex flex-col">
              <span class="mb-1">{{ browser.name }}</span>
              <h4>{{ browser.ratio }}%</h4>
          </div>
          <div class="flex flex-col text-right">
              <span class="flex -mr-1">
                  <span class="mr-1">{{ browser.comparedResult }}</span>
                  <feather-icon :icon=" browser.comparedResult < 0 ? 'ArrowDownIcon' : 'ArrowUpIcon'" :svgClasses="[browser.comparedResult < 0 ? 'text-danger' : 'text-success'  ,'stroke-current h-4 w-4 mb-1 mr-1']"></feather-icon>
              </span>
              <span class="text-grey">{{ browser.time | time(true) }}</span>
          </div>
      </div>
      <vs-progress :percent="browser.ratio"></vs-progress>
    </div>
  </vx-card>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import VueApexCharts from 'vue-apexcharts'
import StatisticsCardLine from '@/components/statistics-cards/StatisticsCardLine.vue'
import ChangeTimeDurationDropdown from '@/components/ChangeTimeDurationDropdown.vue'
import router from '@/router'
import axios from "@/axios.js"
export default{
    data() {
        return {
          browserAnalytics: [{
            id: 1,
            name: 'វិស័យសេវាសេដ្ឋកិច្ច',
            ratio: 73,
            time: 'Mon Dec 10 2018 07:46:05 GMT+0000 (GMT)',
            comparedResult: '800'
          },
          {
            id: 3,
            name: 'វិស័យសេវាសង្គមកិច្ច',
            ratio: 8,
            time: 'Mon Dec 10 2018 07:46:05 GMT+0000 (GMT)',
            comparedResult: '-200'
          },
          {
            id: 2,
            name: 'វិស័យសាធារណៈទូទៅ',
            ratio: 19,
            time: 'Mon Dec 10 2018 07:46:05 GMT+0000 (GMT)',
            comparedResult: '100'
          },
          {
            id: 4,
            name: 'វិស័យការពារជាតិ សន្តិសុខ',
            ratio: 27,
            time: 'Mon Dec 10 2018 07:46:05 GMT+0000 (GMT)',
            comparedResult: '-450'
          },
        ],
          summaryInfo: ""
        }
    },
    created() {
      this.getIncomeByEntity()
    },
    methods: {
      getIncomeByEntity(){
        return new Promise((resolve, reject) => {
            axios.get("/api/v1/report/income_by_entity")
                .then((response) => {
              this.browserAnalytics = response.data
            }).catch((error) => { reject(error) })
        })
      },
    },
    components: {
      apexchart: VueApexCharts,
      ChangeTimeDurationDropdown
    },
}
</script>
