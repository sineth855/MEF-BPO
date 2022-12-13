<template>
    <vx-card :title="$t(title)" code-toggler>
        <modal-objective @clicked="initTableData" ref="refModalForm" 
        :data="dataTables" :api="api" :formAttributes="formAttributes" 
        :rowDisplay="rowDisplay"></modal-objective>

        <div class="flex flex-wrap-reverse items-center data-list-btn-container">
            <!-- ADD NEW -->
            <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary"
                @click="openForm">
                <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
                <span class="ml-2 text-base text-primary">{{ $t("AddNew") }}</span>
            </div>
        </div>

        <d-search @clicked="initTableData" :data="dataTables" :api="api" :formAttributes="formAttributes" 
        :rowDisplay="'4grid'" :dataInfo="''"></d-search>

        <vs-table v-if="dataTables.data && dataTables.data.length" :max-items="dataTables.limit" :data="dataTables.data">
            <template slot="thead">
                <vs-th>{{ 'No' }}</vs-th>
                <vs-th :key="i" v-for="(header, i) in dataHeaders">{{ header }}</vs-th>
                <vs-th>{{ 'Action' }}</vs-th>
            </template>
            
            <template slot-scope="{data}">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td>{{ calPageIncreaseNumber(dataTables.limit, indextr) }}</vs-td>
                    <vs-td v-for="header in dataHeaders" :key="header.indextr">{{ tr[header] }}</vs-td>
                    <vs-td>
                        <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" @click.stop="initEdit(tr)" />
                        <feather-icon v-if="allowDel" icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2"
                            @click.stop="initDel(tr.id)" />
                    </vs-td>
                </vs-tr>
            </template>
        </vs-table>

        <div class="my-5">
            <vs-pagination :total="calPaginNumber(dataTables.total / dataTables.limit)" v-model="current_page"></vs-pagination>
            <!-- <p class="mb-3">Current Page: {{ current_page }}</p>
            <vs-button @click="current_page++">Increment</vs-button>
            <vs-button class="ml-4 mb-4" @click="current_page--">Decrement</vs-button> -->
        </div>

    </vx-card>
</template>

<script>

    import axios from "@/axios.js"
    import ModalObjective from '@/views/modules/program-management/modal/_Objective.vue'
    import DSearch from '@/views/form-builder/DSearch.vue'
    import { stringify } from 'querystring';
    import { ref } from 'vue';
    export default {
        props: {
            title: {
                type: String,
                required: true
            },
            dataAttributes: {
                required: true,
            },
            dataHeaders: {
                required: true,
            },
            dataTables: {
                required: true,
            },
            allowDel: {
                type: Boolean
            },
            api: { type: String },
            formAttributes: { required: true },
            rowDisplay: { type: String }
        },
        data() {
            return {
                currentx: 0,
                current_page: 1,
                dataId: 0
            }
        },
        components: {
            ModalObjective,
            DSearch
        },
        methods: {
            openForm() {
                this.$refs.refModalForm.initForm();
            },
            calPaginNumber(n) {
                // alert(n);
                let _newVal = 0;
                if (Number(n) === n && n % 1 === 0) {
                    _newVal = n;
                } else {
                    _newVal = Math.floor(n + 1);
                }
                return _newVal;
            },
            calPageIncreaseNumber(_page_limit, index) {
                let _offset = (this.current_page - 1) * _page_limit;
                let _result = _offset + (index + 1);
                return _result;
            },
            initTableData() {
                this.$emit('clicked', this.current_page);
            },
            initDel(id) {
                this.dataId = id;
                this.$vs.dialog({
                    type: 'confirm',
                    color: 'danger',
                    title: `Confirm`,
                    text: 'តើអ្នកពិតជាចង់ធ្វើការលុបទិន្នន័យនេះជារៀងរហូត?',
                    accept: this.acceptAlert
                })
            },
            acceptAlert() {
                let id = this.dataId;

                return new Promise((resolve, reject) => {
                    axios.delete(this.api+'/'+id)
                        .then((response) => {
                            this.$vs.notify({
                                title: 'Message',
                                text: response.data.message,
                                iconPack: 'feather',
                                icon: 'icon-check-circle',
                                color: 'primary',
                                position: 'top-right'
                            })
                            this.$emit('clicked', this.current_page);
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
                        })
                })
            },
            initEdit(data) {
                this.$refs.refModalForm.initForm(data);
            }

        },
        created() {
            this.$vs.loading.close();
        },
        watch: {
            current_page: function (val) {
                this.$emit('clicked', val)
            }
        }
    }
</script>

<style>
th.th-width-300 {
    min-width: 260px !important;
}

td.td-width-150 {
    min-width: 150px !important;
}

table tr td,
th {
    border: 1px solid #d7d7d7;
}

th {
    text-align: center !important;
    /* display: inline; */
}

th.rotate {
    transform: rotate(-90deg)
}

.vs-table--thead th .vs-table-text {
    text-transform: uppercase;
    font-weight: 600;
    text-align: center;
    display: inline !important;
}
</style>


<style lang="scss">
#data-list-list-view {
    font-family: 'Khmer MEF1';

    .vs-con-table {

        /*
      Below media-queries is fix for responsiveness of action buttons
      Note: If you change action buttons or layout of this page, Please remove below style
    */
        @media (max-width: 689px) {
            .vs-table--search {
                margin-left: 0;
                max-width: unset;
                width: 100%;

                .vs-table--search-input {
                    width: 100%;
                }
            }
        }

        @media (max-width: 461px) {
            .items-per-page-handler {
                display: none;
            }
        }

        @media (max-width: 341px) {
            .data-list-btn-container {
                width: 100%;

                .dd-actions,
                .btn-add-new {
                    width: 100%;
                    margin-right: 0 !important;
                }
            }
        }

        .product-name {
            max-width: 23rem;
        }

        .vs-table--header {
            display: flex;
            flex-wrap: wrap;
            margin-left: 1.5rem;
            margin-right: 1.5rem;

            >span {
                display: flex;
                flex-grow: 1;
            }

            .vs-table--search {
                padding-top: 0;

                .vs-table--search-input {
                    padding: 0.9rem 2.5rem;
                    font-size: 1rem;

                    &+i {
                        left: 1rem;
                    }

                    &:focus+i {
                        left: 1rem;
                    }
                }
            }
        }

        .vs-table {
            border-collapse: separate;
            border-spacing: 0 1.3rem;
            padding: 0 1rem;

            tr {
                box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .05);

                td {
                    padding: 20px;

                    &:first-child {
                        border-top-left-radius: .5rem;
                        border-bottom-left-radius: .5rem;
                    }

                    &:last-child {
                        border-top-right-radius: .5rem;
                        border-bottom-right-radius: .5rem;
                    }
                }

                td.td-check {
                    padding: 20px !important;
                }
            }
        }

        .vs-table--thead {
            th {
                padding-top: 0;
                padding-bottom: 0;

                .vs-table-text {
                    text-transform: uppercase;
                    font-weight: 600;
                }
            }

            th.td-check {
                padding: 0 15px !important;
            }

            tr {
                background: none;
                box-shadow: none;
            }
        }

        .vs-table--pagination {
            justify-content: center;
        }
    }
}
</style>
