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
      title: "ProgramObjective",
      api: apiConfig._apiObjective,
      dataAttributes: {
        page_number: 1,
        offset: 0,
        dataGrid: "row",
      },
      dataHeaders: {
        // header1: "id",
        header1: "name",
        header2: "name_kh",
        header3: "ceiling_year",
        header4: "progress",
        header5: "status",
        header6: "order_level",
      },
      data: {
          data: [
            {
              id: 1,
              name: "ពិដានប្រចាំឆ្នាំ២០១៩",
              name_kh: "ពិដានប្រចាំឆ្នាំ២០១៩",
              ceiling_year: "2022",
              progress: "100",
              status: "completed",
              order_level: 1
            },
            {
              id: 2,
              name: "ពិដានប្រចាំឆ្នាំ២០២០",
              name_kh: "ពិដានប្រចាំឆ្នាំ២០២០",
              ceiling_year: "2022",
              progress: "100",
              status: "completed",
              order_level: 1
            },
            {
              id: 3,
              name: "ពិដានប្រចាំឆ្នាំ២០២១",
              name_kh: "ពិដានប្រចាំឆ្នាំ២០២១",
              ceiling_year: "2022",
              progress: "100",
              status: "completed",
              order_level: 1
            },
          ],
        limit: 10,
        total: 3,
        actionButton: [
            {
                icon: "DollarSignIcon",
                path: "/module/budget-arrangement/budget-ceiling/list",
            }
        ]
      },
      formAttributes: [
          {
              name: "objective",
              type: "select",
              required: true,
              data: [
                  {
                      "id": 1,
                      "name": "គោលបំណងទី១",
                      "name_kh": ""
                  },
                  {
                      "id": 2,
                      "name": "គោលបំណងទី២",
                      "name_kh": ""
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