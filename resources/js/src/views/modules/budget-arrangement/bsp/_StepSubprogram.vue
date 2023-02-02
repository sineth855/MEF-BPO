<template>
    <div class="flex items-center">
        <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" :allowDel="true" :title="title"
            :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :dataTables="data" :formAttributes="formAttributes"
            :rowDisplay="rowDisplay" @emitDataForm="initDataForm"></d-table-list>
            
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
        <!-- ###################### -->
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
                title: "bsp_heading_subpro_res_entity",
                api: apiConfig._apiObjective,
                dataAttributes: {
                    tableStyle: 4,
                    page_number: 1,
                    offset: 0,
                    dataGrid: "row",
                    hasHeadingReport: true,
                    headingReport: "bsp_heading_subpro_res_entity",
                    actionButton: [
                        {
                            icon: "DollarSignIcon",
                            path: "/module/budget-arrangement/budget-ceiling/list",
                            method: "View"
                        }
                    ]
                },
                dataHeaders: {
                    header1: {
                        width: 200,
                        label: "bsp_title_objective",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header2: {
                        width: 350,
                        label: "bsp_title_pro_subpro_title",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header3: {
                        label: "bsp_manager",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header4: {
                        label: "bsp_res_entity",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header8: {
                        label: "action",
                        rowspan: 0,
                        colspan: 0,
                    }
                },
                data: {
                    data: [
                        {
                            id: 1,
                            name: "គោលបំណងគោលនយោបាយទី ១",
                            name_kh: "គោលបំណងគោលនយោបាយទី ១",
                            remark: "",
                            status: 1,
                            hasColspan: true,
                            colspan: 5,
                            rowspan: 0,
                            order_level: "",
                            indicators: [
                                {
                                    id: 1,
                                    code: "",
                                    indicator: "",
                                    indicator_kh: "",
                                    status: "active"
                                }
                            ],
                            children: [
                                {
                                    id: 1,
                                    name: "កម្មវិធីទី១ : ការគ្រប់គ្រងវិស័យសេដ្ឋកិច្ច",
                                    name_kh: "កម្មវិធីទី១ : ការគ្រប់គ្រងវិស័យសេដ្ឋកិច្ច",
                                    responsible_entity: { id: 1, name: "ឈ្មោះអង្គភាពទទួលបន្ទុក", name_kh: "ឈ្មោះអង្គភាពទទួលបន្ទុក" },
                                    responsible_person: { id: 1, name: "បុគ្គលទទួលបន្ទុក", name: "បុគ្គលទទួលបន្ទុក" },
                                    order_level: 1,
                                    indicators: [
                                        {
                                            id: 1,
                                            code: "",
                                            indicator: "",
                                            indicator_kh: "",
                                            status: "active"
                                        }
                                    ],
                                    children: [
                                        {
                                            id: 1,
                                            name: "១.១. អនុកម្មវិធីទី១.១ : ការគ្រប់គ្រងគោលនយោបាយសេដ្ឋកិច្ច ហិរញ្ញវត្ថុ និងគោលនយោបាយតាមវិស័យផ្សេងៗ",
                                            name_kh: "១.១. អនុកម្មវិធីទី១.១ : ការគ្រប់គ្រងគោលនយោបាយសេដ្ឋកិច្ច ហិរញ្ញវត្ថុ និងគោលនយោបាយតាមវិស័យផ្សេងៗ",
                                            responsible_entity: { id: 1, name: "ឈ្មោះអង្គភាពទទួលបន្ទុក", name_kh: "ឈ្មោះអង្គភាពទទួលបន្ទុក" },
                                            responsible_person: { id: 1, name: "បុគ្គលទទួលបន្ទុក", name: "បុគ្គលទទួលបន្ទុក" },
                                            order_level: 1,
                                            indicators: [
                                                {
                                                    id: 1,
                                                    code: "",
                                                    indicator: "",
                                                    indicator_kh: "",
                                                    status: "active"
                                                }
                                            ],
                                            children: [
                                                {
                                                    id: 1,
                                                    name: "១.១.១. ចង្កោមសកម្មភាពទី១ : គាំទ្រ សម្របសម្រួល និងគ្រប់គ្រងការងាររដ្ឋបាលរបស់អគ្គនាយកដ្ឋាន",
                                                    name_kh: "១.១.១. ចង្កោមសកម្មភាពទី១ : គាំទ្រ សម្របសម្រួល និងគ្រប់គ្រងការងាររដ្ឋបាលរបស់អគ្គនាយកដ្ឋាន",
                                                    responsible_entity: { id: 1, name: "ឈ្មោះអង្គភាពទទួលបន្ទុក", name_kh: "ឈ្មោះអង្គភាពទទួលបន្ទុក" },
                                                    responsible_person: { id: 1, name: "បុគ្គលទទួលបន្ទុក", name: "បុគ្គលទទួលបន្ទុក" },
                                                    order_level: 1,
                                                    indicators: [
                                                        {
                                                            id: 1,
                                                            code: "",
                                                            indicator: "",
                                                            indicator_kh: "",
                                                            status: "active"
                                                        }
                                                    ],
                                                    children: [
                                                        {
                                                            id: 1,
                                                            name: "១.១.១.១. សកម្មភាពទី១ : បំពេញមុខជាលេខាធិការដ្ឋាន",
                                                            name_kh: "១.១.១.១. សកម្មភាពទី១ : បំពេញមុខជាលេខាធិការដ្ឋាន",
                                                            responsible_entity: { id: 1, name: "ឈ្មោះអង្គភាពទទួលបន្ទុក", name_kh: "ឈ្មោះអង្គភាពទទួលបន្ទុក" },
                                                            responsible_person: { id: 1, name: "បុគ្គលទទួលបន្ទុក", name: "បុគ្គលទទួលបន្ទុក" },
                                                            order_level: 1,
                                                            indicators: [
                                                                {
                                                                    id: 1,
                                                                    code: "",
                                                                    indicator: "",
                                                                    indicator_kh: "",
                                                                    status: "active"
                                                                }
                                                            ],
                                                        }
                                                    ]
                                                }
                                            ]
                                        }
                                    ]
                                }
                            ]
                        }
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
            initDataForm() {
                alert("testing");
            },
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