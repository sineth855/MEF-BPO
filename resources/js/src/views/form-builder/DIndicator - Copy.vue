 <!-- ###### If data attribute has indicator mean can be able to allow create form data  -->
<template>
    <div class="mt-6">
        <h3>សូចនាករទិន្នន័យ</h3>
        <vs-table :data="dataInfo.indicator.data">
            <template slot="thead">
                <vs-th style="background-color: #28C76F; color: #ffffff; font-weight: bold;">{{ $t("no") }}</vs-th>
                <vs-th style="background-color: #28C76F; color: #ffffff; font-weight: bold;" :key="i"
                    v-for="(header, i) in dataHeaders">{{ $t(header) }}</vs-th>
                <vs-th style="background-color: #28C76F; color: #ffffff; font-weight: bold;">{{ $t("Action") }}</vs-th>
            </template>
            <template slot-scope="{data}" v-if="dataInfo.indicator.data.length > 0">
                <!-- <vs-tr style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                    <vs-td>{{ $t("no") }}</vs-td>
                    <vs-td>{{ $t("Indicator") }}</vs-td>
                    <vs-td>{{ $t("Indicator_kh") }}</vs-td>
                    <vs-td>{{ $t("order_level") }}</vs-td>
                    <vs-td>{{ $t("Action") }}</vs-td>
                </vs-tr> -->
                <template>
                    <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                        <vs-td>{{ indextr + 1 }}</vs-td>
                        <vs-td v-for="header in dataHeaders" :key="header.indextr">{{ tr[header] }}</vs-td>
                        <vs-td>
                            <template v-if="dataAttributes.actionButton">
                                <feather-icon style="cursor: pointer;" v-for="rowBtnAction in dataAttributes.actionButton"
                                    :key="rowBtnAction.indextr" :icon="rowBtnAction.icon"
                                    svgClasses="mr-2 w-5 h-5 hover:text-primary stroke-current"
                                    @click.stop="viewUrl(rowBtnAction)" />
                            </template>
                            <feather-icon style="cursor: pointer;" icon="EditIcon"
                                svgClasses="w-5 h-5 hover:text-primary stroke-current" @click.stop="initEdit(tr)" />
                            <feather-icon style="cursor: pointer;" v-if="dataAttributes.allowDel" icon="TrashIcon"
                                svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2"
                                @click.stop="initDel(tr.id)" />
                        </vs-td>
                    </vs-tr>
                </template>

                <vs-tr>
                    <vs-td :colspan="(Object.keys(data[0]).length)"></vs-td>
                    <vs-td>
                        <feather-icon style="cursor: pointer;" icon="PlusIcon" @click="addRow()"
                            svgClasses="mr-2 w-5 h-5 hover:text-primary stroke-current" /> Add More
                    </vs-td>
                </vs-tr>

                <!-- <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td>{{indextr+1}}</vs-td>
                    <vs-td>{{ tr.code}}-{{ tr.indicator_name }}</vs-td>
                    <vs-td>{{ tr.code}}-{{ tr.indicator_name_kh }}</vs-td>
                    <vs-td>{{ tr.order_level }}</vs-td>
                    <vs-td>
                        <feather-icon style="cursor: pointer;" icon="EditIcon"
                            svgClasses="w-5 h-5 hover:text-primary stroke-current" @click.stop="initEdit(tr)" />
                        <feather-icon style="cursor: pointer;" icon="TrashIcon"
                            svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2"
                            @click.stop="initDel(tr.id)" />
                    </vs-td>
                </vs-tr>
                <vs-tr>
                    <vs-td :colspan="(Object.keys(data[0]).length) - 1"></vs-td>
                    <vs-td>
                        <feather-icon style="cursor: pointer;" icon="PlusIcon" @click="addRow()"
                            svgClasses="mr-2 w-5 h-5 hover:text-primary stroke-current" /> Add More
                    </vs-td>
                </vs-tr> -->
            </template>
            <template v-else>
                <vs-tr>
                    <vs-td :colspan="(Object.keys(data[0]).length)"></vs-td>
                    <vs-td>
                        <feather-icon style="cursor: pointer;" icon="PlusIcon" @click="addRow()"
                            svgClasses="mr-2 w-5 h-5 hover:text-primary stroke-current" /> Add More
                    </vs-td>
                </vs-tr>
            </template>
        </vs-table>
        <vs-table>
            <template>
                <vs-tr>
                    <vs-td></vs-td>
                    <vs-td>
                        <feather-icon style="cursor: pointer;" icon="PlusIcon" @click="addRow()"
                            svgClasses="mr-2 w-5 h-5 hover:text-primary stroke-current" /> Add More
                    </vs-td>
                </vs-tr>
            </template>
        </vs-table>
    </div>
</template>

<script>
import axios from "@/axios.js";
import apiConfig from "@/apiConfig.js";
import { ref } from 'vue';

export default {
    props: {
        dataInfo: {
            required: true,
        },
        dataAttributes: {
            required: true
        },
    },
    data() {
        return {
            title: "inidicator",
            api: apiConfig._apiProgram,
            dataHeaders: {
                header1: "code",
                header2: "indicator_name",
                header3: "indicator_name_kh",
                header4: "order_level",
                header5: "status"
            },
            data: {
                data: [
                    {
                    }
                ],
                limit: 10,
                total: 3
            },
            formAttributes: [
                {
                    name: "program",
                    type: "select",
                    required: true,
                    hasDefault: false,
                    defaultOptions: {},
                    options: [
                        {
                            value: 1,
                            label: "កម្មវិធីទី១"
                        },
                        {
                            value: 2,
                            label: "កម្មវិធីទី២"
                        }
                    ]
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
                    required: true,
                    hasDefault: false,
                    defaultOptions: {},
                    options: [
                        {
                            value: 1,
                            label: "អង្គភាពទី១"
                        },
                        {
                            value: 2,
                            label: "អង្គភាពទី២"
                        }
                    ]
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
                    name: "remark",
                    type: "textarea",
                    required: false
                },
                {
                    name: "is_active",
                    type: "checkbox",
                    required: false
                }
            ],
            rowDisplay: "2grid", //1grid, 2grid, 3grid, 4grid
            dataFields: [],

            dataIndicators: [
                {
                    id: "23",
                    code: "12-",
                    indicator_name: "ឈ្មោះសូចនាករ",
                }
            ]
        }
    },
    components: {

    },
    methods: {
        addRow() {

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
        // console.log("found data", this.dataInfo);
        // this.dataIndicators = this.dataInfo.indicator;
        this.$vs.loading();
        this.getData();
    },
    watch: {
    }
}
</script>