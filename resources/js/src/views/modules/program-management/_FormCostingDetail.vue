<template>
    <vs-popup fullscreen classContent="popup-example" title="បញ្ជីគ្រោងថវិកាចំណាយ" :active.sync="showModalForm">
        <vx-card title="ទិន្នន័យការងារលម្អិត" class="mb-base">
            <vs-divider />
            <!-- Avatar -->
            <div class="vx-row">
                <!-- <d-form @clickForm="initTableData" ref="refModalForm" :data="data" :dataInfo="dataInfo"
                    :parentDataInfo="parentDataInfo" :formAttributes="formAttributes" :api="api"
                    :rowDisplay="rowDisplay" /> -->
            </div>
        </vx-card>
        <vx-card :title="''" code-toggler>
            <div class="p-3 mb-4" style="overflow: scroll;">
                <vs-table style="min-width: 500px;min-width: 200%;">
                    <template slot="thead" style="background: #28c76f;">
                        <vs-th>{{ $t("ល.រ") }}</vs-th>
                        <vs-th>{{ $t("គណនី") }}</vs-th>
                        <vs-th>{{ $t("អនុគណនី") }}</vs-th>
                        <vs-th>{{ $t("លេខ") }}</vs-th>
                        <vs-th>{{ $t("ឈ្មោះ") }}</vs-th>
                        <vs-th>{{ $t("ប្រចាំ/មិនប្រចាំ") }}</vs-th>
                        <vs-th>{{ $t("ចំនួន") }}</vs-th>
                        <vs-th>{{ $t("ឯកតា/រង្វាស់") }}</vs-th>
                        <vs-th>{{ $t("ចំនួនសរុប") }}</vs-th>
                        <vs-th>{{ $t("លើក/ឆ្នាំ") }}</vs-th>
                        <vs-th>{{ $t("សរុបប្រចាំឆ្នាំ") }}</vs-th>
                        <vs-th>{{ $t("ខែ") }}</vs-th>
                        <vs-th>{{ $t("ប្រភេទចំណាយតាមមុខសញ្ញា") }}</vs-th>
                        <vs-th>{{ $t("Action") }}</vs-th>
                    </template>
                    <tbody>
                        <tr v-for="(  ptr, index  ) in attribute">
                            <td> <b>{{ index + 1 }}</b></td>
                            <td><vs-input type="number" v-model="attribute[a][index]" v-validate="'required'"
                                    size="small" class="w-full" />
                            </td>
                            <td>
                                <vs-input type="number" v-model="attribute[a][index]" v-validate="'required'"
                                    size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-model="attribute[a][index]" v-validate="'required'"
                                    size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-model="attribute[a][index]" v-validate="'required'"
                                    size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-model="attribute[a][index]" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-model="attribute[a][index]" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-model="attribute[a][index]" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-model="attribute[a][index]" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-model="attribute[a][index]" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-model="attribute[a][index]" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-model="attribute[a][index]" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input v-validate="'required'" size="small" class="mb-2 pb-2 w-full" />
                            </td>
                            <td><button type="button" @click="removeElement(index)">Remove</button></td>
                        </tr>
                        <tr>
                            <td colspan="13"></td>
                            <td><button type="button" @click="addElement()">Add</button></td>
                        </tr>
                    </tbody>
                </vs-table>
            </div>

            <div class="my-5">
                <!-- <vs-pagination :total="calPaginNumber(dataTables.total / dataTables.limit)" v-model="current_page"></vs-pagination> -->
            </div>

        </vx-card>
        <!-- <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" :allowDel="true" :title="title"
            :dataInfo="dataInfo" :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :dataTables="data"
            :formAttributes="formAttributes" :rowDisplay="rowDisplay" @clickPrivateForm="initOpenForm"></d-table-list> -->
    </vs-popup>
</template>
<script>
import axios from "@/axios.js"
import apiConfig from "@/apiConfig.js"
import DForm from '@/views/form-builder/DForm.vue'
import DFormInput from '@/views/form-builder/form-control/DFormInput.vue'
import vSelect from 'vue-select'
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import DTableList from '@/views/form-builder/DTableList.vue'
import { ref } from 'vue';

export default {
    props: {
        api: { type: String },
    },
    data() {
        return {
            date: null,
            program_id: "",
            sub_program_id: "",
            entity_id: "",
            form: {
                attribute: {}
            },
            showModalForm: true,
            // Data
            title: "plan_budget",
            dataAttributes: {
                tableStyle: 2,
                page_number: 1,
                offset: 0,
                dataGrid: "row",
                popupFullscreen: true,
                hideSearchBar: false
            },
            dataInfo: {
                entity: "entity",
                entity_member: "entity_member",
                cluster_activity_id: "cluster_activity_id",
                activity_id: "activity_id",
                name_en: "name_en",
                name_kh: "name_kh",
                start_date: "start_date",
                end_date: "end_date",
                assign_to: ""
            },
            dataHeaders: {
                header1: "account_code",//"ប្រភេទ​តារាងតម្លៃ",
                header2: "sub_account_code",//"តារាង​តម្លៃ",
                header22: "line_no",//"តារាង​តម្លៃ",
                //header3: "title_en",//"ចំណងជើង",
                header34: "name_kh",//"ចំណងជើង",
                header4: "name_en",//"ចំណងជើង",
                header5: "flag_type",//"ប្រចាំ/មិនប្រចាំ",
                header6: "qty",//"ចំនួន",
                header55: "unit",//"តម្លៃ១លើក",
                header7: "unit_price", //តម្លៃ/ឯកតា
                header8: "total_amount", // តម្លៃសរុប
                header9: "time_annual",//"លើក/ឆ្នាំ",
                header10: "total_annual_amount",//"សរុបប្រចាំឆ្នាំ",
                header11: "month",//"ខែ",
                header12: "expense_type",//"មុខសញ្ញា",
                // header13: "remark",//"ផ្សេងៗ",
            },
            attribute: [
                {
                    a: "",
                    b: "",
                    c: "",
                    d: "",
                    e: "",
                    f: "",
                    g: "",
                    h: "",
                    i: "",
                    j: "",
                    k: "",
                }
            ],
            data: {},
            formAttributes: [
                {
                    name: "cluster_activity_id",
                    type: "select",
                    required: true,
                    hasFilter: true,
                    filterObj: "activity_id",
                    api: apiConfig._apiGetActivity,
                },
                {
                    name: "activity_id",
                    type: "select",
                    required: true,
                    hasFilter: true,
                    filterObj: "task_id",
                    api: apiConfig._apiGetTaskByAct,
                },
                {
                    name: "task_id",
                    type: "select",
                    required: true,
                    data: [],
                },
                {
                    name: "code",
                    type: "text",
                    required: true,
                    data: [],
                },
                {
                    name: "name_en",
                    type: "text",
                    required: true,
                    data: [],
                },
                {
                    name: "name_kh",
                    type: "text",
                    required: true,
                    data: [],
                },
                {
                    name: "order_level",
                    type: "number",
                    required: false,
                    data: [],
                },
                {
                    name: "remark",
                    type: "textarea",
                    required: false,
                    data: [],
                },
            ],
            rowDisplay: "3grid", //1grid, 2grid, 3grid, 4grid
            dataFields: [],
            dataInfo: {}
        }
    },
    methods: {
        showForm(data) {
            this.dataInfo = data;
            this.showModalForm = false;
            let _params = {
                sort: "",
                order: "",
                page_number: 1,
                search_field: [
                    // This ID will belong to the parent ID of this KPI
                    // data
                ],
                data_info: this.dataInfo
            }
            console.log("testing", _params);
            return new Promise((resolve, reject) => {
                axios.post(this.api, _params)
                    .then((response) => {
                        this.$vs.notify({
                            title: 'Message',
                            text: response.data.message,
                            iconPack: 'feather',
                            icon: 'icon-check-circle',
                            color: 'primary',
                            position: 'top-right'
                        })

                        if (response.data.data) {
                            this.data = response.data;
                        } else {
                            this.data = this.data;
                        }
                        this.showModalForm = true;
                    }).catch((error) => {
                        reject(error)
                        this.$vs.notify({
                            title: 'Message',
                            text: "មិនអាចដំណើរកាបានទេ,​ សូមត្រួតពិនិត្យពត៌មានឡើងវិញ។",
                            iconPack: 'feather',
                            icon: 'icon-check-circle',
                            color: 'danger',
                            position: 'top-right'
                        })
                        this.$vs.loading.close();
                    })
            })
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
                    data_info: _search_criteria.dataInfo
                };
            } else {
                _params = {
                    sort: _search_criteria.sort,
                    order: _search_criteria.order,
                    page_number: _search_criteria.page_number,
                };
            }

            return new Promise((resolve, reject) => {
                axios.post(this.api, _params)
                    .then((response) => {
                        if (response.data) {
                            this.data = response.data;
                        } else {
                            this.data = this.data;
                        }
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
                search_field: searchQuery.searchFields,
                dataInfo: searchQuery.dataInfo
            }
            this.getDataTable(_search_criteria);
            return false;
        },
        initOpenForm(data) {
            this.$refs.refOpenPrivatePopupForm.showForm(data);
        },
        addElement() {
            let _attribute = {
                a: "",
                b: "",
                c: "",
                d: "",
                e: "",
                f: "",
                g: "",
                h: "",
                i: "",
                j: "",
                k: "",
            };
            this.attribute.push(_attribute);
        },
        removeElement(index) {
            this.attribute.splice(index, 1);
        }
    },
    created() {
        // this.$vs.loading();
        // this.getData();
        if (this.rowDisplay == "1grid") {
            this.styleClass = "vx-col lg:w-1/1 w-full mt-4";
        }
        if (this.rowDisplay == "2grid") {
            this.styleClass = "vx-col lg:w-1/2 w-full mt-4";
        }
        if (this.rowDisplay == "3grid") {
            this.styleClass = "vx-col lg:w-1/3 w-full mt-4";
        }
        if (this.rowDisplay == "4grid") {
            this.styleClass = "vx-col lg:w-1/4 w-full mt-4";
        }
        if (this.rowDisplay == "full-grid") {
            this.styleClass = "vx-col lg:w-1/1 w-full";
        }
    },
    computed: {
        isSmallerScreen() {
            return this.$store.state.windowWidth < 768
        }
    },
    components: {
        DForm,
        vSelect,
        DTableList
    },
}
</script>