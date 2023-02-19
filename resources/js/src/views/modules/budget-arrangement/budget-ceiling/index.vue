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
        title: "CeilingBudget",
        api: apiConfig._apiObjective,
        dataAttributes: {
        tableStyle: 1,
        page_number: 1,
        offset: 0,
        dataGrid: "row",
        actionButton: [
            {
                icon: "DollarSignIcon",
                path: "/module/budget-arrangement/budget-ceiling/list",
                method: "View"
            },
            // {
            //     icon: "EditIcon",
            //     path: "#",
            //     method: "Edit"
            // },
            // {
            //     icon: "TrashIcon",
            //     path: "#",
            //     method: "Edit"
            // },
        ]
      },
      dataHeaders: {
        // header1: "id",
        header1: "title",
        header2: "title_kh",
        header3: "ceiling_year",
        header4: "progress",
        header5: "status",
        header6: "order_level",
      },
      data: {
          data: [
            {
              id: 1,
              title: "ពិដានប្រចាំឆ្នាំ២០១៩",
              title_kh: "ពិដានប្រចាំឆ្នាំ២០១៩",
              ceiling_year: "2022",
              progress: "100",
              status: "completed",
              order_level: 1
            },
            {
              id: 2,
              title: "ពិដានប្រចាំឆ្នាំ២០២០",
              title_kh: "ពិដានប្រចាំឆ្នាំ២០២០",
              ceiling_year: "2022",
              progress: "100",
              status: "completed",
              order_level: 1
            },
            {
              id: 3,
              title: "ពិដានប្រចាំឆ្នាំ២០២១",
              title_kh: "ពិដានប្រចាំឆ្នាំ២០២១",
              ceiling_year: "2022",
              progress: "100",
              status: "completed",
              order_level: 1
            },
          ],
          status: [
              {
                  label: "កំពុងដំណើរការ",
                  value: 1
              },
              {
                  label: "បញ្ចប់",
                  value: 2,
              },
              {
                  label: "បានអនុម័ត",
                  value: 3,
              }
          ],
        limit: 10,
        total: 3,
      },
      formAttributes: [
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
              name: "ceiling_year",
              type: "date",
              required: true
          },
          {
              name: "status",
              type: "select",
              required: true,
              hasDefault: true,
              defaultOptions: {
                  label: "កំពុងដំណើរការ",
                  value: 1,
              },
              options: [
                  {
                      label: "កំពុងដំណើរការ",
                      value: 1
                  },
                  {
                      label: "បញ្ចប់",
                      value: 2,
                  },
                  {
                      label: "បានអនុម័ត",
                      value: 3,
                  }
              ],
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
                      if (this.form.attribute["name"]) {
                        
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