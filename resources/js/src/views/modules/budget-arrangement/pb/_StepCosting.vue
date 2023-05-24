<template>
    <div id="table-demo">
        <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" :allowDel="true" :title="title"
            :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :dataTables="data" :formAttributes="formAttributes"
            :rowDisplay="rowDisplay"></d-table-list>
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
            title: "pb_heading_costing",
            api: apiConfig._apiObjective,
            dataAttributes: {
                tableStyle: 6,
                page_number: 1,
                offset: 0,
                dataGrid: "row",
                hasHeadingReport: false,
                popupFullscreen: true,
                headingReport: "pb_heading_costing",
                actionButton: [
                    {
                        icon: "EditIcon",
                        path: "/module/budget-arrangement/budget-ceiling/list",
                        method: "Edit"
                    },
                    {
                        icon: "TrashIcon",
                        path: "/module/budget-arrangement/budget-ceiling/list",
                        method: "Delete"
                    }
                ]
            },
            dataHeaders: {
                header1: {
                    label: "កូដកម្មវិធី",
                    width: 0,
                    rowspan: 0,
                    colspan: 0,
                },
                header2: {
                    label: "ជំពូក",
                    width: 0,
                    rowspan: 0,
                    colspan: 0,
                },
                header3: {
                    label: "លេខ",
                    width: 0,
                    rowspan: 0,
                    colspan: 0,
                },
                header4: {
                    label: "ល.រ.",
                    width: 0,
                    rowspan: 0,
                    colspan: 0,
                },
                header5: {
                    label: "កូដចង្កោមសកម្មភាព",
                    flag: "y_n_minus_1",
                    rowspan: 0,
                    colspan: 0,
                },
                header6: {
                    label: "កូដសកម្មភាព",
                    flag: "y_n",
                    rowspan: 0,
                    colspan: 0,
                },
                header7: {
                    label: "អនុគណនី",
                    rowspan: 0,
                    colspan: 0,
                },
                header8: {
                    label: "បរិយាយមុខសញ្ញា",
                    width: "200",
                    // flag: "y_n_1",
                    rowspan: 0,
                    colspan: 0,
                },
                header9: {
                    label: "ប្រចាំ/មិនប្រចាំ",
                    rowspan: 0,
                    colspan: 0,
                },
                header10: {
                    label: "ឯកតា",
                    rowspan: 0,
                    colspan: 0,
                },
                header11: {
                    label: "បរិមាណ",
                    rowspan: 0,
                    colspan: 0,
                },
                header12: {
                    label: "រូបបីយប័ណ្ណ",
                    rowspan: 0,
                    colspan: 0,
                },
                header13: {
                    label: "តម្លៃឯកតា",
                    rowspan: 0,
                    colspan: 0,
                },
                header14: {
                    label: "តម្លៃ១លើក",
                    rowspan: 0,
                    colspan: 0,
                },
                header15: {
                    label: "លើក/ឆ្នាំ",
                    flag: "y_n_1",
                    rowspan: 0,
                    colspan: 0,
                },
                header16: {
                    label: "សរុបប្រចាំឆ្នាំ",
                    rowspan: 0,
                    colspan: 0,
                },
                header17: {
                    label: "ខែ",
                    rowspan: 0,
                    colspan: 0,
                },
                header19: {
                    label: "ផ្សេងៗ",
                    rowspan: 0,
                    colspan: 0,
                }
            },
            data: {
                dataHeaders: {
                    header1: {
                        label: "",
                        width: 0,
                        rowspan: 0,
                        colspan: 0,
                    },
                    header2: {
                        label: "",
                        width: 0,
                        rowspan: 0,
                        colspan: 0,
                    },
                    header3: {
                        label: "Line#",
                        width: 0,
                        rowspan: 0,
                        colspan: 0,
                    },
                    header4: {
                        label: "",
                        width: 0,
                        rowspan: 0,
                        colspan: 0,
                    },
                    header5: {
                        label: "Act.Cluster",
                        flag: "y_n_minus_1",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header6: {
                        label: "Pro.Activity",
                        flag: "y_n",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header7: {
                        label: "Sub-Account",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header8: {
                        label: "item_description",
                        // flag: "y_n_1",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header9: {
                        label: "regular_irregular",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header10: {
                        label: "unit",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header11: {
                        label: "quantity",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header12: {
                        label: "currency",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header13: {
                        label: "cost_unit",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header14: {
                        label: "cost_per_time", //តម្លៃ១លើក
                        rowspan: 0,
                        colspan: 0,
                    },
                    header15: {
                        label: "per_annual", //លើក/ឆ្នាំ
                        flag: "y_n_1",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header16: {
                        label: "total_annual", //សរុបប្រចាំឆ្នាំ
                        rowspan: 0,
                        colspan: 0,
                    },
                    header17: {
                        label: "month",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header19: {
                        label: "Misc", //ផ្សេងៗ
                        rowspan: 0,
                        colspan: 0,
                    }
                },
                dataSubHeaders: {
                    header1: {
                        label: "1",
                        width: 0,
                        rowspan: 0,
                        colspan: 0,
                    },
                    header2: {
                        label: "2",
                        width: 0,
                        rowspan: 0,
                        colspan: 0,
                    },
                    header3: {
                        label: "3",
                        width: 0,
                        rowspan: 0,
                        colspan: 0,
                    },
                    header4: {
                        label: "4",
                        width: "200",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header5: {
                        label: "5",
                        flag: "y_n_minus_1",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header6: {
                        label: "6",
                        flag: "y_n",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header7: {
                        label: "7",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header8: {
                        label: "8",
                        // flag: "y_n_1",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header9: {
                        label: "9",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header10: {
                        label: "10",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header11: {
                        label: "11",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header12: {
                        label: "12",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header13: {
                        label: "13",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header14: {
                        label: "14", //តម្លៃ១លើក
                        rowspan: 0,
                        colspan: 0,
                    },
                    header15: {
                        label: "15", //លើក/ឆ្នាំ
                        flag: "y_n_1",
                        rowspan: 0,
                        colspan: 0,
                    },
                    header16: {
                        label: "16", //សរុបប្រចាំឆ្នាំ
                        rowspan: 0,
                        colspan: 0,
                    },
                    header17: {
                        label: "17", //
                        rowspan: 0,
                        colspan: 0,
                    },
                    header19: {
                        label: "19", //ផ្សេងៗ
                        rowspan: 0,
                        colspan: 0,
                    }
                },
                dataFillables: {
                    field1: "chapter",
                    field2: "account",
                    field3: "sub_account",
                    field4: "no",
                    field5: "line",
                    field6: "code_cluster_activity",
                    field7: "code_activity",
                    field8: "item_name",
                    field9: "expense_type",
                    field10: "unit",
                    field11: "quantity",
                    field12: "unit_price",
                    field13: "total_amount",
                    field14: "time_year",
                    field15: "annual_amount",
                    field16: "month",
                    field17: "expense_type",
                    field19: "remark"
                },
                group_fields: { field1: "rev_group", field2: "rev_type" },
                summary: [
                    // {
                    //     chapter: "",
                    //     account: "",
                    //     sub_account: "",
                    //     cost_classification: "សរុប​រួមចំណូល​ (ក+ខ)",
                    //     income_year_minus_n: "0.00",
                    //     f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
                    //     f_rule_year_n_quantity: "0.00",
                    //     f_rule_year_n_credit_budget: "0.00",
                    //     est_budget_year_n_semester_1: "0.00",
                    //     est_budget_year_n_semester_2: "0.00",
                    //     est_cal_year_n_total: "0.00",
                    //     est__percentage_f_rule_year_n: "0.00",
                    //     f_plan_year_n1_basic_cal_income: "0.00",
                    //     f_plan_year_n1_quantity: "0.00",
                    //     f_plan_total_income: "0.00",
                    //     f_plan_percentage_year_n: "0.00",
                    // },
                    // {
                    //     chapter: "",
                    //     account: "",
                    //     sub_account: "",
                    //     cost_classification: "សរុប​រួមចំណូល​ (ក+ខ)",
                    //     income_year_minus_n: "0.00",
                    //     f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
                    //     f_rule_year_n_quantity: "0.00",
                    //     f_rule_year_n_credit_budget: "0.00",
                    //     est_budget_year_n_semester_1: "0.00",
                    //     est_budget_year_n_semester_2: "0.00",
                    //     est_cal_year_n_total: "0.00",
                    //     est__percentage_f_rule_year_n: "0.00",
                    //     f_plan_year_n1_basic_cal_income: "0.00",
                    //     f_plan_year_n1_quantity: "0.00",
                    //     f_plan_total_income: "0.00",
                    //     f_plan_percentage_year_n: "0.00",
                    // },
                    // {
                    //     chapter: "",
                    //     account: "",
                    //     sub_account: "",
                    //     cost_classification: "សរុប​រួមចំណូល​ (ក+ខ)",
                    //     income_year_minus_n: "0.00",
                    //     f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
                    //     f_rule_year_n_quantity: "0.00",
                    //     f_rule_year_n_credit_budget: "0.00",
                    //     est_budget_year_n_semester_1: "0.00",
                    //     est_budget_year_n_semester_2: "0.00",
                    //     est_cal_year_n_total: "0.00",
                    //     est__percentage_f_rule_year_n: "0.00",
                    //     f_plan_year_n1_basic_cal_income: "0.00",
                    //     f_plan_year_n1_quantity: "0.00",
                    //     f_plan_total_income: "0.00",
                    //     f_plan_percentage_year_n: "0.00",
                    // }
                ],
                data: [
                    {
                        // rev_group: {
                        //     chapter: "",
                        //     account: "",
                        //     sub_account: "",
                        //     cost_classification: "ក្រុមទី១: ចំណូល​ពិត (ប្រភេទទី១+ប្រភេទទី២)",
                        //     income_year_minus_n: "0.00",
                        //     f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
                        //     f_rule_year_n_quantity: "0.00",
                        //     f_rule_year_n_credit_budget: "0.00",
                        //     est_budget_year_n_semester_1: "0.00",
                        //     est_budget_year_n_semester_2: "0.00",
                        //     est_cal_year_n_total: "0.00",
                        //     est__percentage_f_rule_year_n: "0.00",
                        //     f_plan_year_n1_basic_cal_income: "0.00",
                        //     f_plan_year_n1_quantity: "0.00",
                        //     f_plan_total_income: "0.00",
                        //     f_plan_percentage_year_n: "0.00"
                        // },
                        // rev_type: {
                        //     chapter: "",
                        //     account: "",
                        //     sub_account: "",
                        //     cost_classification: "ប្រភេទទី១: ចំណូល​សារពើពន្ធ",
                        //     income_year_minus_n: "0.00",
                        //     f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
                        //     f_rule_year_n_quantity: "0.00",
                        //     f_rule_year_n_credit_budget: "0.00",
                        //     est_budget_year_n_semester_1: "0.00",
                        //     est_budget_year_n_semester_2: "0.00",
                        //     est_cal_year_n_total: "0.00",
                        //     est__percentage_f_rule_year_n: "0.00",
                        //     f_plan_year_n1_basic_cal_income: "0.00",
                        //     f_plan_year_n1_quantity: "0.00",
                        //     f_plan_total_income: "0.00",
                        //     f_plan_percentage_year_n: "0.00"
                        // },
                        children: [
                            {
                                chapter: "",
                                account: "",
                                sub_account: "",
                                no: "",
                                line: "",
                                code_prog_act: "10101",
                                code_cluster_activity: "",
                                code_activity: "",
                                item_name: "អនុកម្មវិធីទី១.១ : អគ្គនាយកដ្ឋានគោលនយោបាយ",
                                expense_type: "",
                                unit: "",
                                quantity: "",
                                unit_price: "",
                                total_amount: "",
                                time_year: "",
                                annual_amount: "",
                                month: "",
                                expense_type: "",
                                remark: "",
                                has_child: true,
                                children: [
                                    {
                                        chapter: "",
                                        account: "",
                                        sub_account: "",
                                        no: "",
                                        line: "",
                                        code_prog_act: "101010101",
                                        code_cluster_activity: "",
                                        code_activity: "",
                                        item_name: "ចង្កោមសកម្មភាពទី១៖ លេខាធិការដ្ឋាន",
                                        expense_type: "",
                                        unit: "",
                                        quantity: "",
                                        unit_price: "",
                                        total_amount: "",
                                        time_year: "",
                                        annual_amount: "",
                                        month: "",
                                        expense_type: "",
                                        remark: "",
                                        has_child: true,
                                        children: [
                                            {
                                                chapter: "",
                                                account: "",
                                                sub_account: "",
                                                no: "",
                                                line: "",
                                                code_prog_act: "",
                                                code_cluster_activity: "",
                                                code_activity: "",
                                                item_name: "សកម្មភាពទី១ នៃចង្កោមសកម្មភាពទី១៖ បំពេញមុខងារជាលេខាធិការដ្ឋាន",
                                                expense_type: "",
                                                unit: "",
                                                quantity: "",
                                                unit_price: "",
                                                total_amount: "",
                                                time_year: "",
                                                annual_amount: "",
                                                month: "",
                                                expense_type: "",
                                                remark: "",
                                            },
                                            {
                                                chapter: "",
                                                account: "",
                                                sub_account: "",
                                                no: "",
                                                line: "",
                                                code_prog_act: "",
                                                code_cluster_activity: "",
                                                code_activity: "",
                                                item_name: "",
                                                expense_type: "",
                                                unit: "",
                                                quantity: "",
                                                unit_price: "",
                                                total_amount: "",
                                                time_year: "",
                                                annual_amount: "",
                                                month: "",
                                                expense_type: "",
                                                remark: "",
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
                    name: "entity_id",
                    type: "select",
                    required: true,
                    data: [],
                },
                {
                    name: "group_chapter",
                    type: "select",
                    required: true,
                    data: [],
                },
                {
                    name: "account_id",
                    type: "select",
                    required: true,
                    data: [],
                },
                {
                    name: "sub_account_id",
                    type: "select",
                    required: true,
                    data: [],
                },
                {
                    name: "ច្បាប់ហិរញ្ញវត្ថុ",
                    type: "grid",
                    flag: "y_n_minus_1",
                    required: false,
                },
                {
                    name: "មូលដ្ឋានគិតចំណូល",
                    type: "text",
                    required: false,
                },
                {
                    name: "បរិមាណ",
                    type: "text",
                    required: false,
                },
                {
                    name: "សរុប​ឥណទានថវិកា",
                    type: "text",
                    required: false,
                },
                {
                    name: "ប៉ាន់ស្មាន​អនុវត្ត​ឆ្នាំ",
                    type: "grid",
                    required: false,
                },
                {
                    name: "មូលដ្ឋានគិតចំណូល",
                    type: "text",
                    required: false,
                },
                {
                    name: "បរិមាណ",
                    type: "text",
                    required: false,
                },
                {
                    name: "សរុប​ឥណទានថវិកា",
                    type: "text",
                    required: false,
                },
                {
                    name: "គម្រោង​ឆ្នាំ",
                    type: "grid",
                    flag: "y_n_1",
                    required: false,
                },
                {
                    name: "មូលដ្ឋានគិតចំណូល",
                    type: "text",
                    required: false,
                },
                {
                    name: "បរិមាណ",
                    type: "text",
                    required: false,
                },
                {
                    name: "សរុប​",
                    type: "text",
                    required: false,
                },
                {
                    name: "%ច្ប.២២",
                    type: "text",
                    required: false,
                }
            ],
            rowDisplay: "3grid", //1grid, 2grid, 3grid, 4grid
            dataFields: []
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