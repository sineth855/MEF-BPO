<template>
    <div>
        <div class="flex justify-between flex-wrap mb-4">
            <vs-button class="mt-4 mr-2 shadow-lg" type="gradient" color="#7367F0" gradient-color-secondary="#CE9FFC">{{$t("Download")}}</vs-button>
            <vs-checkbox color="success">បានត្រួតពិនិត្យ</vs-checkbox>
            <vs-button class="mt-4" type="border" color="#30c974"><feather-icon icon="PlusIcon" svgClasses="h-4 w-4" /> {{$t("AddNew")}}</vs-button>
            </div>
            
            <div class="flex items-center">
            <!-- ###################### -->
            <div>
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
                        តារាង១ៈ អនុកម្មវិធី អ្នកគ្រប់គ្រង និងអង្គភាពទទួលខុសត្រូវ
                        </span>
                        <div class="clearfix"></div>
                        <br/>
                    </center>
                </div>
                <div class="clearfix"></div>

                <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" :allowDel="true" :title="title"
                    :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :dataTables="data" :formAttributes="formAttributes"
                    :rowDisplay="rowDisplay"></d-table-list>
                    
                <!-- <vs-table :data="[]">

                    <template slot="thead">
                        <vs-th>ឈ្មោះគោលបំណងគោលនយោបាយ</vs-th>
                        <vs-th>ឈ្មោះកម្មវិធី និងអនុកម្មវិធី</vs-th>
                        <vs-th>អ្នកគ្រប់គ្រង</vs-th>
                        <vs-th>អ្នកទទួលខុសត្រូវ</vs-th>
                    </template>

                    <template>
                        
                        <vs-tr style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                            <vs-td>គោលបំណងគោលនយោបាយទី១</vs-td>
                            <vs-td>កម្មវិធីទី១ៈ ការគ្រប់គ្រងវិស័យសេដ្ឋកិច្ច</vs-td>
                            <vs-td>ឯកឧត្តម/លោកជំទាវ</vs-td>
                            <vs-td></vs-td>
                        </vs-tr>
                        
                        <vs-tr :state="'warning'">
                            <vs-td></vs-td>
                            <vs-td>១.១. អនុកម្មវិធីទី១.១ : ការគ្រប់គ្រងគោលនយោបាយសេដ្ឋកិច្ច ហិរញ្ញវត្ថុ និងគោលនយោបាយតាមវិស័យផ្សេងៗ</vs-td>
                            <vs-td>ឯកឧត្តម/លោកជំទាវ</vs-td>
                            <vs-td>អគ្គនាយកដ្ឋានគោលនយោបាយ</vs-td>
                        </vs-tr>

                        <vs-tr :state="'success'">
                            <vs-td></vs-td>
                            <vs-td>១.១.‌១.ចង្កោមសកម្មភាពទី១ៈ គាំទ្រសម្របសម្រួល និងគ្រប់គ្រងការងាររដ្ឋបាលរបស់នាយកដ្ឋាន</vs-td>
                            <vs-td>លោក/លោកស្រី</vs-td>
                            <vs-td>ការរិយាល័យ</vs-td>
                        </vs-tr>

                        <vs-tr>
                            <vs-td></vs-td>
                            <vs-td style="text-indent: 30px;">១.១.‌១.១.សកម្មភាពទី១ៈ បំពេញមុខងារជាលេខាធិការដ្ឋនា</vs-td>
                            <vs-td>លោក/លោកស្រី</vs-td>
                            <vs-td>ការរិយាល័យ</vs-td>
                        </vs-tr>

                        <vs-tr :state="'success'">
                            <vs-td></vs-td>
                            <vs-td>១.១.២. ចង្កោមសកម្មភាពទី២ : រៀបចំ កែលម្អ ត្រួតពិនិត្យ និងវាយតម្លៃគោលនយោបាយម៉ាក្រូសេដ្ឋកិច្ច និងសារពើពន្ធ</vs-td>
                            <vs-td>លោក/លោកស្រី</vs-td>
                            <vs-td>ការរិយាល័យ</vs-td>
                        </vs-tr>

                        <vs-tr>
                            <vs-td></vs-td>
                            <vs-td style="text-indent: 30px;">១.១.‌១.១.សកម្មភាពទី១ៈ បំពេញមុខងារជាលេខាធិការដ្ឋនា</vs-td>
                            <vs-td>លោក/លោកស្រី</vs-td>
                            <vs-td>ការរិយាល័យ</vs-td>
                        </vs-tr>
                    </template>
                </vs-table> -->
            </div>
            <!-- ###################### -->
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"
import apiConfig from "@/apiConfig.js"
import { ref } from 'vue';

import DTableList from '@/views/form-builder/DTableList.vue'

export default {
    data() {
        return {
            title: "ProgramObjective",
            api: apiConfig._apiObjective,
            dataAttributes: {
                tableStyle: 1,
                page_number: 1,
                offset: 0,
                dataGrid: "row",
                actionButton: [
                    {
                        icon: "DollarSignIcon",
                        path: "/module/budget-arrangement/budget-ceiling/list",
                        method: "View"
                    },
                    // {
                    //     icon: "EditIcon",
                    //     path: "#",
                    //     method: "Edit"
                    // },
                    // {
                    //     icon: "TrashIcon",
                    //     path: "#",
                    //     method: "Edit"
                    // },
                ]
            },
            dataHeaders: {
                // header1: "id",
                header1: "title",
                header2: "title_kh",
                header3: "ceiling_year",
                header4: "progress",
                header5: "status",
                header6: "order_level",
            },
            data: {
                data: [
                    {
                        id: 1,
                        title: "ពិដានប្រចាំឆ្នាំ២០១៩",
                        title_kh: "ពិដានប្រចាំឆ្នាំ២០១៩",
                        ceiling_year: "2022",
                        progress: "100",
                        status: "completed",
                        order_level: 1
                    },
                    {
                        id: 2,
                        title: "ពិដានប្រចាំឆ្នាំ២០២០",
                        title_kh: "ពិដានប្រចាំឆ្នាំ២០២០",
                        ceiling_year: "2022",
                        progress: "100",
                        status: "completed",
                        order_level: 1
                    },
                    {
                        id: 3,
                        title: "ពិដានប្រចាំឆ្នាំ២០២១",
                        title_kh: "ពិដានប្រចាំឆ្នាំ២០២១",
                        ceiling_year: "2022",
                        progress: "100",
                        status: "completed",
                        order_level: 1
                    },
                ],
                limit: 10,
                total: 3,
            },
            formAttributes: [
                {
                    name: "title",
                    type: "text",
                    required: true
                },
                {
                    name: "title_kh",
                    type: "text",
                    required: true
                },
                {
                    name: "ceiling_year",
                    type: "select",
                    required: true,
                    data: [
                        {
                            "id": 1,
                            "name": "គោលបំណងទី១",
                            "name_kh": ""
                        },
                        {
                            "id": 2,
                            "name": "គោលបំណងទី២",
                            "name_kh": ""
                        }
                    ],
                },
                {
                    name: "status",
                    type: "select",
                    required: true,
                    data: [
                        {
                            "id": 1,
                            "name": "In Progress",
                            "name_kh": "កំពុងដំណើរការ"
                        },
                        {
                            "id": 2,
                            "name": "Complete",
                            "name_kh": "បញ្ចប់"
                        }
                    ],
                },

            ],
            rowDisplay: "2grid", //1grid, 2grid, 3grid, 4grid
            dataFields: []
        }
    },
    components: {
        DTableList,
    },
    methods: {
        getDataTable(_search_criteria) {
            let _params = {};
            if (_search_criteria.search_field) {
                let _formAttribute = this.formAttributes;
                this.dataFields = [];
                this.formAttributes.forEach(_formAttribute => {
                    if (_search_criteria.search_field[_formAttribute["name"]]) {
                        let _d = {
                            [_formAttribute["name"]]: _search_criteria.search_field[_formAttribute["name"]]
                        }
                        this.dataFields.push(_d);
                    }

                });
                _params = {
                    sort: _search_criteria.sort,
                    order: _search_criteria.order,
                    page_number: _search_criteria.page_number,
                    search_field: this.dataFields,
                };
            } else {
                _params = {
                    sort: _search_criteria.sort,
                    order: _search_criteria.order,
                    page_number: _search_criteria.page_number,
                };
            }

            return new Promise((resolve, reject) => {
                axios.post(this.api + "/search", _params)
                    .then((response) => {
                        // this.data = response.data;
                        this.data = this.data;
                        this.$vs.loading.close();
                    }).catch((error) => {
                        // reject(error)
                        this.$vs.loading.close();
                    })
            })
        },
        getData() {
            let _search_criteria = {
                sort: "id",
                order: "",
                page_number: this.dataAttributes.page_number
            }
            this.getDataTable(_search_criteria);
        },
        initTableData(searchQuery) {
            this.$vs.loading();
            let _search_criteria = {
                sort: "id",
                order: "",
                page_number: searchQuery.pageNum,
                search_field: searchQuery.searchFields
            }
            this.getDataTable(_search_criteria);
            return false;
        }

    },
    created() {
        this.$vs.loading();
        this.getData();
    },
    watch: {
    }
}
</script>