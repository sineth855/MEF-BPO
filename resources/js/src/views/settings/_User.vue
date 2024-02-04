<template>
    <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" :allowDel="true" :title="title" :dataInfo="dataInfo"
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
            title: "setting_user",
            api: apiConfig._apiUser,
            dataAttributes: {
                tableStyle: 1,
                page_number: 1,
                offset: 0,
                dataGrid: "row",
                popupFullscreen: true,
                actionButton: [
                    // {
                    //     icon: "LockIcon",
                    //     path: "/module/budget-arrangement/budget-ceiling/list",
                    //     method: "View"
                    // }
                ]
            },
            dataHeaders: {
                header1: "entity",
                header2: "name",
                header3: "email",
                header4: "position",
            },
            data: {
                data: [
                    {}
                ],

                limit: 10,
                total: 3,
            },
            formAttributes: [
                {
                    name: "entity_id",
                    type: "select",
                    required: true,
                    options: []
                },
                {
                    name: "role_id",
                    type: "select",
                    required: true,
                    options: []
                },
                {
                    name: "title",
                    type: "select",
                    required: true,
                    options: []
                },

                {
                    name: "latin",
                    type: "text",
                    required: true,
                },
                {
                    name: "gender",
                    type: "select",
                    required: true,
                    options: []
                },
                {
                    name: "position",
                    type: "select",
                    required: true,
                    options: []
                },
                {
                    name: "email",
                    type: "text",
                    required: true
                },
                {
                    name: "password",
                    type: "hidden",
                    required: true
                },
                {
                    name: "confirm_password",
                    type: "hidden",
                    required: true
                },

                {
                    name: "telephone_1",
                    type: "text",
                    required: false
                },
                {
                    name: "is_active",
                    type: "checkbox",
                    required: false
                },
            ],
            rowDisplay: "3grid", //1grid, 2grid, 3grid, 4grid
            dataFields: [],
            dataInfo: {}
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
                axios.post(this.api + "_index", _params)
                    .then((response) => {
                        if (response.data) {
                            this.data = response.data;
                        } else {
                            this.data = this.data;
                        }
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