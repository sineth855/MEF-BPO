<template>
    <div id="table-demo">
        <!-- <table-state></table-state> -->
        <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" :allowDel="true" :title="title"
            :dataInfo="dataInfo" :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :dataTables="data"
            :formAttributes="formAttributes" :rowDisplay="rowDisplay"></d-table-list>
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
            title: "expense_implementing_result",
            api: apiConfig._apiObjective,
            dataAttributes: {
                tableStyle: 6,
                page_number: 1,
                offset: 0,
                dataGrid: "row",
                hasHeadingReport: false,
                headingReport: "",
                popupFullscreen: true,
                hasFormType: true
            },
            dataHeaders: {
                header1: {
                    width: 150,
                    label: "account_group_id",
                    rowspan: 3,
                    colspan: 0,
                },
                header2: {
                    label: "account_id",
                    rowspan: 3,
                    colspan: 0,
                },
                header3: {
                    label: "sub_account_id",
                    rowspan: 3,
                    colspan: 0,
                },
                header4: {
                    label: "line_ministry",
                    rowspan: 3,
                    colspan: 0,
                },
                header5: {
                    label: "finance_rule",
                    rowspan: 3,
                    colspan: 0,
                },
                header6: {
                    label: "total_annual_program_project",
                    rowspan: 2,
                    colspan: 2,
                },
                header7: {
                    label: "semester1",
                    rowspan: 0,
                    colspan: 8,
                },
                header8: {
                    label: "semester2",
                    rowspan: 0,
                    colspan: 8,
                },
                header9: {
                    label: "semester3",
                    rowspan: 0,
                    colspan: 8,
                },
                header10: {
                    label: "semester4",
                    rowspan: 0,
                    colspan: 8,
                },
                header11: {
                    label: "other",
                    rowspan: 3,
                    colspan: 0,
                }
            },
            data: {
                dataHeaders: {
                    header1: {
                        label: "គ្រោងដើមឆ្នាំ",
                        rowspan: 0,
                        colspan: 4,
                    },
                    header2: {
                        label: "ប៉ាន់ស្មានអនុវត្ត",
                        rowspan: 0,
                        colspan: 4,
                    },
                    header3: {
                        label: "គ្រោងដើមឆ្នាំ",
                        rowspan: 0,
                        colspan: 4,
                    },
                    header4: {
                        label: "ប៉ាន់ស្មានអនុវត្ត",
                        rowspan: 0,
                        colspan: 4,
                    },
                    header5: {
                        label: "គ្រោងដើមឆ្នាំ",
                        rowspan: 0,
                        colspan: 4,
                    },
                    header6: {
                        label: "ប៉ាន់ស្មានអនុវត្ត",
                        rowspan: 0,
                        colspan: 4,
                    },
                    header7: {
                        label: "គ្រោងដើមឆ្នាំ",
                        rowspan: 0,
                        colspan: 4,
                    },
                    header8: {
                        label: "ប៉ាន់ស្មានអនុវត្ត",
                        rowspan: 0,
                        colspan: 4,
                    }
                },
                dataSubHeaders: {
                    header1: {
                        label: "ទឹកប្រាក់",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header2: {
                        label: "%ច្បាប់",
                        rowspan: 0,
                        colspan: 0,
                    },

                    header3: {
                        label: "សរុប",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header4: {
                        label: "ខែទី១",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header5: {
                        label: "ខែទី២",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header6: {
                        label: "ខែទី៣",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header7: {
                        label: "សរុប",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header8: {
                        label: "អនុ.ខែទី១",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header9: {
                        label: "អនុ.ខែទី២",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header10: {
                        label: "អនុ.ខែទី៣",
                        rowspan: 0,
                        colspan: 0,
                    },

                    header11: {
                        label: "សរុប",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header12: {
                        label: "ខែទី៤",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header13: {
                        label: "ខែទី៥",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header14: {
                        label: "ខែទី៦",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header15: {
                        label: "សរុប",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header16: {
                        label: "អនុ.ខែទី៤",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header17: {
                        label: "អនុ.ខែទី៥",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header18: {
                        label: "អនុ.ខែទី៦",
                        rowspan: 0,
                        colspan: 0,
                    },

                    header19: {
                        label: "សរុប",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header20: {
                        label: "ខែទី៧",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header21: {
                        label: "ខែទី៨",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header22: {
                        label: "ខែទី៩",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header23: {
                        label: "សរុប",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header24: {
                        label: "អនុ.ខែទី៧",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header25: {
                        label: "អនុ.ខែទី៨",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header26: {
                        label: "អនុ.ខែទី៩",
                        rowspan: 0,
                        colspan: 0,
                    },

                    header27: {
                        label: "សរុប",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header28: {
                        label: "ខែទី១០",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header29: {
                        label: "ខែទី១១",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header30: {
                        label: "ខែទី១២",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header31: {
                        label: "សរុប",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header32: {
                        label: "អនុ.ខែទី១០",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header33: {
                        label: "អនុ.ខែទី១១",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header34: {
                        label: "អនុ.ខែទី១២",
                        rowspan: 0,
                        colspan: 0,
                    }
                },
                dataFillables: {
                    field1: "name",
                    field2: "name_kh",
                    field3: "remark",
                    field4: "status",
                    field5: "order_level",
                    field6: "implementing_year",
                    field7: "current_year"
                },
                // group_fields: { field1: "rev_group", field2: "rev_type" },
                summary: [],
                data: [
                    {
                        name: "១.១. អនុកម្មវិធីទី១.១: ការគ្រប់គ្រងគោលនយោបាយសេដ្ឋកិច្ច ហិរញ្ញវត្ថុ និងគោលនយោបាយតាមវិស័យផ្សេងៗ",
                        name_kh: "5",
                        remark: "",
                        status: 1,
                        order_level: "",
                        implementing_year: "",
                        current_year: "",
                        children: [
                            {
                                name: "សូចនាករទី១",
                                name_kh: "សូចនាករទី១",
                                remark: "",
                                status: 1,
                                order_level: "",
                            },
                            {
                                name: "សូចនាករទី២",
                                name_kh: "សូចនាករទី២",
                                remark: "",
                                status: 1,
                                order_level: "",
                            },
                        ],
                        data: [
                            {
                                name: "១.១.១. ចង្កោមសកម្មភាពទី១ : គាំទ្រ សម្របសម្រួល និងគ្រប់គ្រងការងាររដ្ឋបាលរបស់អគ្គនាយកដ្ឋាន",
                                name_kh: "១.១.១. ចង្កោមសកម្មភាពទី១ : គាំទ្រ សម្របសម្រួល និងគ្រប់គ្រងការងាររដ្ឋបាលរបស់អគ្គនាយកដ្ឋាន",
                                remark: "",
                                status: 1,
                                order_level: "",
                                implementing_year: "",
                                current_year: "",
                                has_child: true,
                                children: [
                                    {
                                        name: "សូចនាករទី១",
                                        name_kh: "សូចនាករទី១",
                                        remark: "",
                                        status: 1,
                                        order_level: "",
                                    },
                                    {
                                        name: "សូចនាករទី២",
                                        name_kh: "សូចនាករទី២",
                                        remark: "",
                                        status: 1,
                                        order_level: "",
                                    },
                                ]
                            }
                        ]
                    }
                ],
                account_group_id: [
                    {
                        value: 1,
                        label: "70-"
                    }, {
                        value: 2,
                        label: "73-"
                    },
                ],
                account_id: [
                    {
                        value: 2,
                        label: "7302"
                    },
                ],
                sub_account_id: [
                    {
                        value: 2,
                        label: "73023"
                    },
                ],
                department_id: [
                    {
                        value: 2,
                        label: "ក្រសួង-ស្ថាប័ន"
                    }
                ],
                finance_rule: [
                    {
                        value: 1,
                        label: "2023"
                    }
                ],
                limit: 10,
                total: 3,
            },
            formAttributes: [
                {
                    name: "account_group_id",
                    type: "select",
                    options: [],
                    required: true
                },
                {
                    name: "account_id",
                    type: "select",
                    options: [],
                    required: true
                },
                {
                    name: "sub_account_id",
                    type: "select",
                    options: [],
                    required: true
                },
                {
                    name: "department_id",
                    type: "select",
                    options: [],
                    required: true
                },
                {
                    name: "finance_rule",
                    type: "select",
                    required: false
                },
                {
                    name: "remark",
                    type: "textarea",
                    required: false
                },
                {
                    name: "semester1",
                    type: "text_group",
                    child_form: [
                        {
                            name: "income_budget_jan",
                            type: "text",
                            required: false,
                        },
                        {
                            name: "income_budget_feb",
                            type: "text",
                            required: false,
                        },
                        {
                            name: "income_budget_mar",
                            type: "text",
                            required: false,
                        },
                    ],
                    required: false,
                },
                {
                    name: "semester2",
                    type: "text_group",
                    child_form: [
                        {
                            name: "income_budget_apr",
                            type: "text",
                            required: false,
                        },
                        {
                            name: "income_budget_may",
                            type: "text",
                            required: false,
                        },
                        {
                            name: "income_budget_jun",
                            type: "text",
                            required: false,
                        },
                    ],
                    required: false,
                },
                {
                    name: "semester3",
                    type: "text_group",
                    child_form: [
                        {
                            name: "income_budget_jul",
                            type: "text",
                            required: false,
                        },
                        {
                            name: "income_budget_aug",
                            type: "text",
                            required: false,
                        },
                        {
                            name: "income_budget_sep",
                            type: "text",
                            required: false,
                        },
                    ],
                    required: false,
                },
                {
                    name: "semester4",
                    type: "text_group",
                    child_form: [
                        {
                            name: "income_budget_oct",
                            type: "text",
                            required: false,
                        },
                        {
                            name: "income_budget_nov",
                            type: "text",
                            required: false,
                        },
                        {
                            name: "income_budget_dec",
                            type: "text",
                            required: false,
                        },
                    ],
                    required: false,
                },
            ],
            rowDisplay: "3grid", //1grid, 2grid, 3grid, 4grid
            dataFields: [],
            dataInfo: {}
        }
    },
    components: {
        DTableList
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