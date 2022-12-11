<template>
    <d-table-list :title="title" :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :data="data"></d-table-list>
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
            dataAttributes: {
                pageLimit: 2,
                offset: 0,
                dataGrid: "row",
            },
            dataHeaders: {
                header1: "id",
                header2: "name",
                header3: "name_kh",
                header4: "remark",
                header5: "order_level",
            },
            data: {
                // order_status_choices: [
                //     { text: 'Pending', value: 'pending' },
                //     { text: 'Canceled', value: 'canceled' },
                //     { text: 'Delivered', value: 'delivered' },
                //     { text: 'On Hold', value: 'on_hold' }
                // ],
                // titles: [
                //     { text: 'Mr.', value: 'Mr.' },
                //     { text: 'Ms.', value: 'Ms.' },
                //     { text: 'Mrs.', value: 'Mrs.' }
                // ],
                // limit: 2,
                // total: 3,
                // data:[
                // {
                //     id: 3,
                //     name: "Objective",
                //     name_kh: "គោលបំណងទី3",
                //     order_level: 1,
                //     remark: "",
                //     ddd: "tttt12"
                // },
                // {
                //     id: 4,
                //     name: "Objective",
                //     name_kh: "គោលបំណងទី4",
                //     order_level: 1,
                //     remark: "",
                //     ddd: "tttt33"
                // },
                // {
                //     id: 1,
                //     name: "Objective",
                //     name_kh: "គោលបំណងទី១",
                //     order_level: 1,
                //     remark: "",
                //     ddd: "tttt"
                // },
                // {
                //     id: 2,
                //     name: "Objective",
                //     name_kh: "គោលបំណងទី2",
                //     order_level: 1,
                //     remark: "",
                //     ddd: "tttt"
                //     },
                //     {
                //         id: 3,
                //         name: "Objective",
                //         name_kh: "គោលបំណងទី3",
                //         order_level: 1,
                //         remark: "",
                //     ddd: "tttt"
                //     },
                //     {
                //         id: 4,
                //         name: "Objective",
                //         name_kh: "គោលបំណងទី4",
                //         order_level: 1,
                //         remark: "",
                //     ddd: "tttt"
                //     },
                //     {
                //         id: 1,
                //         name: "Objective",
                //         name_kh: "គោលបំណងទី១",
                //         order_level: 1,
                //         remark: "",
                //     ddd: "tttt"
                //     },
                //     {
                //         id: 2,
                //         name: "Objective",
                //         name_kh: "គោលបំណងទី2",
                //         order_level: 1,
                //         remark: "",
                //     ddd: "tttt"
                //     },
               
                // ]
            },
            entities: [
                {
                    id: 1,
                    label: "ក្រសួង"
                },
                {
                    id: 2,
                    label: "ក្រសួង"
                }
            ],
            dataArr: []
        }
    },
    components: {
        DTableList,
    },
    methods: {
        getData() {
            return new Promise((resolve, reject) => {
                axios.get(apiConfig._apiObjective +'?offset=0&limit=10&sort=id&order=desc')
                    .then((response) => {
                        this.data = response;
                        console.log("response", response);
                        // if (response.success) {
                        //     // this.$vs.loading.close();
                        // }
                    }).catch((error) => { reject(error) })
            })
        }
    },
    created() {
        // this.$vs.loading();
        this.getData();
        // for (let i = 0; i < this.entities.length; i++) {
        //     const _data = {
        //         id: this.entities[i]["id"],
        //         label: this.entities[i]["name"]
        //     };
        //     this.dataArr.push(_data);
        // }
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
