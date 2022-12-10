<template>
    <d-table-list :title="title" :dataAttributes="dataAttributes" :dataHeaders="dataHeaders" :data="data"></d-table-list>
</template>

<script>
import DTableList from '@/views/form-builder/DTableList.vue'
import { ref } from 'vue';

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
                header4: "order_level",
                header5: "remark",
                header6: "ddd",
                header7: "remark",
            },
            data:{
                limit: 2,
                pageCount: 3,
                data:[
                {
                    id: 3,
                    name: "Objective",
                    name_kh: "គោលបំណងទី3",
                    order_level: 1,
                    remark: "",
                    ddd: "tttt12"
                },
                {
                    id: 4,
                    name: "Objective",
                    name_kh: "គោលបំណងទី4",
                    order_level: 1,
                    remark: "",
                    ddd: "tttt33"
                },
                {
                    id: 1,
                    name: "Objective",
                    name_kh: "គោលបំណងទី១",
                    order_level: 1,
                    remark: "",
                    ddd: "tttt"
                },
                {
                    id: 2,
                    name: "Objective",
                    name_kh: "គោលបំណងទី2",
                    order_level: 1,
                    remark: "",
                    ddd: "tttt"
                    },
                    {
                        id: 3,
                        name: "Objective",
                        name_kh: "គោលបំណងទី3",
                        order_level: 1,
                        remark: "",
                    ddd: "tttt"
                    },
                    {
                        id: 4,
                        name: "Objective",
                        name_kh: "គោលបំណងទី4",
                        order_level: 1,
                        remark: "",
                    ddd: "tttt"
                    },
                    {
                        id: 1,
                        name: "Objective",
                        name_kh: "គោលបំណងទី១",
                        order_level: 1,
                        remark: "",
                    ddd: "tttt"
                    },
                    {
                        id: 2,
                        name: "Objective",
                        name_kh: "គោលបំណងទី2",
                        order_level: 1,
                        remark: "",
                    ddd: "tttt"
                    },
               
                ]
            }
        }
    },
    methods: {
       
    },
    components: {
        DTableList,
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
