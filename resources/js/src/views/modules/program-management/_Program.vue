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
            title: "Program",
            api: apiConfig._apiProgram,
            objectives: [
                {
                    "label": "គោលបំណងទី១",
                    "value": 1,
                },
                {
                    "label": "គោលបំណងទី២",
                    "value": 2,
                }
            ],
            dataAttributes: {
                backgroundColor: "warning",
                tableStyle: 2,
                page_number: 1,
                offset: 0,
                dataGrid: "row",
                popupFullscreen: false
            },
            dataHeaders: {
                header1: "code",
                header2: "name_en",
                header3: "name_kh",
                // header4: "objective_id",
                // header5: "entity_id",
                // header6: "entity_member_id",
                header5: "entity_id",
                header6: "entity_member_id",
                header7: "order_level"
            },
            // data: "",
            data: {
                data: [
                    {
                        id: 1,
                        name_en: "#120 - គោលបំណងទី១",
                        name_kh: "#120 - គោលបំណងទី១",
                        children: [
                            {
                                id: 1,
                                code: "001",
                                name_en: "កម្មវិធីទី១",
                                name_kh: "កម្មវិធីទី១",
                                // objective: "គោលបំណងគោលនយោបាយទី១",
                                entity_id: "ឯកឧត្តម ទទួលបន្ទុក",
                                entity_member_id: "ឈ្មោះអង្គភាពទទួលបន្ទុក",
                                order_level: 1
                            },
                            {
                                id: 2,
                                code: "002",
                                name_en: "កម្មវិធីទី១",
                                name_kh: "កម្មវិធីទី១",
                                // objective: "គោលបំណងគោលនយោបាយទី១",
                                entity_id: "ឯកឧត្តម ទទួលបន្ទុក",
                                entity_member_id: "ឈ្មោះអង្គភាពទទួលបន្ទុក",
                                order_level: 1
                            },
                            {
                                id: 3,
                                code: "003",
                                name_en: "កម្មវិធីទី១",
                                name_kh: "កម្មវិធីទី១",
                                // objective: "គោលបំណងគោលនយោបាយទី១",
                                entity_id: "ឈ្មោះអង្គភាពទទួលបន្ទុក",
                                entity_member_id: "ឯកឧត្តម ទទួលបន្ទុក",
                                order_level: 1
                            },
                        ]
                    }
                ],
                objective_id: [
                    {
                        "label": "គោលបំណងទី១",
                        "value": 1,
                    },
                    {
                        "label": "គោលបំណងទី២",
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
                    name: "objective_id",
                    type: "select",
                    required: true,
                    options: []
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