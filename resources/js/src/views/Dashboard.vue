<!-- =========================================================================================
    File Name: DashboardEcommerce.vue
    Description: Dashboard - Ecommerce
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->
<template>
    <div class="main-dashboard">
        <!-- <div style="float: left">
            <b>អត្រាប្តូរប្រាក់ៈ 1$ = 4,000 រៀល</b>
        </div> -->
        <!-- <div style="float: right">
            <vs-dropdown vs-trigger-click class="dd-actions cursor-pointer mr-6 mb-6" style="width: 150px">

                <div class="p-1 shadow-drop rounded-lg d-theme-dark-bg cursor-pointer flex items-center justify-center text-lg font-medium w-32 w-full">
                    <span class="mr-2">{{filterOption}}</span>
                    <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
                </div>

                <vs-dropdown-menu style="width: 200px">

                    <vs-dropdown-item @click="onSelectFilter(2021, 'This Year')">
                        <span class="flex items-center">
                            <feather-icon icon="ClockIcon" svgClasses="h-4 w-4" class="mr-2" />
                            <span>ឆ្នាំនេះ</span>
                        </span>
                    </vs-dropdown-item>

                    <vs-dropdown-item @click="onSelectFilter(2020, 'Last Year')">
                        <span class="flex items-center">
                            <feather-icon icon="ClockIcon" svgClasses="h-4 w-4" class="mr-2" />
                            <span>ឆ្នាំមុន</span>
                        </span>
                    </vs-dropdown-item>

                </vs-dropdown-menu>
            </vs-dropdown>
        </div>
        <div class="clearfix"></div> -->

        <!-- ROW 1-->
        <div class="vx-row">
            <div class="vx-col w-1/2 md:w-1/3 xl:w-1/4 mb-6" style="line-height: 40px;font-size: 14px;">
                <vx-card class="overflow-hidden">
                    <div class="main-dashboard" slot="no-body">
                        <div class="p-6" :class="{
                        'flex justify-between flex-row-reverse items-center': iconRight,
                        'text-center': !iconRight && hideChart,
                        'pb-0': !hideChart
                        }">
                            <div class="truncate">
                                <h3 class="mb-1 font-bold"><feather-icon icon="DollarSignIcon" class="p-3 inline-flex rounded-full" :class="[`text-${color}`, {'mb-4': !iconRight}]" :style="{background: `rgba(var(--vs-${color}),.15)`}"></feather-icon> {{statistic}}</h3>
                                <h5>ថវិកាសរុប</h5>
                                <div v-if="totalDollar != ''" class="mb-1"><b>323</b> លានដុល្លា</div>
                                <div v-else class="mb-1"><b>323<br/></b></div>
                            </div>
                        </div>
                    </div>
                </vx-card>
            </div>

            <div class="vx-col w-1/2 md:w-1/3 xl:w-1/4 mb-6" style="line-height: 40px;font-size: 14px;">
                <vx-card class="overflow-hidden">
                    <div class="main-dashboard" slot="no-body">
                        <div class="p-6" :class="{
                        'flex justify-between flex-row-reverse items-center': iconRight,
                        'text-center': !iconRight && hideChart,
                        'pb-0': !hideChart
                        }">
                            <div class="truncate">
                                <h3 class="mb-1 font-bold"><feather-icon icon="UsersIcon" class="p-3 inline-flex rounded-full" :class="[`text-${color}`, {'mb-4': !iconRight}]" :style="{background: `rgba(var(--vs-${color}),.15)`}"></feather-icon> {{statistic}}</h3>
                                <h5>អង្គភាពថវិកាសរុប</h5>
                                <div v-if="totalDollar != ''" class="mb-1"><b>88</b></div>
                                <div v-else class="mb-1"><b>88<br/></b></div>
                            </div>
                        </div>
                    </div>
                </vx-card>
            </div>

            <div class="vx-col w-1/2 md:w-1/3 xl:w-1/4 mb-6" style="line-height: 40px;font-size: 14px;">
                <vx-card class="overflow-hidden">
                    <div class="main-dashboard" slot="no-body">
                        <div class="p-6" :class="{
                        'flex justify-between flex-row-reverse items-center': iconRight,
                        'text-center': !iconRight && hideChart,
                        'pb-0': !hideChart
                        }">
                            <div class="truncate">
                                <h3 class="mb-1 font-bold"><feather-icon icon="FileIcon" class="p-3 inline-flex rounded-full" :class="[`text-${color}`, {'mb-4': !iconRight}]" :style="{background: `rgba(var(--vs-${color}),.15)`}"></feather-icon> {{statistic}}</h3>
                                <h5>ឯកសារសរុប</h5>
                                <div v-if="totalDollar != ''" class="mb-1"><b>1,323</b></div>
                                <div v-else class="mb-1"><b>323<br/></b></div>
                            </div>
                        </div>
                    </div>
                </vx-card>
            </div>

            <div class="vx-col w-1/2 md:w-1/3 xl:w-1/4 mb-6" style="line-height: 40px;font-size: 14px;">
                <vx-card class="overflow-hidden">
                    <div class="main-dashboard" slot="no-body">
                        <div class="p-6" :class="{
                        'flex justify-between flex-row-reverse items-center': iconRight,
                        'text-center': !iconRight && hideChart,
                        'pb-0': !hideChart
                        }">
                            <div class="truncate">
                                <h3 class="mb-1 font-bold"><feather-icon icon="FileIcon" class="p-3 inline-flex rounded-full" :class="[`text-${color}`, {'mb-4': !iconRight}]" :style="{background: `rgba(var(--vs-${color}),.15)`}"></feather-icon> {{statistic}}</h3>
                                <h5>មាតិការកម្មវិធី</h5>
                                <div v-if="totalDollar != ''" class="mb-1"><b>កម្មវិធីសរុប</b> 3</div>
                                <div v-else class="mb-1"><b>323<br/></b></div>
                            </div>
                        </div>
                    </div>
                </vx-card>
            </div>
        </div>

        <!-- SLOT = ACTIONS -->
        <div class="vx-row">
            
            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <summary-data color="success" :flag="1" :chartOptions="chartOptionOfficers" :chartData="serieOfficers" :totalDollar="''" :statistic="summaryInfo.totalOfficer" statisticTitle="ចំនួនមន្ត្រីជាមធ្យមប្រចាំឆ្នាំ" :resultTitle="summaryInfo.currentDateOfficer" icon="UsersIcon" type='line'></summary-data>
            </div>

            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <summary-data color="primary" :flag="2" :chartOptions="chartOptionIncomes" :chartData="incomeCompareSeries" :totalDollar="summaryInfo.totalIncomeDollar" :statistic="summaryInfo.totalIncome" statisticTitle="ចំណូលសរុប(គិតជាលានរៀល)" :resultTitle="summaryInfo.lastUpdatedDateIncome" icon="ArrowDownIcon" type='area'></summary-data>
            </div>

            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <summary-data color="danger" :flag="3" :chartOptions="chartOptionExpenses" :chartData="expenseCompareSeries" :totalDollar="summaryInfo.totalExpenseDollar" :statistic="summaryInfo.totalExpense" statisticTitle="ចំណាយសរុប(គិតជាលានរៀល)" :resultTitle="summaryInfo.lastUpdatedDateExp" icon="ArrowUpIcon" type='area'></summary-data>
            </div>

            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <summary-data color="warning" :flag="4" :chartOptions="chartOptionRemains" :chartData="remainCompareSeries" :totalDollar="summaryInfo.totalRemainDollar" :statistic="summaryInfo.totalRemain" statisticTitle="សន្និធិសាច់ប្រាក់សរុប(គិតជាលានរៀល)" :resultTitle="issueDateOfficer" icon="BarChart2Icon" type='area'></summary-data>
            </div>
        </div>
        
        <div class="vx-col w-full sm:w-1/1 md:w-1/1 lg:w-1/1 xl:w-1/1 mb-base">
            <div class="vx-col w-full">
                <echarts-bar-chart></echarts-bar-chart>
            </div>
        </div>
        <div class="vx-col w-full">
            <echarts-line-chart></echarts-line-chart>
        </div>
        
    </div>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import VueApexCharts from 'vue-apexcharts'
import StatisticsCardLine from '@/components/statistics-cards/StatisticsCardLine.vue'
import analyticsData from './ui-elements/card/analyticsData.js'
import ChangeTimeDurationDropdown from '@/components/ChangeTimeDurationDropdown.vue'
import IncomeSector from '@/views/charts-and-maps/charts/IncomeSector.vue'
import ExpenseSector from '@/views/charts-and-maps/charts/ExpenseSector.vue'
import IncomeQuarter from '@/views/charts-and-maps/charts/IncomeQuarter.vue'
import OutcomeQuarter from '@/views/charts-and-maps/charts/OutcomeQuarter.vue'
import TopEntity from '@/views/charts-and-maps/charts/TopEntity.vue'
import SummaryQuarter from '@/views/charts-and-maps/charts/SummaryQuarter.vue'
import StatisticPercentage from '@/views/charts-and-maps/charts/StatisticPercentage.vue'
import SummaryData from '@/views/charts-and-maps/charts/SummaryData.vue'
import TotalIncomeOutcomeQuarter from '@/views/charts-and-maps/charts/TotalIncomeOutcomeQuarter.vue'
import IncentiveTaxMonthly from '@/views/charts-and-maps/charts/IncentiveTaxMonthly.vue'
import TopRankIncomeEntity from '@/views/charts-and-maps/charts/TopRankIncomeEntity.vue'
import TopRankExpenseEntity from '@/views/charts-and-maps/charts/TopRankExpenseEntity.vue'

import EchartsBarChart from './EchartsBarChart.vue'
import EchartsLineChart from './EchartsLineChart.vue'
import EchartsPieChart from './EchartsPieChart.vue'
import EchartsPolarChart from './EchartsPolarChart.vue'
import EchartsScatterChart from './EchartsScatterChart.vue'
import EchartsRadarChart from './EchartsRadarChart.vue'

import router from '@/router'
import axios from "@/axios.js"
export default{
    data() {
        return {
            subscribersGained: {},
            revenueGenerated: {},
            quarterlySales: {},
            ordersRecevied: {},
            
            officers: [],
            years: [],
            revenueComparisonLine: {},
            goalOverview: {},

            browserStatistics: [],
            clientRetentionBar: {},

            sessionsData: {},
            chatLog: [],
            chatMsgInput: '',
            customersData: {},

            analyticsData: analyticsData,
            settings: { // perfectscrollbar settings
                maxScrollbarLength: 60,
                wheelSpeed: .60,
            },
            totalData: 100000,
            serieOfficers: [
                // {
                //     name: 'Number of Officer',
                //     type: 'column',
                //     data: [340, 342, 353]
                // }
            ],
            series: [{
                name: [''],
                data: [0, 0, 0, 0]
            }],
            incomeCompareSeries: [
                {
                    name: ['This year'],
                    data: [0, 0, 0, 0]
                },
                // {
                //     name: ['Last Year'],
                //     data: [0, 0, 0, 0]
                // }
            ],
            expenseCompareSeries: [
                {
                    name: ['This year'],
                    data: [0, 0, 0, 0]
                },
                // {
                //     name: ['Last Year'],
                //     data: [0, 0, 0, 0]
                // }
            ],
            remainCompareSeries: [
                {
                    name: ['This year'],
                    data: [0, 0, 0, 0]
                },
                // {
                //     name: ['Last Year'],
                //     data: [0, 0, 0, 0]
                // }
            ],
            chartOptionOfficers: {},
            chartOptionIncomes: {
                chart: {
                    toolbar: { show: false },
                    dropShadow: {
                        enabled: true,
                        top: 5,
                        left: 0,
                        blur: 4,
                        opacity: 0.10,
                    },
                },
                stroke: {
                    curve: 'smooth',
                    dashArray: [0, 8],
                    width: [4, 2],
                },
                grid: {
                    borderColor: '#e7e7e7',
                },
                legend: {
                    show: false,
                },
                colors: ['#28C76F', '#999999'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        inverseColors: false,
                        // gradientToColors: ['#7367F0', '#b8c2cc'],
                        shadeIntensity: 1,
                        type: 'horizontal',
                        opacityFrom: 0.7,
                        opacityTo: 0.45,
                        // stops: [0, 100, 100, 100]
                    },
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            cssClass: 'text-grey fill-current',
                        }
                    },
                    axisTicks: {
                        show: false,
                    },
                    categories: ['Q1', 'Q2', 'Q3', 'Q4'],
                    axisBorder: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                },
                tooltip: {
                    x: { show: false }
                }
            },
            chartOptionExpenses: {
                chart: {
                    toolbar: { show: false },
                    dropShadow: {
                        enabled: true,
                        top: 5,
                        left: 0,
                        blur: 4,
                        opacity: 0.10,
                    },
                },
                stroke: {
                    curve: 'smooth',
                    dashArray: [0, 8],
                    width: [4, 2],
                },
                grid: {
                    borderColor: '#e7e7e7',
                },
                legend: {
                    show: false,
                },
                colors: ['#EA5455', '#999999'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        inverseColors: false,
                        // gradientToColors: ['#7367F0', '#b8c2cc'],
                        shadeIntensity: 1,
                        type: 'horizontal',
                        opacityFrom: 0.7,
                        opacityTo: 0.45,
                        // stops: [0, 100, 100, 100]
                    },
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            cssClass: 'text-grey fill-current',
                        }
                    },
                    axisTicks: {
                        show: false,
                    },
                    categories: ['Q1', 'Q2', 'Q3', 'Q4'],
                    axisBorder: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                },
                tooltip: {
                    x: { show: false }
                }
            },
            __chartOptionExpenses: {
                yaxis: {
                    show: false,
                },
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: true
                    },
                    dropShadow: {
                        enabled: false,
                        top: 5,
                        left: 0,
                        blur: 4,
                        opacity: 0.10,
                    },
                    toolbar: {
                        show: false,
                    },
                    sparkline: {
                        enabled: false
                    }
                },
                dataLabels: {
                enabled: false
                },
                stroke: {
                    width: 3,
                    curve: 'smooth'
                },
                title: {
                text: '',
                align: 'left'
                },
                colors: ['#EA5455'],
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0
                    },
                    // row: {
                    //     colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    //     opacity: 0.5
                    // },
                },
                xaxis: {
                    categories: ['Q1', 'Q2', 'Q3', 'Q4'],
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                tooltip: {
                    x: { show: false },
                    y: { show: false }
                },
            },
            __chartOptionRemains: {
                yaxis: {
                    show: false,
                },
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: true
                    },
                    dropShadow: {
                        enabled: false,
                        top: 5,
                        left: 0,
                        blur: 4,
                        opacity: 0.10,
                    },
                    toolbar: {
                        show: false,
                    },
                    sparkline: {
                        enabled: false
                    }
                },
                dataLabels: {
                enabled: false
                },
                stroke: {
                    width: 3,
                    curve: 'smooth'
                },
                title: {
                text: '',
                align: 'left'
                },
                colors: ['#FF9F43'],
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0
                    },
                    // row: {
                    //     colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    //     opacity: 0.5
                    // },
                },
                xaxis: {
                    categories: ['Q1', 'Q2', 'Q3', 'Q4'],
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                tooltip: {
                    x: { show: false },
                    y: { show: false }
                },
            },
            chartOptionRemains: {
                chart: {
                    toolbar: { show: false },
                    dropShadow: {
                        enabled: true,
                        top: 5,
                        left: 0,
                        blur: 4,
                        opacity: 0.10,
                    },
                },
                stroke: {
                    curve: 'smooth',
                    dashArray: [0, 8],
                    width: [4, 2],
                },
                grid: {
                    borderColor: '#e7e7e7',
                },
                legend: {
                    show: false,
                },
                colors: ['#FF9F43', '#999999'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        inverseColors: false,
                        // gradientToColors: ['#7367F0', '#b8c2cc'],
                        shadeIntensity: 1,
                        type: 'horizontal',
                        opacityFrom: 0.7,
                        opacityTo: 0.45,
                        // stops: [0, 100, 100, 100]
                    },
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 5
                    }
                },
                xaxis: {
                    labels: {
                        style: {
                            cssClass: 'text-grey fill-current',
                        }
                    },
                    axisTicks: {
                        show: false,
                    },
                    categories: ['Q1', 'Q2', 'Q3', 'Q4'],
                    axisBorder: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                },
                tooltip: {
                    x: { show: false }
                }
            },
            summaryInfo: {
                totalIncentive: ''
            },

            // Income Outcome Quarter
            serieInOutQuarters: [
                {
                    name: "ចំណូល",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                },
                {
                    name: "ចំណាយ",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }
            ],
            summaryInOutQuarter: {},
            // #End 
            issueDateOfficer: '',
            issueDateIncome: '',
            issueDateOutcome: '',
            issueDateRemain: '',
            filterOption: 'This Year',
            currentYear: new Date().getFullYear()
        }
    },
    components: {
        VueApexCharts,
        apexchart: VueApexCharts,
        StatisticsCardLine,
        VuePerfectScrollbar,
        ChangeTimeDurationDropdown,
        IncomeSector,
        ExpenseSector,
        OutcomeQuarter,
        IncomeQuarter,
        TopEntity,
        SummaryQuarter,
        StatisticPercentage,
        SummaryData,
        TotalIncomeOutcomeQuarter,
        IncentiveTaxMonthly,
        TopRankIncomeEntity,
        TopRankExpenseEntity,
        StatisticsCardLine,
        
        EchartsBarChart,
        EchartsLineChart,
        EchartsPieChart,
        EchartsPolarChart,
        EchartsScatterChart,
        EchartsRadarChart,
    },
    watch:{
        
    },
    mounted() {
        
        if(!localStorage.getItem("accessToken")){
            router.push(router.currentRoute.query.to || '/pages/login')
        }
        // this.$refs.chatLogPS.$el.scrollTop = this.$refs.chatLog.scrollHeight;
        this.wasSidebarOpen = this.$store.state.reduceButton
        this.$store.commit('TOGGLE_REDUCE_BUTTON', true)
    },
    beforeDestroy() {
        if (!this.wasSidebarOpen) this.$store.commit('TOGGLE_REDUCE_BUTTON', false)
    },
    methods: {
        getSummary(option){
            // this.resetForm();
            this.$vs.loading();
            return new Promise((resolve, reject) => {
                axios.get("api/v1/report/summary?filter=" + option)
                    .then((response) => {
                    let _data = response["data"]["data"];
                    this.summaryInfo = response["data"]["data"];
                    this.issueDateOfficer = 'គិតត្រឹមថ្ងៃទី ' + _data.currentDate + ' ខែ ' + _data.currentMonth + ' ឆ្នាំ ' + _data.currentYear;
                    this.incomeCompareSeries = [
                        {
                            name: ['This year'],
                            data: response["data"]["data"]["quaterThisYearIncome"]
                        },
                        {
                            name: ['Last Year'],
                            data: response["data"]["data"]["quaterLastYearIncome"]
                        }
                    ]

                    this.expenseCompareSeries = [
                        {
                            name: ['This year'],
                            data: response["data"]["data"]["quaterThisYearExpense"]
                        },
                        {
                            name: ['Last Year'],
                            data: response["data"]["data"]["quaterLastYearExpense"]
                        }
                    ]
                    this.remainCompareSeries = [
                        {
                            name: ['This year'],
                            data: response["data"]["data"]["remainAmountThisYear"]
                        },
                        {
                            name: ['Last Year'],
                            data: response["data"]["data"]["remainAmountLastYear"]
                        }
                    ]
                    
                    // Officer Records All Years
                    for(let j = 0; j < response["data"]["data"]["officerByYears"].length; j++){
                        const _num_officer = response["data"]["data"]["officerByYears"][j]["number_officer"];
                        const _year = response["data"]["data"]["officerByYears"][j]["year"];
                        this.officers.push(_num_officer);
                        this.years.push(_year);
                    }
                    this.serieOfficers = [
                        {
                            name: 'Number of Officer',
                            type: 'column',
                            data: this.officers
                        }
                    ]

                    this.chartOptionOfficers = {
                        chart: {
                            toolbar: { show: false },
                            height: 200,
                            type: 'line',
                            stacked: false
                        },
                        legend: {
                            show: false,
                        },
                        dataLabels: {
                            enabled: true
                        },
                        stroke: {
                            width: [1, 1, 4]
                        },
                        title: {
                            text: '',
                            align: 'left',
                            offsetX: 110
                        },
                        xaxis: {
                            categories: this.years,
                        },
                        yaxis: {
                            show: false,
                        },
                        tooltip: {
                            x: { show: false }
                        },
                        legend: {
                            horizontalAlign: 'left',
                            offsetX: 40
                        }
                    };

                    this.$vs.loading.close();
                    
                }).catch((error) => { 
                    reject(error) 
                })
            })
            
        },

        getIncomeOutcomeByQuarter(year){
          return new Promise((resolve, reject) => {
              axios.get("/api/v1/report/income_outcome_by_quarter?year=" + year)
                  .then((response) => {
                  this.summaryInOutQuarter = response["data"]["data"]
                  let dataIncome = response["data"]["data"]["dataIncome"]
                  let dataOutcome = response["data"]["data"]["dataOutcome"]
                  this.serieInOutQuarters = [
                    {
                        name: "ចំណូល",
                        data: dataIncome
                    },
                    {
                        name: "ចំណាយ",
                        data: dataOutcome
                    }
                  ]
              }).catch((error) => { reject(error) })
          })
        },
        
        onSelectFilter(val, label){
            this.serieOfficers = [];
            this.officers = [];
            this.filterOption = label;
            this.currentYear = val;
            this.getSummary(val);
            this.getIncomeOutcomeByQuarter(val);
            // this.$emit('send', 'bye');
            // this.$emit('clicked-show-detail', product);
        },
        resetForm(){
            this.incomeCompareSeries = [];
            this.expenseCompareSeries = [];
            this.remainCompareSeries = [];
            this.serieOfficers = [];
        }
    },
    created() {
        this.getSummary(this.currentYear);
        this.getIncomeOutcomeByQuarter(this.currentYear)

      // Subscribers gained - Statistics
      this.$http.get("/api/card/card-statistics/subscribers")
        .then((response) => { this.subscribersGained = response.data })
        .catch((error) => { console.log(error) })

      // Revenue Generated
      this.$http.get("/api/card/card-statistics/revenue")
        .then((response) => { this.revenueGenerated = response.data })
        .catch((error) => { console.log(error) })

      // Sales
      this.$http.get("/api/card/card-statistics/sales")
        .then((response) => { this.quarterlySales = response.data })
        .catch((error) => { console.log(error) })

      // Orders - Statistics
      this.$http.get("/api/card/card-statistics/orders")
        .then((response) => { this.ordersRecevied = response.data })
        .catch((error) => { console.log(error) })

      // Revenue Comparison
      this.$http.get("/api/card/card-analytics/revenue-comparison")
        .then((response) => { this.revenueComparisonLine = response.data })
        .catch((error) => { console.log(error) })

      // Goal Overview
      this.$http.get("/api/card/card-analytics/goal-overview")
        .then((response) => { this.goalOverview = response.data })
        .catch((error) => { console.log(error) })

      // Browser Analytics
      this.$http.get("/api/card/card-analytics/browser-analytics")
        .then((response) => { this.browserStatistics = response.data })
        .catch((error) => { console.log(error) })

      // Client Retention
      this.$http.get("/api/card/card-analytics/client-retention")
        .then((response) => { this.clientRetentionBar = response.data })
        .catch((error) => { console.log(error) })

      // Sessions By Device
      this.$http.get("/api/card/card-analytics/session-by-device")
        .then((response) => { this.sessionsData = response.data })
        .catch((error) => { console.log(error) })

      // Chat Log
      this.$http.get("/api/chat/demo-1/log")
        .then((response) => { this.chatLog = response.data })
        .catch((error) => { console.log(error) })

      // Customers
      this.$http.get("/api/card/card-analytics/customers")
        .then((response) => { this.customersData = response.data })
        .catch((error) => { console.log(error) })
    },
    
}
</script>

<style lang="scss">
    .main-dashboard{
        font-family: 'Khmer MEF2';
        font-size: 13px;
    }
    h4{
        font-size: 16px;
    }
    .chat-card-log {
        height: 400px;

        .chat-sent-msg {
            background-color: #f2f4f7 !important;
        }
    }
</style>
