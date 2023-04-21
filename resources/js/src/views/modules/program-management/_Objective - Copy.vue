<template>
    <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" 
    :allowDel="true" :title="title" :dataAttributes="dataAttributes" 
    :dataHeaders="dataHeaders" :dataTables="data"
    :formAttributes="formAttributes" :rowDisplay="rowDisplay"></d-table-list>
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
                page_number: 1,
                offset: 0,
                dataGrid: "row",
            },
            dataHeaders: {
                // header1: "id",
                header2: "name",
                header3: "name_kh",
                header4: "remark",
                header5: "order_level",
            },
            data: {
                // order_status_choices: [
                //     { text: 'Pending', value: 'pending' },
                //     { text: 'Canceled', value: 'canceled' },
                //     { text: 'Delivered', value: 'delivered' },
                //     { text: 'On Hold', value: 'on_hold' }
                // ],
                // titles: [
                //     { text: 'Mr.', value: 'Mr.' },
                //     { text: 'Ms.', value: 'Ms.' },
                //     { text: 'Mrs.', value: 'Mrs.' }
                // ],
                // limit: 2,
                // total: 3,
                // data:[
                // {
                //     id: 3,
                //     name: "Objective",
                //     name_kh: "គោលបំណងទី3",
                //     order_level: 1,
                //     remark: "",
                //     ddd: "tttt12"
                // },
                // {
                //     id: 4,
                //     name: "Objective",
                //     name_kh: "គោលបំណងទី4",
                //     order_level: 1,
                //     remark: "",
                //     ddd: "tttt33"
                // },
                // {
                //     id: 1,
                //     name: "Objective",
                //     name_kh: "គោលបំណងទី១",
                //     order_level: 1,
                //     remark: "",
                //     ddd: "tttt"
                // },
                // {
                //     id: 2,
                //     name: "Objective",
                //     name_kh: "គោលបំណងទី2",
                //     order_level: 1,
                //     remark: "",
                //     ddd: "tttt"
                //     },
                //     {
                //         id: 3,
                //         name: "Objective",
                //         name_kh: "គោលបំណងទី3",
                //         order_level: 1,
                //         remark: "",
                //     ddd: "tttt"
                //     },
                //     {
                //         id: 4,
                //         name: "Objective",
                //         name_kh: "គោលបំណងទី4",
                //         order_level: 1,
                //         remark: "",
                //     ddd: "tttt"
                //     },
                //     {
                //         id: 1,
                //         name: "Objective",
                //         name_kh: "គោលបំណងទី១",
                //         order_level: 1,
                //         remark: "",
                //     ddd: "tttt"
                //     },
                //     {
                //         id: 2,
                //         name: "Objective",
                //         name_kh: "គោលបំណងទី2",
                //         order_level: 1,
                //         remark: "",
                //     ddd: "tttt"
                //     },
               
                // ]
            },
            formAttributes: [
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
                // {
                //     name: "select",
                //     type: "select",
                //     required: false,
                //     data: this.data.titles
                // },
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
                // {
                //     name: "select",
                //     type: "select",
                //     required: false,
                //     data: this.data.order_status_choices
                // },
            ],
            rowDisplay: "2grid", //1grid, 2grid, 3grid, 4grid
            dataArr: [],
            searchArr: [],
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
                axios.post(apiConfig._apiObjective + "/search", _params)
                //axios.post(apiConfig._apiObjective + "/search" + '?sort=' + _search_criteria.sort + '&order=' + _search_criteria.order + '&page_number=' + _search_criteria.page_number + "&dd=" + _ddd)
                    .then((response) => {
                        this.data = response.data;
                        this.$vs.loading.close();
                        // if (response.success) {
                        //     // this.$vs.loading.close();
                        // }
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

<style>
th.th-width-300 {
    min-width: 260px !important;
}

td.td-width-150 {
    min-width: 150px !important;
}

table tr td,
th {
    border: 1px solid #d7d7d7;
}

th {
    text-align: center !important;
    /* display: inline; */
}

th.rotate {
    transform: rotate(-90deg)
}

.vs-table--thead th .vs-table-text {
    text-transform: uppercase;
    font-weight: 600;
    text-align: center;
    display: inline !important;
}
</style>


<style lang="scss">
#data-list-list-view {
    font-family: 'Khmer MEF1';

    .vs-con-table {

        /*
      Below media-queries is fix for responsiveness of action buttons
      Note: If you change action buttons or layout of this page, Please remove below style
    */
        @media (max-width: 689px) {
            .vs-table--search {
                margin-left: 0;
                max-width: unset;
                width: 100%;

                .vs-table--search-input {
                    width: 100%;
                }
            }
        }

        @media (max-width: 461px) {
            .items-per-page-handler {
                display: none;
            }
        }

        @media (max-width: 341px) {
            .data-list-btn-container {
                width: 100%;

                .dd-actions,
                .btn-add-new {
                    width: 100%;
                    margin-right: 0 !important;
                }
            }
        }

        .product-name {
            max-width: 23rem;
        }

        .vs-table--header {
            display: flex;
            flex-wrap: wrap;
            margin-left: 1.5rem;
            margin-right: 1.5rem;

            >span {
                display: flex;
                flex-grow: 1;
            }

            .vs-table--search {
                padding-top: 0;

                .vs-table--search-input {
                    padding: 0.9rem 2.5rem;
                    font-size: 1rem;

                    &+i {
                        left: 1rem;
                    }

                    &:focus+i {
                        left: 1rem;
                    }
                }
            }
        }

        .vs-table {
            border-collapse: separate;
            border-spacing: 0 1.3rem;
            padding: 0 1rem;

            tr {
                box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .05);

                td {
                    padding: 20px;

                    &:first-child {
                        border-top-left-radius: .5rem;
                        border-bottom-left-radius: .5rem;
                    }

                    &:last-child {
                        border-top-right-radius: .5rem;
                        border-bottom-right-radius: .5rem;
                    }
                }

                td.td-check {
                    padding: 20px !important;
                }
            }
        }

        .vs-table--thead {
            th {
                padding-top: 0;
                padding-bottom: 0;

                .vs-table-text {
                    text-transform: uppercase;
                    font-weight: 600;
                }
            }

            th.td-check {
                padding: 0 15px !important;
            }

            tr {
                background: none;
                box-shadow: none;
            }
        }

        .vs-table--pagination {
            justify-content: center;
        }
    }
}
</style>
