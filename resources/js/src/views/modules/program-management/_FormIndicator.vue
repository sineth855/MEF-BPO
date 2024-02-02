<template>
    <vs-popup fullscreen classContent="popup-example" :title="$t('indicator')" :active.sync="showModalForm">
        <!-- <vx-card title="ទិន្នន័យការងារលម្អិត" class="mb-base">
            <vs-divider />
            <div class="vx-row">
                <d-form @clickForm="initTableData" ref="refModalForm" :data="data" :dataInfo="dataInfo"
                    :formAttributes="formAttributes" :api="api" :rowDisplay="rowDisplay"></d-form>

            </div>
        </vx-card> -->

        <d-table-list @clicked="initTableData" :api="api" ref="refInitPage" :allowDel="true" :title="title"
            :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :dataTables="data" :formAttributes="formAttributes"
            :rowDisplay="rowDisplay"></d-table-list>
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
        data: {
            required: true
        }
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
            showModalForm: false,
            // Data
            title: "indicator",
            api: apiConfig._apiKPISubProgram,
            dataAttributes: {
                tableStyle: 1,
                page_number: 1,
                offset: 0,
                dataGrid: "row",
                popupFullscreen: true,
                hideSearchBar: false
            },
            dataHeaders: {
                header1: "code",
                header2: "kpi_name_en",
                header3: "kpi_name_kh",
                header4: "order_level",
                // header5: "remark",//"ប្រចាំ/មិនប្រចាំ",
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
            data: {
                // data:
                //     [
                //         {
                //             account_code: "001",
                //             sub_account_code: "0011",
                //             title_en: "ចំណងជើងជាភាសាខ្មែរ",
                //             title_kh: "ចំណងជើងជាភាសាអង់គ្លេស",
                //             flag_type: "flag_type",
                //             qty: "qty",
                //             unit_price: "unit_price",
                //             total_amount: "total_amount",
                //             time_annual: "time_annual",
                //             total_annual_amount: "total_annual_amount",
                //             month: "month",
                //             expense_type: "expense_type",
                //             remark: "remark",
                //         }
                //     ],
            },
            formAttributes: [
                {
                    name: "sub_program_id",
                    type: "select",
                    required: true,
                    data: [],
                },
                // {
                //     name: "cluster_activity_id",
                //     type: "select",
                //     required: true,
                //     data: [],
                // },
                // {
                //     name: "activity_id",
                //     type: "select",
                //     required: true,
                //     data: [],
                // },
                {
                    name: "code",
                    type: "text",
                    required: true
                },
                {
                    name: "kpi_name_en",
                    type: "text",
                    required: true,
                    data: [],
                },
                {
                    name: "kpi_name_kh",
                    type: "text",
                    required: true,
                    data: [],
                },
                {
                    name: "order_level",
                    type: "number",
                    required: false,
                },
                {
                    name: "lbl_detail",
                    type: "grid",
                    flag: "y_n_minus_1",
                    required: false,
                },
                {
                    name: "remark",
                    type: "textarea",
                    required: false,
                }
            ],
            rowDisplay: "3grid", //1grid, 2grid, 3grid, 4grid
            dataFields: []
        }
    },
    methods: {
        showForm(data) {
            // this.dataInfo = data;
            console.log("KPIs", this.data);
            this.showModalForm = true;
            this.data = this.data.indicator
            // let _param = { task_id: 1 };
            // return new Promise((resolve, reject) => {
            //     axios.post(this.api, _param)
            //         .then((response) => {
            //             this.$vs.notify({
            //                 title: 'Message',
            //                 text: response.data.message,
            //                 iconPack: 'feather',
            //                 icon: 'icon-check-circle',
            //                 color: 'primary',
            //                 position: 'top-right'
            //             })
            //             if (response.data.data) {
            //                 this.data = response.data.data;
            //             } else {
            //                 this.data = this.data;
            //             }
            //             this.showModalForm = true;
            //         }).catch((error) => {
            //             reject(error)
            //             this.$vs.notify({
            //                 title: 'Message',
            //                 text: "មិនអាចដំណើរកាបានទេ,​ សូមត្រួតពិនិត្យពត៌មានឡើងវិញ។",
            //                 iconPack: 'feather',
            //                 icon: 'icon-check-circle',
            //                 color: 'danger',
            //                 position: 'top-right'
            //             })
            //             this.$vs.loading.close();
            //         })
            // })
        },
        submitForm() {
            this.dataFields = [];
            let _formAttribute = this.formAttributes;
            this.formAttributes.forEach(_formAttribute => {
                let _d = {
                    [_formAttribute["name"]]: this.form.attribute[_formAttribute["name"]]
                }
                this.dataFields.push(_d);
            });
            this.$validator.validateAll().then(result => {
                if (result) {
                    let _data = this.dataFields;
                    // this.$vs.loading();
                    if (this.dataInfo.id) {
                        // alert("Edit");
                        let _id = this.dataInfo.id;
                        // this.$vs.loading.close();
                        return new Promise((resolve, reject) => {
                            axios.put(this.api + '/' + _id, _data)
                                .then((response) => {
                                    this.$vs.notify({
                                        title: 'Message',
                                        text: response.data.message,
                                        iconPack: 'feather',
                                        icon: 'icon-check-circle',
                                        color: 'primary',
                                        position: 'top-right'
                                    })
                                    this.$emit('clickForm');
                                    // this.$router.push('/account/expense').catch(() => { })
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
                    } else {
                        return new Promise((resolve, reject) => {
                            axios.post(this.api, _data)
                                .then((response) => {
                                    this.$vs.notify({
                                        title: 'Message',
                                        text: response.data.message,
                                        iconPack: 'feather',
                                        icon: 'icon-check-circle',
                                        color: 'primary',
                                        position: 'top-right'
                                    })
                                    // this.$emit('clickForm');
                                    // this.$router.push('/account/expense').catch(() => { })
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
                    }

                }
                this.$vs.loading.close();
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
                search_field: searchQuery.searchFields
            }
            this.getDataTable(_search_criteria);
            return false;
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