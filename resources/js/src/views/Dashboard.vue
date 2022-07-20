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
        <div style="float: left">
            <b>អត្រាប្តូរប្រាក់ៈ 1$ = 4,000 រៀល</b>
        </div>
        <div style="float: right">
            <vs-dropdown vs-trigger-click class="dd-actions cursor-pointer mr-6 mb-6" style="width: 150px">

                <div class="p-1 shadow-drop rounded-lg d-theme-dark-bg cursor-pointer flex items-center justify-center text-lg font-medium w-32 w-full">
                    <span class="mr-2">{{filterOption}}</span>
                    <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
                </div>

                <vs-dropdown-menu style="width: 200px">

                    <vs-dropdown-item @click="onSelectFilter(2021, 'This Year')">
                        <span class="flex items-center">
                            <feather-icon icon="ClockIcon" svgClasses="h-4 w-4" class="mr-2" />
                            <span>This Year</span>
                        </span>
                    </vs-dropdown-item>

                    <vs-dropdown-item @click="onSelectFilter(2020, 'Last Year')">
                        <span class="flex items-center">
                            <feather-icon icon="ClockIcon" svgClasses="h-4 w-4" class="mr-2" />
                            <span>Last Year</span>
                        </span>
                    </vs-dropdown-item>

                </vs-dropdown-menu>
            </vs-dropdown>
        </div>
        <div class="clearfix"></div>
        <!-- SLOT = ACTIONS -->
        <div class="vx-row">
            
            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <summary-data color="success" :flag="1" :chartOptions="chartOptionOfficers" :chartData="serieOfficers" :totalDollar="''" :statistic="summaryInfo.totalOfficer" statisticTitle="ចំនួនមន្ត្រីជាមធ្យមប្រចាំឆ្នាំ" :resultTitle="summaryInfo.currentDateOfficer" icon="UsersIcon" type='line'></summary-data>
                <!-- <statistics-card-line
                  v-if="subscribersGained.analyticsData"
                  icon="UsersIcon"
                  :statistic="subscribersGained.analyticsData.subscribers | k_formatter"
                  statisticTitle="ចំនួនសរុបមន្ត្រីបើកប្រាក់ឧបត្ថម្ភ"
                  :chartData="subscribersGained.series"
                  type='area' /> -->
            </div>

            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <summary-data color="primary" :flag="2" :chartOptions="chartOptionIncomes" :chartData="incomeCompareSeries" :totalDollar="summaryInfo.totalIncomeDollar" :statistic="summaryInfo.totalIncome" statisticTitle="ចំណូលសរុប(គិតជាលានរៀល)" :resultTitle="summaryInfo.lastUpdatedDateIncome" icon="ArrowDownIcon" type='area'></summary-data>
                <!-- <statistics-card-line
                  v-if="revenueGenerated.analyticsData"
                  icon="DollarSignIcon"
                  :statistic="revenueGenerated.analyticsData.revenue | k_formatter"
                  statisticTitle="ចំនូលសរុប(គិតជាលានរៀល)"
                  :chartData="revenueGenerated.series"
                  color='success'
                  type='area' /> -->
            </div>

            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <summary-data color="danger" :flag="3" :chartOptions="chartOptionExpenses" :chartData="expenseCompareSeries" :totalDollar="summaryInfo.totalExpenseDollar" :statistic="summaryInfo.totalExpense" statisticTitle="ចំណាយសរុប(គិតជាលានរៀល)" :resultTitle="summaryInfo.lastUpdatedDateExp" icon="ArrowUpIcon" type='area'></summary-data>
                <!-- <statistics-card-line
                  v-if="ordersRecevied.analyticsData"
                  icon="ShoppingBagIcon"
                  :statistic="ordersRecevied.analyticsData.orders | k_formatter"
                  statisticTitle="ចំណាយសរុប(គិតជាលានរៀល)"
                  :chartData="ordersRecevied.series"
                  color='danger'
                  type='area' /> -->
            </div>

            <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base">
                <summary-data color="warning" :flag="4" :chartOptions="chartOptionRemains" :chartData="remainCompareSeries" :totalDollar="summaryInfo.totalRemainDollar" :statistic="summaryInfo.totalRemain" statisticTitle="សន្និធិសាច់ប្រាក់សរុប(គិតជាលានរៀល)" :resultTitle="issueDateOfficer" icon="BarChart2Icon" type='area'></summary-data>
                <!-- <statistics-card-line
                  v-if="ordersRecevied.analyticsData"
                  icon="ShoppingBagIcon"
                  :statistic="ordersRecevied.analyticsData.orders | k_formatter"
                  statisticTitle="សន្និធិសាច់ប្រាក់សរុប(គិតជាលានរៀល)"
                  :chartData="ordersRecevied.series"
                  color='warning'
                  type='area' /> -->
            </div>
        </div>

        <!-- <div class="vx-row">
            <div class="vx-col w-full md:w-1/1 mb-base">
                <income-entity></income-entity>
            </div>
        </div> -->

        <div class="vx-row">

            <!-- LINE CHART -->
            <!-- <div class="vx-col w-full md:w-1/2 mb-base">
                <income-quarter></income-quarter>
            </div> -->

            <!-- LINE CHART -->
            <!-- <div class="vx-col w-full md:w-1/2 mb-base">
                <outcome-quarter></outcome-quarter>
            </div> -->

            <!-- LINE CHART -->
            <div class="vx-col w-full md:w-2/3 mb-base">
                <total-income-outcome-quarter :summaryInfo="summaryInOutQuarter" :series="serieInOutQuarters"></total-income-outcome-quarter>
            </div>

            <!-- RADIAL CHART -->
            <div class="vx-col w-full md:w-1/3 mb-base" style="_display: none;">
                <vx-card title="សមិទ្ធិកម្ម​">
                    
                    <!-- <template slot="actions">
                        <feather-icon icon="HelpCircleIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
                    </template> -->
                    <!-- SLOT = ACTIONS -->
                    <!-- <template slot="actions">
                        <change-time-duration-dropdown />
                    </template> -->

                    <!-- CHART -->
                    <template slot="no-body">
                        <div class="mt-10">
                            <vue-apex-charts type=radialBar height=240 :options="analyticsData.goalOverviewRadialBar.chartOptions" :series="goalOverview.series" />
                        </div>
                    </template>

                    <!-- DATA -->
                    <div><center>ផែនការសកម្មភាពលម្អិត (MAP3)</center></div>
                    <div class="flex justify-between text-center mt-6" slot="no-body-bottom">
                        <div class="w-1/2 border border-solid d-theme-border-grey-light border-r-0 border-b-0 border-l-0">
                            <p class="mt-4">បានបញ្ចប់</p>
                            <p class="mb-4 text-3xl font-semibold">១០០</p>
                        </div>
                        <div class="w-1/2 border border-solid d-theme-border-grey-light border-r-0 border-b-0">
                            <p class="mt-4">វឌ្ឍនភាព</p>
                            <p class="mb-4 text-3xl font-semibold">៣០</p>
                        </div>
                    </div>
                </vx-card>
            </div>
        </div>
        
        <!-- <div class="vx-row">
            <summary-quarter></summary-quarter>
        </div><br/><br/> -->

        <div class="vx-row" style="_display: none;">
            <div class="vx-col w-full md:w-1/2 mb-base">
                <income-sector :year="currentYear"></income-sector>
                <!-- <vx-card title="ចំណូលតាមវិស័យធៀបជា%"> -->
                    <!-- <template slot="actions">
                        <change-time-duration-dropdown />
                    </template>
                    <div v-for="(browser, index) in browserStatistics" :key="browser.id" :class="{'mt-4': index}">
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
                    </div> -->
                    <!-- <div id="chart">
                        <apexchart type="bar" height="380" :options="chartOptions" :series="series"></apexchart>
                    </div> -->
                <!-- </vx-card> -->
            </div>

            <div class="vx-col w-full md:w-1/2">
                <expense-sector></expense-sector>
                <!-- <incentive-tax-monthly></incentive-tax-monthly> -->
                <!-- <vx-card title="% ប្រាក់បើកផ្តល់ និងប្រាក់ពន្ធប្រចាំខែ">
                    <template slot="actions">
                        <change-time-duration-dropdown />
                    </template>
                    <div class="flex">
                        <span class="flex items-center"><div class="h-3 w-3 rounded-full mr-1 bg-primary"></div><span>ប្រាក់បើកផ្តល់</span></span>
                        <span class="flex items-center ml-4"><div class="h-3 w-3 rounded-full mr-1 bg-danger"></div><span>ប្រាក់ពន្ធ</span></span>
                    </div>
                    <vue-apex-charts type=bar height=277 :options="analyticsData.clientRetentionBar.chartOptions" :series="clientRetentionBar.series" />
                </vx-card> -->
            </div>

        </div>
        <br>
        <div class="vx-row">
            <!-- CUSTOMERS CHART -->
            <!-- <div class="vx-col w-full lg:w-1/2 lg:mt-0 mt-base">
                <top-entity></top-entity>
            </div> -->
            <!-- Sessions By Device -->
           

            <!-- CUSTOMERS CHART -->
            <div class="vx-col w-full lg:w-1/2 lg:mt-0 mt-base">
                <top-rank-income-entity></top-rank-income-entity>
                <!-- <vx-card title="ចំណាត់ថ្នាក់អង្គភាពទាំង១០">
                    <template slot="actions">
                        <change-time-duration-dropdown />
                    </template>

                    <div slot="no-body">
                        <vue-apex-charts type=pie height=345 class="mt-10 mb-10" :options="analyticsData.customersPie.chartOptions" :series="customersData.series" />
                        <ul class="mb-1">
                            <li v-for="customerData in customersData.analyticsData" :key="customerData.customerType" class="flex justify-between py-3 px-6 border d-theme-border-grey-light border-solid border-r-0 border-l-0 border-b-0">
                                <span class="flex items-center">
                                    <span class="inline-block h-3 w-3 rounded-full mr-2" :class="`bg-${customerData.color}`"></span>
                                    <span class="font-semibold">{{ customerData.customerType }}</span>
                                </span>
                                <span>{{ customerData.counts }}</span>
                            </li>
                        </ul>
                    </div>

                </vx-card> -->
            </div>

             <div class="vx-col w-full lg:w-1/2 lg:mt-0 mt-base">
                <top-rank-expense-entity></top-rank-expense-entity>
                <!-- <vx-card title="ស្ថិតិការចំណាយធៀបជា%">
                    <template slot="actions">
                        <change-time-duration-dropdown />
                    </template>

                    <div slot="no-body">
                        <vue-apex-charts class="mt-6 mb-8" type=donut height=325 :options="analyticsData.sessionsByDeviceDonut.chartOptions" :series="sessionsData.series" />
                    </div>

                    <ul class="mt-6">
                        <li v-for="deviceData in sessionsData.analyticsData" :key="deviceData.device" class="flex mb-3">
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
                </vx-card> -->
            </div>

            <!-- CHAT CARD -->
            <!-- <div class="vx-col w-full lg:w-1/3 lg:mt-0 mt-base">
                <vx-card title="ពិភាក្សា" class="overflow-hidden">
                    <template slot="no-body">
                        <div class="chat-card-log">
                            <VuePerfectScrollbar ref="chatLogPS" class="scroll-area pt-6 px-6" :settings="settings" :key="$vs.rtl">
                                <ul ref="chatLog">
                                    <li class="flex items-start" :class="{'flex-row-reverse': msg.isSent, 'mt-4': index}" v-for="(msg, index) in chatLog" :key="index">
                                        <vs-avatar size="40px" class="m-0 flex-shrink-0" :class="msg.isSent ? 'ml-5' : 'mr-5'" :src="msg.senderImg"></vs-avatar>
                                        <div class="msg relative bg-white shadow-md py-3 px-4 mb-2 rounded-lg max-w-md" :class="{'chat-sent-msg bg-primary-gradient text-white': msg.isSent, 'border border-solid d-theme-border-grey-light': !msg.isSent}">
                                            <span>{{ msg.msg }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </VuePerfectScrollbar>
                        </div>
                        <div class="flex bg-white chat-input-container p-6">
                            <vs-input class="mr-3 w-full" v-model="chatMsgInput" @keyup.enter="chatMsgInput = ''" placeholder="Type Your Message" ></vs-input>
                            <vs-button icon-pack="feather" icon="icon-send" @click="chatMsgInput = ''"></vs-button>
                        </div>
                    </template>
                </vx-card>
            </div> -->
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
