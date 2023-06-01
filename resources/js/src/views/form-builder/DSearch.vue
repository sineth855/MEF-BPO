<template>
    <vx-card class="mb-6">
        <h3 class="pb-4">ស្វែងរកទិន្នន័យ</h3>
        <div class="vx-row">
            <div :key="i" v-for="(formAttribute, i) in formAttributes" :class="styleClass">
                <!-- Form Input Text -->
                <template v-if="formAttribute.type == 'text' && formAttribute.required">
                    <label>{{ $t(formAttribute.name) }}</label>
                    <vs-input :placeholder="$t(formAttribute.name)" v-model="form.attribute[formAttribute.name]"
                        :name="formAttribute.name" size="small" class="mt-2 w-full" />
                </template>

                <!-- Form Input Number -->
                <template v-if="formAttribute.type == 'number' && formAttribute.required">
                    <label>{{ $t(formAttribute.name) }}</label>
                    <vs-input type="number" :placeholder="$t(formAttribute.name)"
                        v-model="form.attribute[formAttribute.name]" :name="formAttribute.name" size="small"
                        class="mt-2 w-full" />
                </template>

                <!-- Form Select -->
                <template v-if="formAttribute.type == 'select'" :class="styleClass" dclass="mt-2 w-full">
                    <label class="mb-2">{{ $t(formAttribute.name) }} <span v-if="formAttribute.required">*</span></label>
                    <span v-if="formAttribute.required">
                        <template v-if="formAttribute.hasFilter">
                            <v-select size="small"
                                v-on:input="onInitChange($event, formAttribute.filterObj, formAttribute.name, formAttribute.api)"
                                v-validate="''" v-model="form.attribute[formAttribute.name]" :name="formAttribute.name"
                                :options="data[formAttribute.name]" :dir="$vs.rtl ? 'rtl' : 'ltr'" class="mt-2 w-full" />
                            <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{
                                $t("required_" + formAttribute.name)
                            }}</span>
                        </template>
                        <template v-else>
                            <v-select size="small" v-validate="''" :name="formAttribute.name"
                                v-model="form.attribute[formAttribute.name]" :options="data[formAttribute.name]"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" class="mt-2 w-full" />
                            <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{
                                $t("required_" + formAttribute.name)
                            }}</span>
                        </template>
                    </span>
                    <span v-else>
                        <template v-if="formAttribute.hasFilter">
                            <v-select size="small" v-validate="''"
                                v-on:input="onInitChange($event, formAttribute.filterObj, formAttribute.name, formAttribute.api)"
                                v-model="form.attribute[formAttribute.name]" :name="formAttribute.name"
                                :options="data[formAttribute.name]" :dir="$vs.rtl ? 'rtl' : 'ltr'" class="mt-2 w-full" />
                        </template>
                        <template v-else>
                            <v-select size="small" v-validate="''" :name="formAttribute.name"
                                v-model="form.attribute[formAttribute.name]" :options="data[formAttribute.name]"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" class="mt-2 w-full" />
                        </template>
                    </span>
                </template>

                <!-- Form Textarea -->
                <template v-if="formAttribute.type == 'textarea' && formAttribute.required">
                    <label>{{ $t(formAttribute.name) }}</label>
                    <vs-textarea label="Label in Textarea" v-model="form.attribute[formAttribute.name]"
                        class="mt-2 w-full" />
                </template>

                <!-- Form Checkbox -->
                <template v-if="formAttribute.type == 'checkbox' && formAttribute.required">
                    <label>{{ $t(formAttribute.name) }}</label>
                    <vs-checkbox v-model="form.attribute[formAttribute.name]"> {{ $t(formAttribute.name) }}</vs-checkbox>
                </template>

                <!-- Form Date -->
                <div v-if="formAttribute.type == 'date'">
                    <label>{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <!-- <flat-pickr :name="formAttribute.name" v-model="form.attribute[formAttribute.name]"
                            class="w-full" /> -->
                        <vs-input :placeholder="$t(formAttribute.name)" v-model="form.attribute[formAttribute.name]"
                            :name="formAttribute.name" size="small" class="mt-2 w-full" />
                    </span>
                </div>

            </div>

        </div>
        <span class="pull-right">
            <vs-button type="filled" @click.prevent="initSearch" class="mt-2 block">{{ $t("btn_search") }}</vs-button>
        </span>
    </vx-card>
</template>

<script>

import axios from "@/axios.js"
import DForm from '@/views/form-builder/DForm.vue'
import { AgGridVue } from "ag-grid-vue"
import '@sass/vuexy/extraComponents/agGridStyleOverride.scss'
import vSelect from 'vue-select'

export default {
    props: {
        data: {
            required: true,
        },
        api: { type: String },
        formAttributes: {
            required: true
        },
        rowDisplay: { type: String }
    },

    components: {
        AgGridVue,
        vSelect,
        DForm
    },
    data() {
        return {
            _search_fields: {},
            form: {
                attribute: []
            }
        }
    },
    watch: {

    },
    computed: {
        validateForm() {
            return !this.errors.any()
        },
        usersData() {
            return this.$store.state.userManagement.users
        },
        paginationPageSize() {
            if (this.gridApi) return this.gridApi.paginationGetPageSize()
            else return 10
        },
        totalPages() {
            if (this.gridApi) return this.gridApi.paginationGetTotalPages()
            else return 0
        },
        currentPage: {
            get() {
                if (this.gridApi) return this.gridApi.paginationGetCurrentPage() + 1
                else return 1
            },
            set(val) {
                this.gridApi.paginationGoToPage(val - 1)
            }
        }
    },
    methods: {
        onInitChange($event, _formAttribute, _formName, _apiRequest) {
            // if (!this.validateForm) return
            // alert("testing");
            let _data = {
                param: this.form.attribute[_formName]
            };
            this.form.attribute[_formAttribute] = null;
            this.data[_formAttribute] = [];
            // alert(this.form.attribute[_formName]);
            return new Promise((resolve, reject) => {
                axios.post(_apiRequest, _data)
                    .then((response) => {
                        this.$vs.notify({
                            title: 'Message',
                            text: response.data.message,
                            iconPack: 'feather',
                            icon: 'icon-check-circle',
                            color: 'primary',
                            position: 'top-right'
                        });
                        for (let i = 0; i < response["data"]["data"].length; i++) {
                            let _d = {
                                "label": response["data"]["data"][i]["label"],
                                "value": response["data"]["data"][i]["value"],
                            }
                            this.data[_formAttribute].push(_d);
                        }
                        // response["data"].forEach(_formAttribute => {
                        //     alert("testing");
                        //     // let _d = {
                        //     //     [_formAttribute["name"]]: this.form.attribute[_formAttribute["name"]]
                        //     // }
                        //     // this.data[_formAttribute].push(_d);
                        // });
                        // this.data[_formAttribute] = [
                        //     {
                        //         "label": "tet",
                        //         "value": 1,
                        //     },
                        //     {
                        //         "label": "tet2",
                        //         "value": 3
                        //     },
                        // ];
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
        initSearch() {
            this._search_fields = [];
            let _formAttribute = this.form.attribute;
            // for (let i = 0; i < _formAttribute.length; i++) {
            //     let _nameField = _formAttribute[i]["name"] + ':' + this.form.attribute[_formAttribute[i]["name"]];
            //     this._search_fields.push(_nameField);
            // }
            this.$emit('searchQuery', _formAttribute);
        }
    },
    mounted() {

    },
    created() {
        if (this.rowDisplay == "1grid") {
            this.styleClass = "vx-col lg:w-1/1 w-full";
        }
        if (this.rowDisplay == "2grid") {
            this.styleClass = "vx-col lg:w-1/2 w-full";
        }
        if (this.rowDisplay == "3grid") {
            this.styleClass = "vx-col lg:w-1/3 w-full";
        }
        if (this.rowDisplay == "4grid") {
            this.styleClass = "vx-col lg:w-1/4 w-full";
        }
    }
}

</script>

<style lang="scss">
#page-user-list {
    .user-list-filters {
        .vs__actions {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-58%);
        }
    }
}
</style>
