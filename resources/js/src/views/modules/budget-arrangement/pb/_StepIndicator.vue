<template>
  <div id="table-demo">
    <!-- <table-state></table-state> -->
    <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" :allowDel="true" :title="title"
      :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :dataTables="data" :formAttributes="formAttributes"
      :rowDisplay="rowDisplay"></d-table-list>

      <!-- <vs-table :data="[]" style="overflow: scroll">
      
        <template slot="thead">
          <vs-th>កូដកម្មវិធី</vs-th>
          <vs-th :rowspan="3">សេចក្ដីពណ៌នា</vs-th>
          <vs-th>កូដសូចនាករ</vs-th>
          <vs-th>គម្រោងថវិកា<br />ឆ្នាំ២០២៣<br />(លានរៀល)</vs-th>
          <vs-th>គោលដៅសូចនាករសមិទ្ធកម្ម</vs-th>
          <vs-th></vs-th>
          <vs-th></vs-th>
          <vs-th></vs-th>
          <vs-th></vs-th>
        </template>
      
        <vs-tr :state="'warning'">
          <vs-td></vs-td>
          <vs-td></vs-td>
          <vs-td></vs-td>
          <vs-td>ឆ្នាំមុន-២០២១(អនុវត្តរួច)</vs-td>
          <vs-td>ឆ្នាំបច្ចុប្បន្ន-២០២២(កំពុងអនុវត្ត)</vs-td>
          <vs-td>ឆ្នាំគ្រោងថវិកា-២០២៣</vs-td>
          <vs-td>ឆ្នាំគ្រោងថវិកា​២០២៤</vs-td>
          <vs-td>ឆ្នាំគ្រោងថវិកា​២០២៥</vs-td>
          <vs-td></vs-td>
        </vs-tr>
      
        <vs-tr :state="'warning'">
          <vs-td></vs-td>
          <vs-td></vs-td>
          <vs-td></vs-td>
          <vs-td></vs-td>
          <vs-td></vs-td>
          <vs-td>គោលដៅ</vs-td>
          <vs-td>មូលហេតុផ្លាស់ប្ដូរ (ធៀបឆ្នាំ២០២២)</vs-td>
          <vs-td></vs-td>
          <vs-td></vs-td>
        </vs-tr>
      
        <vs-tr :state="'primary'">
          <vs-td></vs-td>
          <vs-td>១.១. អនុកម្មវិធីទី១.១ : ការគ្រប់គ្រងគោលនយោបាយសេដ្ឋកិច្ច ហិរញ្ញវត្ថុ និងគោលនយោបាយតាមវិស័យផ្សេងៗ</vs-td>
          <vs-td></vs-td>
          <vs-td>0.0</vs-td>
          <vs-td></vs-td>
          <vs-th></vs-th>
          <vs-th></vs-th>
          <vs-th></vs-th>
          <vs-th></vs-th>
        </vs-tr>
      
        <vs-tr>
          <vs-td></vs-td>
          <vs-td>-សូចនាករទី១ : ... </vs-td>
          <vs-td>PI-1011</vs-td>
          <vs-td></vs-td>
          <vs-td></vs-td>
          <vs-th></vs-th>
          <vs-th></vs-th>
          <vs-th></vs-th>
          <vs-th></vs-th>
        </vs-tr>
      
        <vs-tr>
          <vs-td></vs-td>
          <vs-td>-សូចនាករទី២ : ... </vs-td>
          <vs-td>PI-1011</vs-td>
          <vs-td></vs-td>
          <vs-td></vs-td>
          <vs-th></vs-th>
          <vs-th></vs-th>
          <vs-th></vs-th>
          <vs-th></vs-th>
        </vs-tr>
      </vs-table> -->
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
      title: "pb_heading_target_indicator",
      api: apiConfig._apiObjective,
      dataAttributes: {
        tableStyle: 7,
        page_number: 1,
        offset: 0,
        dataGrid: "row",
        hasHeadingReport: true,
        headingReport: "pb_heading_target_indicator"
      },
      dataHeaders: {
        header1: {
          width: 350,
          label: "សេចក្ដីពណ៌នា <br/> (បន្ថែមជួរដេកមួយសម្រាប់សូចនាករលទ្ធផលនីមួយៗ)",
          rowspan: 3,
          colspan: 0,
        },
        header2: {
          label: "កូដសូចនាករ",
          rowspan: 3,
          colspan: 0,
        },
        header3: {
          label: "គោលដៅសូចនាករសមិទ្ធកម្ម",
          rowspan: 0,
          colspan: 5,
        }
      },
      data: {
        dataHeaders: {
          header1: {
            label: "ឆ្នាំ២០២១(អនុវត្តរួច)",
            rowspan: 2,
            colspan: 0,
          },
          header2: {
            label: "ឆ្នាំ២០២២(កំពុងអនុវត្ត)",
            rowspan: 2,
            colspan: 0,
          },
          header3: {
            label: "លទ្ធផលអនុវត្តឆមាសទី១ ឆ្នាំ២០២២",
            rowspan: 2,
            colspan: 0,
          },
          header4: {
            label: "គ្រោងឆ្នាំ២០២៣",
            rowspan: 0,
            colspan: 2,
          }
        },
        dataSubHeaders: {
          header1: {
            label: "គោលដៅ",
            rowspan: 0,
            colspan: 0,
          },
          header2: {
            label: "មូលហេតុនៃការផ្លាស់ប្តូរ(ធៀបឆ្នាំ២០២២)",
            rowspan: 0,
            colspan: 0,
          },
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
        limit: 10,
        total: 3,
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
        }
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
      }else{
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