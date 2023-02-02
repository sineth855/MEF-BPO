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
            dataAttributes: {
                backgroundColor: "warning",
                tableStyle: 2,
                page_number: 1,
                offset: 0,
                dataGrid: "row",
            },
            dataHeaders: {
                header1: "code_program",
                header2: "name",
                header3: "name_kh",
                header4: "objective",
                header5: "responsible_person",
                header6: "responsible_entity",
                header7: "order_level"
            },
            data: {
                data: [
                    {
                        id: 1,
                        name: "#120 - គោលបំណងទី១",
                        name_kh: "#120 - គោលបំណងទី១",
                        children: [
                            {
                                id: 1,
                                code_program: "001",
                                name: "កម្មវិធីទី១",
                                name_kh: "កម្មវិធីទី១",
                                objective: "គោលបំណងគោលនយោបាយទី១",
                                responsible_person: "ឯកឧត្តម ទទួលបន្ទុក",
                                responsible_entity: "ឈ្មោះអង្គភាពទទួលបន្ទុក",
                                order_level: 1
                            },
                            {
                                id: 2,
                                code_program: "002",
                                name: "កម្មវិធីទី១",
                                name_kh: "កម្មវិធីទី១",
                                objective: "គោលបំណងគោលនយោបាយទី១",
                                responsible_person: "ឯកឧត្តម ទទួលបន្ទុក",
                                responsible_entity: "ឈ្មោះអង្គភាពទទួលបន្ទុក",
                                order_level: 1
                            },
                            {
                                id: 3,
                                code_program: "003",
                                name: "កម្មវិធីទី១",
                                name_kh: "កម្មវិធីទី១",
                                objective: "គោលបំណងគោលនយោបាយទី១",
                                responsible_entity: "ឈ្មោះអង្គភាពទទួលបន្ទុក",
                                responsible_person: "ឯកឧត្តម ទទួលបន្ទុក",
                                order_level: 1
                            },
                        ]
                    }
                ],
                limit: 10,
                total: 3
            },
            formAttributes: [
                {
                    name: "objective",
                    type: "select",
                    required: true,
                    options: [
                        {
                            "label": "គោលបំណងទី១",
                            "value": 1,
                        },
                        {
                            "label": "គោលបំណងទី២",
                            "value": 2,
                        }
                    ],
                },
                {
                    name: "name",
                    type: "text",
                    required: true
                },
                {
                    name: "name_kh",
                    type: "text",
                    required: true
                },
                {
                    name: "responsible_person",
                    type: "text",
                    required: true
                },
                {
                    name: "responsible_entity",
                    type: "text",
                    required: true
                },
                {
                    name: "order_level",
                    type: "number",
                    required: false
                },
                {
                    name: "remark",
                    type: "text",
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