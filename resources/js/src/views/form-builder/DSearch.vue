<template>
    <vx-card class="mb-6">
        <h3>ស្វែងរកទិន្នន័យ</h3>
        <div class="vx-row">
            <div :key="i" v-for="(formAttribute, i) in formAttributes" :class="styleClass">
                <!-- Form Input Text -->
                <div v-if="formAttribute.type == 'text'">
                    <vs-input v-if="formAttribute.required" :placeholder="$t(formAttribute.name)" v-model="form.attribute[formAttribute.name]"
                        :name="formAttribute.name" class="mt-5 w-full" />
                </div>
                <!-- Form Input Number -->
                <div v-if="formAttribute.type == 'number'">
                    <vs-input v-if="formAttribute.required" :placeholder="$t(formAttribute.name)" v-model="form.attribute[formAttribute.name]"
                        :name="formAttribute.name" class="mt-5 w-full" />
                </div>
                <!-- Form Select -->
                <div v-if="formAttribute.type == 'select'">
                    <vs-select v-if="formAttribute.required" v-model="formAttribute[i]" class="mt-5 w-full">
                        <vs-select-item :key="item.value" :value="item.value" :text="item.text"
                            v-for="item in formAttribute.data" />
                    </vs-select>
                </div>
    
            </div>
    
        </div>
        <span class="pull-right">
            <vs-button type="filled" @click.prevent="initSearch" class="mt-5 block">{{$t("btn_search")}}</vs-button>
        </span>
    </vx-card>
</template>

<script>

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
            form: {
                attribute: []
            }
        }
    },
    watch: {
        
    },
    computed: {
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
        initSearch() {
            alert("here is search result!");
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
