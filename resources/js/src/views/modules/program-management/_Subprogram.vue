<template>
    <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" :allowDel="true" :title="title"
        :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :dataTables="data" :formAttributes="formAttributes"
        :rowDisplay="rowDisplay"></d-table-list>
</template>

<script>
import axios from "@/axios.js";
import apiConfig from "@/apiConfig.js";
import { ref } from 'vue';

import DTableList from '@/views/form-builder/DTableList.vue';

export default {
    data() {
        return {
            title: "sub_program",
            api: apiConfig._apiSubProgram,
            dataAttributes: {
                popupFullscreen: true,
                backgroundColor: "warning",
                tableStyle: 2,
                page_number: 1,
                offset: 0,
                dataGrid: "row",
                hasIndicator: true,
                allowDel: true,
                actionButton: [
                    {
                        icon: "ListIcon",
                        path: "/module/budget-arrangement/budget-ceiling/list",
                        method: "View"
                    }
                ]
            },
            dataHeaders: {
                // header1: "code_subprogram",
                header1: "code",
                header2: "name_en",
                header3: "name_kh",
                // header4: "program",
                // header5: "indicator",
                header6: "entity",
                header7: "entity_member",
                header8: "order_level"
            },
            data: {
                data: [
                    {
                        id: 1,
                        name_en: "12-កម្មវិធីទី១",
                        name_kh: "12-កម្មវិធីទី១",
                        code: "",
                        children: [
                            {
                                id: 1,
                                program_id: 1,
                                code: "001",
                                name_en: "#001 - អនុកម្មវិធីទី ១",
                                name_kh: "#001 - អនុកម្មវិធីទី ១",
                                entity_id: 1,
                                entity_member_id: 2,
                                order_level: 1,
                                indicator: {
                                    data: [
                                        {
                                            id: 1,
                                            code: "#1.3.10-1",
                                            kpi_name_en: "ឈ្មោះសូចនាករ",
                                            kpi_name_kh: "ឈ្មោះសូចនាករ",
                                            order_level: 1,
                                            status: "Active"
                                        }, {
                                            id: 2,
                                            code: "#1.3.10-2",
                                            kpi_name_en: "ឈ្មោះសូចនាករ",
                                            kpi_name_kh: "ឈ្មោះសូចនាករ",
                                            order_level: 1,
                                            status: "Active"
                                        }, {
                                            id: 3,
                                            code: "#1.3.10-3",
                                            kpi_name_en: "ឈ្មោះសូចនាករជាភាសាអង់គ្លេស",
                                            kpi_name_kh: "ឈ្មោះសូចនាករជាភាសាអង់គ្លេស",
                                            order_level: 1,
                                            status: "InActive"
                                        }
                                    ]
                                },
                            }
                        ]
                    }
                ],
                program_id: [
                    {
                        "label": "កម្មវិធីទី១",
                        "value": 1,
                    },
                    {
                        "label": "កម្មវិធីទី២",
                        "value": 2,
                    }
                ],
                entity_id: [
                    {
                        "label": "អង្គភាពទី១",
                        "value": 1,
                    },
                    {
                        "label": "អង្គភាពទី២",
                        "value": 2,
                    }
                ],
                entity_member_id: [
                    {
                        "label": "សមាជិកទី១",
                        "value": 1,
                    },
                    {
                        "label": "សមាជិកទី២",
                        "value": 2,
                    }
                ],
                limit: 10,
                total: 3
            },
            formAttributes: [
                {
                    name: "program_id",
                    type: "select",
                    required: true,
                    hasDefault: false,
                    defaultOptions: {},
                    options: [
                        {
                            value: 1,
                            label: "កម្មវិធីទី១"
                        },
                        {
                            value: 2,
                            label: "កម្មវិធីទី២"
                        }
                    ]
                },
                {
                    name: "code",
                    type: "text",
                    required: true
                },
                {
                    name: "name_en",
                    type: "text",
                    required: true
                },
                {
                    name: "name_kh",
                    type: "text",
                    required: true
                },
                {
                    name: "entity_id",
                    type: "select",
                    required: true,
                    options: [
                        {
                            "label": "អង្គភាពទី១",
                            "value": 1,
                        },
                        {
                            "label": "អង្គភាពទី២",
                            "value": 2,
                        }
                    ],
                },
                {
                    name: "entity_member_id",
                    type: "select",
                    required: true,
                    options: [
                        {
                            "label": "បុគ្គលទិ១",
                            "value": 1,
                        },
                        {
                            "label": "បុគ្គលទិ២",
                            "value": 2,
                        }
                    ],
                },
                {
                    name: "order_level",
                    type: "number",
                    required: false
                },
                {
                    name: "remark",
                    type: "textarea",
                    required: false
                },
                // {
                //     name: "is_active",
                //     type: "checkbox",
                //     required: false
                // },
                {
                    name: "is_active",
                    type: "checkbox",
                    required: false,
                    attributes: [
                        {
                            name: "is_active",
                            value: "1"
                        }
                    ]
                }
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
                        if (response.data) {
                            this.data = response.data;
                        } else {
                            this.data = this.data;
                        }
                        console.log("data sub program", response.data);
                        console.log("data sub program2", this.data);
                        // this.data = this.data;
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