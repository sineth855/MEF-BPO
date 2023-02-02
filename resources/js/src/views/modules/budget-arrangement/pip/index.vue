<template>
  <div id="table-demo">
    <!-- <table-state></table-state> -->
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
      title: "pip_form_title",
      api: apiConfig._apiObjective,
      dataAttributes: {
        tableStyle: 3,
        popupFullscreen: true,
        page_number: 1,
        offset: 0,
        dataGrid: "row",
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
          width: 350,
          label: "ឈ្មោះកម្មវិធី/ ឈ្មោះអនុកម្មវិធី /ឈ្មោះគម្រោង",
          rowspan: 2,
          colspan: 0,
        },
        header2: {
          label: "លេខ PIP",
          rowspan: 2,
          colspan: 0,
        },
        header3: {
          label: "ស្ថានភាពគម្រោង",
          rowspan: 2,
          colspan: 0,
        },
        header4: {
          label: "ប្រភេទគម្រោង",
          rowspan: 2,
          colspan: 0,
        },
        header5: {
          label: "ចំណាត់ថ្នាក់ប៉ាន់ស្ថានសរុប",
          rowspan: 0,
          colspan: 4,
        },
        header6: {
          label: "ហិរញ្ញប្បទានសន្យាផ្តល់",
          rowspan: 0,
          colspan: 4,
        },
        header7: {
          label: "តម្រូវការហិរញ្ញប្បទានបំពេញបន្ថែម",
          rowspan: 0,
          colspan: 4,
        },
        header8: {
          label: "ប្រភពហិរញ្ញប្បទាន",
          rowspan: 2,
          colspan: 0,
        },
        header9: {
          label: "សម្គាល់",
          rowspan: 2,
          colspan: 0,
        },
        header10: {
          width: 80,
          label: "ប៊ូតុងសកម្ម",
          rowspan: 2,
          colspan: 0,
        }
      },
      data: {
        dataHeaders: {
          // sheader1: "២០២៣",
          // sheader2: "២០២៤",
          // sheader3: "២០២៥",
          // sheader4: "សរុប៣ឆ្នាំ",
          // sheader5: "២០២៣",
          // sheader6: "២០២៤",
          // sheader7: "២០២៥",
          // sheader8: "សរុប៣ឆ្នាំ",
          // sheader9: "២០២៣",
          // sheader10: "២០២៤",
          // sheader11: "២០២៥",
          // sheader12: "សរុប៣ឆ្នាំ"
          header1: {
            label: "២០២៣",
            rowspan: 0,
            colspan: 0,
          },
          header2: {
            label: "២០២៤",
            rowspan: 0,
            colspan: 0,
          },
          header3: {
            label: "២០២៥",
            rowspan: 0,
            colspan: 0,
          },
          header4: {
            label: "សរុប៣ឆ្នាំ",
            rowspan: 0,
            colspan: 0,
          },

          header5: {
            label: "២០២៣",
            rowspan: 0,
            colspan: 0,
          },
          header6: {
            label: "២០២៤",
            rowspan: 0,
            colspan: 0,
          },
          header7: {
            label: "២០២៥",
            rowspan: 0,
            colspan: 0,
          },
          header8: {
            label: "សរុប៣ឆ្នាំ",
            rowspan: 0,
            colspan: 0,
          },

          header9: {
            label: "២០២៣",
            rowspan: 0,
            colspan: 0,
          },
          header10: {
            label: "២០២៤",
            rowspan: 0,
            colspan: 0,
          },
          header11: {
            label: "២០២៥",
            rowspan: 0,
            colspan: 0,
          },
          header12: {
            label: "សរុប៣ឆ្នាំ",
            rowspan: 0,
            colspan: 0,
          },
        },
        dataSubHeaders: {
          
        },
        data: [
          {
            id: 1,
            name: "សរុបរួមក្រសួង​សេដ្ឋ​កិច្ច​និង​ហិរញ្ញវត្ថ",
            name_kh: "សរុបរួមក្រសួង​សេដ្ឋ​កិច្ច​និង​ហិរញ្ញវត្ថ",
            remark: "",
            status: 1,
            order_level: "",
            hasColspan: false,
            values: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, "", ""],
            data: {
              summary: {
                id: 1,
                name: "កម្មវិធីទី១៖ ការគ្រប់គ្រងចំណូលសាធារណៈ និងទ្រព្យសម្បត្តិរដ្ឋ",
                values: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, "", ""],
              },
              children: [
                {
                  id: 1,
                  name: "អនុកម្មវិធី ៣.១ ៖ អគ្គនាយកដ្ឋានគយ និងរដ្ឋាករកម្ពុជា",
                  values: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, "", ""],
                  data: [
                    
                  ],
                  dataDetails: [
                    {
                      id: 1,
                      name: "១២២. គម្រោងសាងសង់អគារសាខាពន្ធដារខណ្ឌចំនួន០១ និងអគារការិយាល័យពន្ធដារស្រុកស្ទឹងហាវ ០១",
                      entity: {},
                      values: ["659", "គម្រោងស្នើសុំថ្មី", "វិនិយោគជាទុន", 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, "", ""],
                      data: [
                        
                      ]
                    },
                    {
                      id: 2,
                      name: "២. គម្រោងជួសជុលនិងកែលម្អអគារសាខាពន្ធដារខណ្ឌចំនួន០១ ការិយាល័យពន្ធដារក្រុងចំនួន០១ និងស្រុកចំនួន ០១  ",
                      entity: {},
                      values: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, "", ""],
                      data: [
                        
                      ]
                    },
                  ]
                },
                {
                  id: 1,
                  name: "អនុកម្មវិធី ៣.២ ៖ អគ្គនាយកដ្ឋានពន្ធដារ",
                  values: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, "", ""],
                  data: [

                  ],
                  dataDetails: [
                    {
                      id: 1,
                      name: "១. គម្រោងសាងសង់អគារសាខាពន្ធដារខណ្ឌចំនួន០១ និងអគារការិយាល័យពន្ធដារស្រុកស្ទឹងហាវ ០១",
                      entity: {},
                      values: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, "", ""],
                      data: [

                      ]
                    },
                    {
                      id: 2,
                      name: "២. គម្រោងជួសជុលនិងកែលម្អអគារសាខាពន្ធដារខណ្ឌចំនួន០១ ការិយាល័យពន្ធដារក្រុងចំនួន០១ និងស្រុកចំនួន ០១  ",
                      entity: {},
                      values: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, "", ""],
                      data: [

                      ]
                    },
                  ]
                },
              ]
            }
          }
        ],
        limit: 10,
        total: 3,
      },
      formAttributes: [
        {
          name: "objective",
          type: "select",
          required: true,
          hasDefault: true,
          defaultOptions: {
            label: "គោលបំណងទី១",
            value: 1,
          },
          options: [
            {
              label: "គោលបំណងទី១",
              value: 1,
            },
            {
              label: "គោលបំណងទី២",
              value: 2,
            }
          ],
        },
        {
          name: "pip_project_type",
          type: "select",
          required: true,
          options: [
            {
              value: 1,
              label: "គម្រោងវិនិយោគជាទុន"
            },
            {
              value: 2,
              label: "គម្រោងជំនួយបច្ចេកទេស"
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
          name: "responsible_entity",
          type: "select",
          options: [
            { id: 1, label: 'អង្គភាពទី១' },
            { id: 3, label: 'អង្គភាពទី២' },
            { id: 2, label: 'អង្គភាពទី៣' },
          ],
          required: true
        },
        {
          name: "responsible_person",
          type: "text",
          required: true
        },
        {
          name: "order_level",
          type: "number",
          required: false
        },
        {
          name: "ប្រភពហិរញ្ញបទាន",
          type: "checkbox",
          required: false,
          attributes: [
            {
              name: "ថវិកាជាតិ",
              value: "1"
            },
            {
              name: "ជំនួយឥតសំណង",
              value: "2"
            },
            {
              name: "ឥណទានមិនមែនសម្បទាន",
              value: "3"
            }
          ]
        },

        {
          name: "ស្ថានភាពនៃការអនុវត្តគម្រោង ",
          type: "textarea",
          required: false
        },
        {
          name: "សមត្ថភាពអនុវត្តគម្រោង ",
          type: "textarea",
          required: false
        },
      ],
      rowDisplay: "2grid", //1grid, 2grid, 3grid, 4grid
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
