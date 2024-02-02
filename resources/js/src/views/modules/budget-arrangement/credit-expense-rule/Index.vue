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
      title: "CreditExpenseRule",
      api: apiConfig._apiObjective,
      dataAttributes: {
        tableStyle: 6,
        page_number: 1,
        offset: 0,
        dataGrid: "row",
        hasHeadingReport: false,
        popupFullscreen: true,
        headingReport: "CreditExpenseRule",
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
          label: "ជំពូក",
          width: 10,
          rowspan: 3,
          colspan: 0,
        },
        header2: {
          label: "គណនី",
          width: 10,
          rowspan: 3,
          colspan: 0,
        },
        header3: {
          label: "អនុគណនី",
          width: 10,
          rowspan: 3,
          colspan: 0,
        },
        header4: {
          label: "ចំណាត់ថ្នាក់ចំណាយ(តាមតារាងមាតិកាថវិកា)",
          width: "200",
          rowspan: 3,
          colspan: 0,
        }
      },
      data: {
        dataHeaders: {
          header1: {
            label: "មូលដ្ឋានគិតចំណូល",
            rowspan: 2,
            colspan: 0,
          },
          header2: {
            label: "បរិមាណ",
            rowspan: 2,
            colspan: 0,
          },
        },
        dataSubHeaders: {
          // header1: {
          //   label: "សរុប",
          //   rowspan: 0,
          //   colspan: 0,
          // },
          // header2: {
          //   label: "%ច្ប.២២",
          //   rowspan: 0,
          //   colspan: 0,
          // },
          // header3: {
          //   label: "សរុប​",
          //   rowspan: 0,
          //   colspan: 0,
          // },
          // header4: {
          //   label: "%ច្ប.២២",
          //   rowspan: 0,
          //   colspan: 0,
          // }
        },
        dataFillables: {
          field1: "chapter",
          field2: "account",
          field3: "sub_account",
          field4: "cost_classification",
          field5: "income_year_minus_n",
          field6: "f_rule_year_n_basic_cal_income", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income")
        },
        group_fields: { field1: "rev_group", field2: "rev_type" },
        summary: [
          {
            chapter: "",
            account: "",
            sub_account: "",
            cost_classification: "សរុប​រួមចំណូល​ (ក+ខ)",
            income_year_minus_n: "0.00",
            f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
            f_rule_year_n_quantity: "0.00",
            f_rule_year_n_credit_budget: "0.00",
            est_budget_year_n_semester_1: "0.00",
            est_budget_year_n_semester_2: "0.00",
            est_cal_year_n_total: "0.00",
            est__percentage_f_rule_year_n: "0.00",
            f_plan_year_n1_basic_cal_income: "0.00",
            f_plan_year_n1_quantity: "0.00",
            f_plan_total_income: "0.00",
            f_plan_percentage_year_n: "0.00",
          },
          {
            chapter: "",
            account: "",
            sub_account: "",
            cost_classification: "សរុប​រួមចំណូល​ (ក+ខ)",
            income_year_minus_n: "0.00",
          },
          {
            chapter: "",
            account: "",
            sub_account: "",
            cost_classification: "សរុប​រួមចំណូល​ (ក+ខ)",
            income_year_minus_n: "0.00",
          }
        ],
        data: [
          {
            rev_group: {
              chapter: "",
              account: "",
              sub_account: "",
              cost_classification: "ក្រុមទី១: ចំណូល​ពិត (ប្រភេទទី១+ប្រភេទទី២)",
              income_year_minus_n: "0.00",
              f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
            },
            rev_type: {
              chapter: "",
              account: "",
              sub_account: "",
              cost_classification: "ប្រភេទទី១: ចំណូល​សារពើពន្ធ",
              income_year_minus_n: "0.00",
              f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
            },
            rev_typedd: {
              chapter: "",
              account: "",
              sub_account: "",
              cost_classification: "ប្រភេទទី១: ចំណូល​សារពើពន្ធ",
              income_year_minus_n: "0.00",
            },
            children: [
              {
                chapter: "70",
                account: "",
                sub_account: "",
                cost_classification: "ចំណូលសារពើពន្ធក្នុងស្រុក",
                income_year_minus_n: "0.00",
                f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
                has_child: true,
                children: [
                  {
                    chapter: "",
                    account: "7001",
                    sub_account: "",
                    cost_classification: "ពន្ធផ្ទាល់ (ពន្ធលើផលទុន ប្រាក់ចំណូល)",
                    income_year_minus_n: "0.00",
                    f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
                    has_child: true,
                    children: [
                      {
                        chapter: "",
                        account: "",
                        sub_account: "70011",
                        cost_classification: "ពន្ធលើប្រាក់ចំណូល (រូបវន្តបុគ្គល)",
                        income_year_minus_n: "0.00",
                        f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
                      },
                      {
                        chapter: "",
                        account: "",
                        sub_account: "70012",
                        cost_classification: "ពន្ធលើប្រាក់ចំណូល (នីតិបុគ្គល)",
                        income_year_minus_n: "0.00",
                        f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
                      },
                      {
                        chapter: "",
                        account: "",
                        sub_account: "70013",
                        cost_classification: "ពន្ធលើប្រាក់បៀវត្ស",
                        income_year_minus_n: "0.00",
                        f_rule_year_n_basic_cal_income: "0.00", // f_rule_year_n_basic_cal_income => Finance Rule By Current Year (n=number of the curent year) (cal_income = calculated Income)
                      }
                    ]
                  }
                ]
              }
            ]
          },
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
    initRequest() {
      this.$vs.loading();
      this.getData();
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
