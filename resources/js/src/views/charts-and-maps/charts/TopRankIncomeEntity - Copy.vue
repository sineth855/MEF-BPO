<!-- =========================================================================================
    File Name: DashboardEcommerce.vue
    Description: Dashboard - Ecommerce
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <vx-card title="ចំណាត់ថ្នាក់ចំណូលតាមអង្គភាពទាំង ១០">
      <!-- <template slot="actions">
          <change-time-duration-dropdown />
      </template> -->

      <div slot="no-body">
          <apexchart class="mt-6 mb-8" type=donut height=325 :options="sessionsByDeviceDonut.chartOptions" :series="series" />
      </div>

      <ul class="mt-6">
          <li v-for="deviceData in analyticsData" :key="deviceData.device" class="flex mb-3">
              <feather-icon :icon="deviceData.icon" :svgClasses="[`h-5 w-5 stroke-current text-${deviceData.color}`]"></feather-icon>
              <span class="ml-2 inline-block font-semibold">{{ deviceData.device }}</span>
              <span class="mx-2">-</span>
              <span class="mr-4">{{ deviceData.sessionsPercentage }}%</span>
              <div class="ml-auto flex -mr-1">
              <span class="mr-1">{{ deviceData.comparedResultPercentage }}%</span>
              <feather-icon :icon=" deviceData.comparedResultPercentage < 0 ? 'ArrowDownIcon' : 'ArrowUpIcon'" :svgClasses="[deviceData.comparedResultPercentage < 0 ? 'text-danger' : 'text-success'  ,'stroke-current h-4 w-4 mb-1 mr-1']"></feather-icon>
              </div>
          </li>
      </ul>
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
        // SessionsByDevice
        sessionsByDeviceDonut: {
            // analyticsData: [
            //     { device: 'Dekstop', icon: 'MonitorIcon', color: 'primary', sessionsPercentgae: 58.6, comparedResultPercentage: 2 },
            //     { device: 'Mobile', icon: 'SmartphoneIcon', color: 'warning', sessionsPercentgae: 34.9, comparedResultPercentage: 8 },
            //     { device: 'Tablet', icon: 'TabletIcon', color: 'danger', sessionsPercentgae: 6.5, comparedResultPercentage: -5 },
            // ],
            // comparedResult: [2, -3, 8],
            // series: [58.6, 34.9, 6.5],
            chartOptions: {
                labels: ['កំពូល និងឯករាជ្', 'សេវាការពារជាតិ​ សន្តិសុខ និង​សណ្តាប់', 'សេវាសង្គមកិច្ច', 'សេវា​ហិរញ្ញវត្ថុ ការបរទេស និង​សេវាសាធារណៈទូទៅ', 'សេវាសេដ្ឋកិច្'],
                dataLabels: {
                    enabled: false
                },
                legend: { show: false },
                chart: {
                    offsetY: 30,
                    type: 'donut',
                    toolbar: {
                        show: false
                    }
                },
                stroke: { width: 0 },
                colors: ['#7961F9', '#FF9F43', '#EA5455', '#7961F9', '#DF9543', '#EA5455'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        gradientToColors: ['#9c8cfc', '#FFC085', '#f29292', '#9c8cfc', '#FFC085', '#f29292']
                    }
                }
            }
        },
        analyticsData: [
          { device: 'កំពូល និងឯករាជ្យ', icon: 'activity', color: 'primary', sessionsPercentage: 58.6, comparedResultPercentage: 2 },
          { device: 'សេវាការពារជាតិ​ សន្តិសុខ និង​សណ្តាប់ធ្លាប់សាធារណៈ', icon: 'activity', color: 'warning', sessionsPercentage: 34.9, comparedResultPercentage: 8 },
          { device: 'សេវាសង្គមកិច្ច', icon: 'activity', color: 'danger', sessionsPercentage: 26.5, comparedResultPercentage: 5 },
          { device: 'សេវា​ហិរញ្ញវត្ថុ ការបរទេស និង​សេវាសាធារណៈទូទៅ', icon: 'activity', color: 'danger', sessionsPercentage: 57.3, comparedResultPercentage: -5 },
          { device: 'សេវាសេដ្ឋកិច្ច', icon: 'activity', color: 'danger', sessionsPercentage: 16.5, comparedResultPercentage: 1 }
        ],
        series: [58.6, 34.9, 26.5, 57.3, 12.2],
        browserAnalytics: ""
      }
    },
    created() {
      this.getTopRankEntity()
    },
    methods: {
      getTopRankEntity(){
        return new Promise((resolve, reject) => {
            axios.get("/api/v1/report/income_by_entity")
                .then((response) => {
              // this.browserAnalytics = response.data
              this.customers = {
                analyticsData: response.data.data
              }
                // { 'customerType': 'វិស័យសេវាសេដ្ឋកិច្ច', 'counts': '១៣,៩៩៨,៧៤៤ ៛', color: 'primary' },
                // { 'customerType': 'វិស័យសេវាសង្គមកិច្ច', 'counts': '១៣,៩៩៨,៧៤៤ ៛', color: 'warning' },
                // { 'customerType': 'វិស័យសាធារណៈទូទៅ ', 'counts': '១៣,៩៩៨,៧៤៤ ៛', color: 'danger' },
            }).catch((error) => { reject(error) })
        })
      }
    },
    components: {
      apexchart: VueApexCharts,
      ChangeTimeDurationDropdown
    },
}
</script>
