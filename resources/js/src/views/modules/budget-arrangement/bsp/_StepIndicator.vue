<template>
  <div class="flex">
    <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" :allowDel="true" :title="title"
      :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :dataTables="data" :formAttributes="formAttributes"
      :rowDisplay="rowDisplay" @emitDataForm="initDataForm"></d-table-list>
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
      title: "bsp_heading_target_kpi",
      api: apiConfig._apiObjective,
      dataAttributes: {
        tableStyle: 5,
        page_number: 1,
        offset: 0,
        dataGrid: "row",
        hasHeadingReport: true,
        headingReport: "bsp_heading_target_kpi",
        actionButton: [
          {
            icon: "DollarSignIcon",
            path: "/module/budget-arrangement/budget-ceiling/list",
            method: "View"
          }
        ],
        popupFullscreen: true
      },
      dataHeaders: {
        header1: {
          width: 350,
          label: "bsp_text_indicator_description",
          rowspan: 3,
          colspan: 0,
        },
        header2: {
          label: "code_indicator",
          rowspan: 3,
          colspan: 0,
        },
        header3: {
          label: "bsp_text_annual_budget_plan",
          rowspan: 3,
          colspan: 0,
        },
        header4: {
          label: "bsp_text_performance_indicator_target",
          rowspan: 0,
          colspan: 6,
        },
        // header8: {
        //   label: "action",
        //   rowspan: 0,
        //   colspan: 0,
        // }
      },
      data: {
        dataHeaders: {
          header1: {
            label: "ឆ្នាំមុន-២០២១(អនុវត្តរួច)",
            rowspan: 2,
            colspan: 0,
          },
          header2: {
            label: "ឆ្នាំបច្ចុប្បន្ន-២០២២(កំពុងអនុវត្ត)",
            rowspan: 2,
            colspan: 0,
          },
          header3: {
            label: "ឆ្នាំគ្រោងថវិកា-២០២៣",
            rowspan: 0,
            colspan: 2,
          },
          header4: {
            label: "ឆ្នាំគ្រោងថវិកា​២០២៤",
            rowspan: 2,
            colspan: 0,
          },
          header5: {
            label: "ឆ្នាំគ្រោងថវិកា២០២៥",
            rowspan: 2,
            colspan: 0,
          },
        },
        dataSubHeaders: {
          header1: {
            label: "គោលដៅ",
            rowspan: 0,
            colspan: 0,
          },
          header2: {
            label: "មូលហេតុផ្លាស់ប្ដូរ (ធៀបឆ្នាំ២០២២)",
            rowspan: 0,
            colspan: 0,
          },
        },
        data: [
          {
            id: 1,
            name: "កម្មវិធី",
            name_kh: "កម្មវិធី",
            remark: "",
            status: 1,
            hasColspan: true,
            colspan: 9,
            rowspan: 0,
            order_level: "",
            indicators: [
              {
                id: 1,
                code: "PI-1011",
                indicator: "-សូចនាករទី១ : ... ",
                indicator_kh: "-សូចនាករទី១ : ... ",
                status: "active"
              },
              {
                id: 1,
                code: "PI-1011",
                indicator: "-សូចនាករទី១ : ... ",
                indicator_kh: "-សូចនាករទី១ : ... ",
                status: "active"
              },
              {
                id: 1,
                code: "PI-1011",
                indicator: "-សូចនាករទី១ : ... ",
                indicator_kh: "-សូចនាករទី១ : ... ",
                status: "active"
              },
            ],
            children: [
              {
                id: 1,
                name: "១.១. អនុកម្មវិធីទី១.១ : ការគ្រប់គ្រងគោលនយោបាយសេដ្ឋកិច្ច ហិរញ្ញវត្ថុ និងគោលនយោបាយតាមវិស័យផ្សេងៗ",
                name_kh: "១.១. អនុកម្មវិធីទី១.១ : ការគ្រប់គ្រងគោលនយោបាយសេដ្ឋកិច្ច ហិរញ្ញវត្ថុ និងគោលនយោបាយតាមវិស័យផ្សេងៗ",
                responsible_entity: { id: 1, name: "ឈ្មោះអង្គភាពទទួលបន្ទុក", name_kh: "ឈ្មោះអង្គភាពទទួលបន្ទុក" },
                responsible_person: { id: 1, name: "បុគ្គលទទួលបន្ទុក", name: "បុគ្គលទទួលបន្ទុក" },
                order_level: 1,
                indicators: [
                  {
                    id: 1,
                    code: "PI-1011",
                    indicator: "-សូចនាករទី១ : ... ",
                    indicator_kh: "-សូចនាករទី១ : ... ",
                    status: "active"
                  },
                  {
                    id: 1,
                    code: "PI-1011",
                    indicator: "-សូចនាករទី១ : ... ",
                    indicator_kh: "-សូចនាករទី១ : ... ",
                    status: "active"
                  },
                  {
                    id: 1,
                    code: "PI-1011",
                    indicator: "-សូចនាករទី១ : ... ",
                    indicator_kh: "-សូចនាករទី១ : ... ",
                    status: "active"
                  },
                ],
                plan_budgets: { year: 2023, budget: '122,222,22' },
                previous_budgets: { year: 2021, budget: '122,222,22' },
                current_budgets: { year: 2021, budget: '122,222,22' },
                target_budgets: { year: 2023, target: '12', revised_budget_note: "" },
                budget_preparation: {
                  year: 2023, budget: '122,222',
                  year: 2024, budget: '23,444'
                },
                children: [
                  {
                    id: 1,
                    name: "១.១.១. ចង្កោមសកម្មភាពទី១ : គាំទ្រ សម្របសម្រួល និងគ្រប់គ្រងការងាររដ្ឋបាលរបស់អគ្គនាយកដ្ឋាន",
                    name_kh: "១.១.១. ចង្កោមសកម្មភាពទី១ : គាំទ្រ សម្របសម្រួល និងគ្រប់គ្រងការងាររដ្ឋបាលរបស់អគ្គនាយកដ្ឋាន",
                    responsible_entity: { id: 1, name: "ឈ្មោះអង្គភាពទទួលបន្ទុក", name_kh: "ឈ្មោះអង្គភាពទទួលបន្ទុក" },
                    responsible_person: { id: 1, name: "បុគ្គលទទួលបន្ទុក", name: "បុគ្គលទទួលបន្ទុក" },
                    order_level: 1,
                    indicators: [
                      {
                        id: 1,
                        code: "PI-1011",
                        indicator: "-សូចនាករទី១ : ... ",
                        indicator_kh: "-សូចនាករទី១ : ... ",
                        status: "active"
                      },
                      {
                        id: 1,
                        code: "PI-1011",
                        indicator: "-សូចនាករទី១ : ... ",
                        indicator_kh: "-សូចនាករទី១ : ... ",
                        status: "active"
                      },
                      {
                        id: 1,
                        code: "PI-1011",
                        indicator: "-សូចនាករទី១ : ... ",
                        indicator_kh: "-សូចនាករទី១ : ... ",
                        status: "active"
                      },
                    ],
                    children: [
                      {
                        id: 1,
                        name: "១.១.១.១. សកម្មភាពទី១ : បំពេញមុខជាលេខាធិការដ្ឋាន",
                        name_kh: "១.១.១.១. សកម្មភាពទី១ : បំពេញមុខជាលេខាធិការដ្ឋាន",
                        responsible_entity: { id: 1, name: "ឈ្មោះអង្គភាពទទួលបន្ទុក", name_kh: "ឈ្មោះអង្គភាពទទួលបន្ទុក" },
                        responsible_person: { id: 1, name: "បុគ្គលទទួលបន្ទុក", name: "បុគ្គលទទួលបន្ទុក" },
                        order_level: 1,
                        indicators: [
                          {
                            id: 1,
                            code: "PI-1011",
                            indicator: "-សូចនាករទី១ : ... ",
                            indicator_kh: "-សូចនាករទី១ : ... ",
                            status: "active"
                          },
                          {
                            id: 1,
                            code: "PI-1011",
                            indicator: "-សូចនាករទី១ : ... ",
                            indicator_kh: "-សូចនាករទី១ : ... ",
                            status: "active"
                          },
                          {
                            id: 1,
                            code: "PI-1011",
                            indicator: "-សូចនាករទី១ : ... ",
                            indicator_kh: "-សូចនាករទី១ : ... ",
                            status: "active"
                          },
                        ],
                      }
                    ]
                  }
                ]
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
        sub_program_id: [
          {
            "label": "អនុកម្មវិធីទី១",
            "value": 1,
          },
          {
            "label": "អនុកម្មវិធីទី២",
            "value": 2,
          }
        ],
        cluster_activity_id: [
          {
            "label": "ចង្កោមសកម្មភាពទី១",
            "value": 1,
          },
          {
            "label": "ចង្កោមសកម្មភាពទី២",
            "value": 2,
          }
        ],
        limit: 10,
        total: 3,
      },
      formAttributes: [
        {
          name: "program_id",
          type: "select",
          required: true,
          options: [],
        },
        {
          name: "sub_program_id",
          type: "select",
          required: true,
          options: [],
        },
        {
          name: "cluster_activity_id",
          type: "select",
          required: true,
          options: [],
        },
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
          name: "code_indicator",
          type: "text",
          required: true
        },
        {
          name: "target",
          type: "text",
          required: true
        },
        {
          name: "change_reason",
          type: "text",
          required: true
        },
      ],
      rowDisplay: "3grid", //1grid, 2grid, 3grid, 4grid
      dataFields: []
    }
  },
  components: {
    DTableList,
  },
  methods: {
    initDataForm() {
      // alert("testing");
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