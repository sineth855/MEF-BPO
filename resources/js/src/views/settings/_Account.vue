<template>
    <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" :allowDel="true" :title="title"
        :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :dataTables="data" :formAttributes="formAttributes"
        :rowDisplay="rowDisplay"></d-table-list>
</template>

<script>
import axios from "@/axios.js"
import apiConfig from "@/apiConfig.js"
import { ref } from 'vue';

import DTableList from '@/views/form-builder/DTableList.vue'

export default {
    data() {
        return {
            title: "setting_account_sub_account",
            api: apiConfig._apiAccount,
            dataAttributes: {
                tableStyle: 1,
                page_number: 1,
                offset: 0,
                dataGrid: "row",
                actionButton: [
                    // {
                    //     icon: "DollarSignIcon",
                    //     path: "/module/budget-arrangement/budget-ceiling/list",
                    //     method: "View"
                    // }
                ]
            },
            dataHeaders: {
                header1: "code",
                parent: "",
                header2: "name_en",
                header3: "name_kh",
                header4: "order_level",
            },
            data: {
                data: [
                    {
                        code: "6001",
                        parent: "",
                        name_en: "សម្ភារៈផ្គត់ផ្គង់ថែទាំ",
                        name_kh: "សម្ភារៈផ្គត់ផ្គង់ថែទាំ",
                        description: "",
                        order_level: 1,
                        is_active: 1
                    },
                    {
                        code: "60011",
                        parent: "សម្ភារៈផ្គត់ផ្គង់ថែទាំ",
                        name_en: "សម្ភារៈផ្គត់ផ្គង់សម្អាត និងអនាម័យ",
                        name_kh: "សម្ភារៈផ្គត់ផ្គង់សម្អាត និងអនាម័យ",
                        description: "",
                        order_level: 1,
                        is_active: 1
                    },
                    {
                        code: "60012",
                        parent: "សម្ភារៈផ្គត់ផ្គង់ថែទាំ",
                        name_en: "សម្ភារៈផ្គត់ផ្គង់សម្រាប់ថែទាំអាគារ ប្រសាទ និងសំណង់ផ្សេងៗ",
                        name_kh: "សម្ភារៈផ្គត់ផ្គង់សម្រាប់ថែទាំអាគារ ប្រសាទ និងសំណង់ផ្សេងៗ",
                        description: "",
                        order_level: 1,
                        is_active: 1
                    },
                ],
                account_group_id: [
                    {
                        "label": "ការទិញ",
                        "value": 1,
                    },
                    {
                        "label": "បន្ទុកបុគ្គលិក",
                        "value": 2,
                    }
                ],
                account_type_id: [
                    {
                        "label": "សិក្ខាសាលា /បណ្តុះបណ្តាល និងកិច្ចប្រជុំ ក្នុងប្រទេស",
                        "value": 1,
                    },
                    {
                        "label": "សម្ភារៈផ្គត់ផ្គង់ថែទាំ",
                        "value": 2,
                    },
                    {
                        "label": "លទ្ធកម្មទំនិញ",
                        "value": 3,
                    }
                ],
                limit: 10,
                total: 3,
            },
            formAttributes: [
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
                    name: "order_level",
                    type: "number",
                    required: false
                },
                {
                    name: "description",
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