<template>        
    <div class="flex">
        <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" :allowDel="true" :title="title"
            :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :dataTables="data"
            :formAttributes="formAttributes" :rowDisplay="rowDisplay" @emitDataForm="initDataForm"></d-table-list>
        
        <!-- <vs-table :data="[]">

            <template>
            
                <vs-tr>
                    <vs-td rowspan="2">ការគ្រោងចំណូល <br/> តាមប្រភេទចំណូល</vs-td>
                    <vs-td colspan="2">ច្បាប់ហិរញ្ញវត្ថុឆ្នាំ២០២២</vs-td>
                    <vs-td colspan="2">គ្រោងឆ្នាំ២០២៣</vs-td>
                    <vs-td colspan="2">គ្រោងឆ្នាំ២០២៤</vs-td>
                    <vs-td colspan="2">គ្រោងឆ្នាំ២០២៥</vs-td>
                </vs-tr>

                <vs-tr>
                    <vs-td>ថវិការដ្ឋ</vs-td>
                    <vs-td>ថវិកាដៃគូអភិវឌ្ឍន៍</vs-td>
                    
                    <vs-td>ថវិការដ្ឋ</vs-td>
                    <vs-td>ថវិកាដៃគូអភិវឌ្ឍន៍</vs-td>

                    <vs-td>ថវិការដ្ឋ</vs-td>
                    <vs-td>ថវិកាដៃគូអភិវឌ្ឍន៍</vs-td>

                    <vs-td>ថវិការដ្ឋ</vs-td>
                    <vs-td>ថវិកាដៃគូអភិវឌ្ឍន៍</vs-td>
                </vs-tr>

                <vs-tr :state="'warning'">
                    <vs-td><center>សរុបរួម</center></vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>

                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>

                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                </vs-tr>

                <vs-tr :state="'danger'">
                    <vs-td><center>១.ចំណូលពីប្រភពក្នុងស្រុក</center></vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>

                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>

                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                </vs-tr>

                <vs-tr>
                    <vs-td><center>ចំណូលសារពើពន្ធ</center></vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>

                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>

                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                </vs-tr>

                <vs-tr>
                    <vs-td><center>ចំណូលមិនមែនសារពើពន្ធ</center></vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>

                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>

                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                </vs-tr>
                
                <vs-tr>
                    <vs-td><center>ចំណូលមូលធនក្នុងស្រុក (កម្ចីបន្ត)</center></vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>

                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>

                    <vs-td>0.0</vs-td>
                    <vs-td>0.0</vs-td>
                </vs-tr>

            </template>
        </vs-table> -->

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
            title: "bsp_heading_revenue_plan",
            api: apiConfig._apiObjective,
            dataAttributes: {
                tableStyle: 3,
                page_number: 1,
                offset: 0,
                dataGrid: "row",
                hasHeadingReport: true,
                headingReport: "bsp_heading_revenue_plan",
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
                    width: 350,
                    label: "ការគ្រោងចំណូល តាមប្រភេទចំណូល",
                    rowspan: 2,
                    colspan: 0,
                },
                header2: {
                    label: "ច្បាប់ហិរញ្ញវត្ថុឆ្នាំ២០២២",
                    rowspan: 0,
                    colspan: 2,
                },
                header3: {
                    label: "គ្រោងឆ្នាំ២០២៣",
                    rowspan: 0,
                    colspan: 2,
                },
                header4: {
                    label: "គ្រោងឆ្នាំ២០២៤",
                    rowspan: 0,
                    colspan: 2,
                },
                header5: {
                    label: "គ្រោងឆ្នាំ២០២៥",
                    rowspan: 0,
                    colspan: 2,
                },
                header6: {
                    label: "Action",
                    rowspan: 2,
                    colspan: 0,
                },
            },
            data: {
                dataHeaders: {
                    header1: {
                        label: "ថវិការដ្ឋ",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header2: {
                        label: "ថវិកាដៃគូអភិវឌ្ឍន៍",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header3: {
                        label: "ថវិការដ្ឋ",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header4: {
                        label: "ថវិកាដៃគូអភិវឌ្ឍន៍",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header5: {
                        label: "ថវិការដ្ឋ",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header6: {
                        label: "ថវិកាដៃគូអភិវឌ្ឍន៍",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header7: {
                        label: "ថវិការដ្ឋ",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header8: {
                        label: "ថវិកាដៃគូអភិវឌ្ឍន៍",
                        rowspan: 0,
                        colspan: 0,
                    },
                },
                dataSubHeaders: {
                },
                data: [
                    {
                        id: 1,
                        name: "ច្បាប់ហិរញ្ញវត្ថុ",
                        name_kh: "ច្បាប់ហិរញ្ញវត្ថុ",
                        remark: "",
                        status: 1,
                        hasColspan: true,
                        colspan: 10,
                        order_level: "",
                        data: {
                            summary: {
                                id: 1,
                                name: "សរុបរួមក្រសួង",
                                values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                            },
                            children: [
                                {
                                    id: 1,
                                    name: "១.ចំណូលពីប្រភពក្នុងស្រុក",
                                    values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00],
                                    data: [
                                        {
                                            id: 1,
                                            name: "- ចំណូលសារពើពន្ធ",
                                            values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                        },
                                        {
                                            id: 1,
                                            name: "- ចំណូលមិនមែនសារពើពន្ធ",
                                            values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                        },
                                        {
                                            id: 1,
                                            name: "- ចំណូលមូលធនក្នុងស្រុក (កម្ចីបន្ត)",
                                            values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                        }
                                    ],
                                    // dataDetails: [
                                    //     {
                                    //         id: 1,
                                    //         name: "១. អនុកម្មវិធីទី១.១ អគ្គនាយកដ្ឋាន​គោលនយោបាយ",
                                    //         entity: {},
                                    //         values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00],
                                    //         data: [
                                    //             {
                                    //                 id: 1,
                                    //                 name: "- បន្ទុកបុគ្គលិក",
                                    //                 values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                    //             },
                                    //             {
                                    //                 id: 1,
                                    //                 name: "- បន្ទុកបុគ្គលិក",
                                    //                 values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                    //             }
                                    //         ],
                                    //         ceiling_entities: [
                                    //             {
                                    //                 id: 1,
                                    //                 name: "- បន្ទុកបុគ្គលិក",
                                    //                 values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                    //             },
                                    //             {
                                    //                 id: 1,
                                    //                 name: "- បន្ទុកបុគ្គលិក",
                                    //                 values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                    //             }
                                    //         ]
                                    //     },
                                    //     {
                                    //         id: 2,
                                    //         name: "២. អនុកម្មវិធីទី១.២ អគ្គលេខាធិការដ្ឋាន​គណៈកម្មាធិការជាតិ​ផលិតភាពសេដ្ឋកិច្ច​កម្ពុជា",
                                    //         entity: {},
                                    //         values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00],
                                    //         data: [
                                    //             {
                                    //                 id: 1,
                                    //                 name: "- បន្ទុកបុគ្គលិក",
                                    //                 values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                    //             },
                                    //             {
                                    //                 id: 1,
                                    //                 name: "- បន្ទុកបុគ្គលិក",
                                    //                 values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                    //             }
                                    //         ]
                                    //     },
                                    // ]
                                },
                                {
                                    id: 2,
                                    name: "២.ចំណូលពីការអនុវត្តគម្រោង",
                                    values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00],
                                    data: [
                                        {
                                            id: 1,
                                            name: "- គម្រោងវិនិយោគ (មានហិរញ្ញប្បទាន)",
                                            values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                        },
                                        {
                                            id: 1,
                                            name: "- ជំនួយបច្ចេកទេស (មានហិរញ្ញប្បទាន)",
                                            values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                        }
                                    ],
                                    // dataDetails: [
                                    //     {
                                    //         id: 1,
                                    //         name: "១. មន្ទីរសេដ្ឋកិច្ចនិងហិរញ្ញវត្ថុខេត្តបាត់ដំបង",
                                    //         entity: {},
                                    //         values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00],
                                    //         data: [
                                    //             {
                                    //                 id: 1,
                                    //                 name: "- បន្ទុកបុគ្គលិក",
                                    //                 values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                    //             },
                                    //             {
                                    //                 id: 1,
                                    //                 name: "- បន្ទុកបុគ្គលិក",
                                    //                 values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                    //             }
                                    //         ]
                                    //     },
                                    //     {
                                    //         id: 2,
                                    //         name: "២. មន្ទីរសេដ្ឋកិច្ចនិងហិរញ្ញវត្ថុខេត្តបន្ទាយមានជ័យ",
                                    //         entity: {},
                                    //         values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00],
                                    //         data: [
                                    //             {
                                    //                 id: 1,
                                    //                 name: "- បន្ទុកបុគ្គលិក",
                                    //                 values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                    //             },
                                    //             {
                                    //                 id: 1,
                                    //                 name: "- បន្ទុកបុគ្គលិក",
                                    //                 values: [1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00]
                                    //             }
                                    //         ]
                                    //     },
                                    // ]
                                },
                            ]
                        }
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