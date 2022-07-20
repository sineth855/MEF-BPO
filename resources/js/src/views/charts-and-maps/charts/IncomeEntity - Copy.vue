<!-- =========================================================================================
    File Name: DashboardEcommerce.vue
    Description: Dashboard - Ecommerce
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <vx-card title="ចំណូលតាមក្រសួង~ស្ថាប័ន(គិតជាលានរៀល)">
    <template slot="actions">
        <change-time-duration-dropdown />
    </template>
    <div id="chart">
        <apexchart type="bar" height="380" :options="chartOptions" :series="series"></apexchart>
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
          series: [{
            // data: [222, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
            data: []
          }],
          chartOptions: {
            chart: {
              type: 'bar',
              height: 380
            },
            plotOptions: {
              bar: {
                barHeight: '100%',
                distributed: true,
                horizontal: true,
                dataLabels: {
                  position: 'bottom'
                },
              }
            },
            colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e','#f48024', '#69d2e7'
            ],
            dataLabels: {
              enabled: true,
              textAnchor: 'start',
              style: {
                colors: ['#fff']
              },
              formatter: function (val, opt) {
                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
              },
              offsetX: 0,
              dropShadow: {
                enabled: true
              }
            },
            stroke: {
              width: 1,
              colors: ['#fff']
            },
            xaxis: {
              categories: []
              // categories: ['MEF', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
              //   'United States', 'China', 'India'
              // ],
            },
            yaxis: {
              labels: {
                show: false
              },
              title: {
                text: undefined
              },
            },
            title: {
              text: 'Income By Entity',
              align: 'center',
              floating: true
            },
            subtitle: {
                text: '',
                align: 'center',
            },
            tooltip: {
              theme: 'dark',
              x: {
                show: false
              },
              y: {
                title: {
                  formatter: function () {
                    return '៛'
                  }
                }
              }
            }
          },
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
              let amount = response.data.amount
              let abbreviation = response.data.abbreviation
              let color = response.data.color
              let xaxis = {
                // categories: abbreviation
                categories: ['MEF', 'MoFAIC', 'CoA', 'SC', 'CoA', 'MoFAIC', 'MoH',
                  'SCoM', 'SN', 'MoWA'
                ]
              }
              this.series = [{
                // data: amount
                data: [1021402452, 1022412452, 1023422452, 1024432452, 1025442452, 1026452452, 1027462452, 1028472452, 1029482452, 1010492452]//amount
              }],
              
              this.chartOptions = {
                // colors: color,
                colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e','#f48024', '#69d2e7'],
                xaxis
              }
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
