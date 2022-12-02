<!-- =========================================================================================
    File Name: TabsAlignments.vue
    Description: Align your tabs using alignments prop
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <vx-card title="កំណត់គណនេយ្យ និងរដ្ឋបាល" code-toggler>
        <div class="mt-5">
            <vs-tabs alignment="center">
                <vs-tab label="ប្រភេទតារាងតម្លៃ">
                    <vx-card>
                        <vs-table ref="table" multiple v-model="selected" pagination :max-items="itemsPerPage" search :data="price_list_groups">
                            <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">
                                <div class="flex flex-wrap-reverse items-center data-list-btn-container">

                                    <!-- ACTION - DROPDOWN -->
                                    <vs-dropdown vs-trigger-click class="dd-actions cursor-pointer mr-4 mb-4">

                                        <div class="p-4 shadow-drop rounded-lg d-theme-dark-bg cursor-pointer flex items-center justify-center text-lg font-medium w-32 w-full">
                                        <span class="mr-2">{{$t("Action")}}</span>
                                        <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
                                        </div>

                                        <vs-dropdown-menu>

                                        <vs-dropdown-item>
                                            <span class="flex items-center">
                                            <feather-icon icon="TrashIcon" svgClasses="h-4 w-4" class="mr-2" />
                                            <span>Delete</span>
                                            </span>
                                        </vs-dropdown-item>

                                        <vs-dropdown-item>
                                            <span class="flex items-center">
                                            <feather-icon icon="ArchiveIcon" svgClasses="h-4 w-4" class="mr-2" />
                                            <span>Archive</span>
                                            </span>
                                        </vs-dropdown-item>

                                        <vs-dropdown-item>
                                            <span class="flex items-center">
                                            <feather-icon icon="FileIcon" svgClasses="h-4 w-4" class="mr-2" />
                                            <span>Print</span>
                                            </span>
                                        </vs-dropdown-item>

                                        <vs-dropdown-item>
                                            <span class="flex items-center">
                                            <feather-icon icon="SaveIcon" svgClasses="h-4 w-4" class="mr-2" />
                                            <span>Another Action</span>
                                            </span>
                                        </vs-dropdown-item>

                                        </vs-dropdown-menu>
                                    </vs-dropdown>

                                    <!-- ADD NEW -->
                                    <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
                                        <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
                                        <span class="ml-2 text-base text-primary">{{$t("AddNew")}}</span>
                                    </div>
                                </div>

                                <div id="popup-demo">
                                    <popup-fullscreen></popup-fullscreen>
                                </div>
                                
                                <!-- ITEMS PER PAGE -->
                                <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4 items-per-page-handler">
                                    <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
                                        <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ products.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : products.length }} of {{ queriedItems }}</span>
                                        <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
                                    </div>
                                    <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
                                    <vs-dropdown-menu>

                                        <vs-dropdown-item @click="itemsPerPage=4">
                                        <span>4</span>
                                        </vs-dropdown-item>
                                        <vs-dropdown-item @click="itemsPerPage=10">
                                        <span>10</span>
                                        </vs-dropdown-item>
                                        <vs-dropdown-item @click="itemsPerPage=15">
                                        <span>15</span>
                                        </vs-dropdown-item>
                                        <vs-dropdown-item @click="itemsPerPage=20">
                                        <span>20</span>
                                        </vs-dropdown-item>
                                    </vs-dropdown-menu>
                                </vs-dropdown>
                            </div>

                            <template slot="thead">
                                <vs-th sort-key="name">កូដ</vs-th>
                                <vs-th sort-key="category">ឈ្មោះ</vs-th>
                                <vs-th sort-key="category">ពីព័ណ៌នា</vs-th>
                                <vs-th sort-key="category">លំដាប់</vs-th>
                                <vs-th>​​ប៊ូតុងសកម្ម</vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <tbody>
                                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                    <vs-td>{{ tr.code }}</vs-td>
                                    <vs-td>{{ tr.name }}</vs-td>
                                    <vs-td>{{ tr.description }}</vs-td>
                                    <vs-td>{{ tr.order_level }}</vs-td>
                                    <vs-td class="whitespace-no-wrap">
                                        <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" @click.stop="editData(tr)" />
                                        <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(tr.id)" />
                                    </vs-td>

                                    </vs-tr>
                                </tbody>
                            </template>
                        </vs-table>
                    </vx-card>
                </vs-tab>
                <vs-tab label="ក្រុម/ជំពូកគណនី">
                    <vx-card>
                        <vs-table ref="table" multiple v-model="selected" pagination :max-items="itemsPerPage" search :data="accountGroups">
                            <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">
                                <div class="flex flex-wrap-reverse items-center data-list-btn-container">

                                    <!-- ACTION - DROPDOWN -->
                                    <vs-dropdown vs-trigger-click class="dd-actions cursor-pointer mr-4 mb-4">

                                        <div class="p-4 shadow-drop rounded-lg d-theme-dark-bg cursor-pointer flex items-center justify-center text-lg font-medium w-32 w-full">
                                        <span class="mr-2">{{$t("Action")}}</span>
                                        <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
                                        </div>

                                        <vs-dropdown-menu>

                                        <vs-dropdown-item>
                                            <span class="flex items-center">
                                            <feather-icon icon="TrashIcon" svgClasses="h-4 w-4" class="mr-2" />
                                            <span>Delete</span>
                                            </span>
                                        </vs-dropdown-item>

                                        <vs-dropdown-item>
                                            <span class="flex items-center">
                                            <feather-icon icon="ArchiveIcon" svgClasses="h-4 w-4" class="mr-2" />
                                            <span>Archive</span>
                                            </span>
                                        </vs-dropdown-item>

                                        <vs-dropdown-item>
                                            <span class="flex items-center">
                                            <feather-icon icon="FileIcon" svgClasses="h-4 w-4" class="mr-2" />
                                            <span>Print</span>
                                            </span>
                                        </vs-dropdown-item>

                                        <vs-dropdown-item>
                                            <span class="flex items-center">
                                            <feather-icon icon="SaveIcon" svgClasses="h-4 w-4" class="mr-2" />
                                            <span>Another Action</span>
                                            </span>
                                        </vs-dropdown-item>

                                        </vs-dropdown-menu>
                                    </vs-dropdown>

                                    <!-- ADD NEW -->
                                    <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
                                        <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
                                        <span class="ml-2 text-base text-primary">{{$t("AddNew")}}</span>
                                    </div>
                                </div>

                                <div id="popup-demo">
                                    <popup-fullscreen></popup-fullscreen>
                                </div>
                                
                                <!-- ITEMS PER PAGE -->
                                <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4 items-per-page-handler">
                                    <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
                                        <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ products.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : products.length }} of {{ queriedItems }}</span>
                                        <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
                                    </div>
                                    <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
                                    <vs-dropdown-menu>

                                        <vs-dropdown-item @click="itemsPerPage=4">
                                        <span>4</span>
                                        </vs-dropdown-item>
                                        <vs-dropdown-item @click="itemsPerPage=10">
                                        <span>10</span>
                                        </vs-dropdown-item>
                                        <vs-dropdown-item @click="itemsPerPage=15">
                                        <span>15</span>
                                        </vs-dropdown-item>
                                        <vs-dropdown-item @click="itemsPerPage=20">
                                        <span>20</span>
                                        </vs-dropdown-item>
                                    </vs-dropdown-menu>
                                </vs-dropdown>
                            </div>

                            <template slot="thead">
                                <vs-th sort-key="name">កូដ</vs-th>
                                <vs-th sort-key="category">ឈ្មោះ</vs-th>
                                <vs-th sort-key="category">ពីព័ណ៌នា</vs-th>
                                <vs-th sort-key="category">លំដាប់</vs-th>
                                <vs-th>​​ប៊ូតុងសកម្ម</vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <tbody>
                                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                    <vs-td>{{ tr.code }}</vs-td>
                                    <vs-td>{{ tr.name }}</vs-td>
                                    <vs-td>{{ tr.description }}</vs-td>
                                    <vs-td>{{ tr.order_level }}</vs-td>
                                    <vs-td class="whitespace-no-wrap">
                                        <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" @click.stop="editData(tr)" />
                                        <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(tr.id)" />
                                    </vs-td>

                                    </vs-tr>
                                </tbody>
                            </template>
                        </vs-table>
                    </vx-card>
                </vs-tab>
                <vs-tab label="គណនី/អនុគណនី">
                    <vx-card>
                        <vs-table ref="table" multiple v-model="selected" pagination :max-items="itemsPerPage" search :data="accounts">
                            <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">
                                <div class="flex flex-wrap-reverse items-center data-list-btn-container">

                                    <!-- ACTION - DROPDOWN -->
                                    <vs-dropdown vs-trigger-click class="dd-actions cursor-pointer mr-4 mb-4">

                                        <div class="p-4 shadow-drop rounded-lg d-theme-dark-bg cursor-pointer flex items-center justify-center text-lg font-medium w-32 w-full">
                                        <span class="mr-2">{{$t("Action")}}</span>
                                        <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
                                        </div>

                                        <vs-dropdown-menu>

                                        <vs-dropdown-item>
                                            <span class="flex items-center">
                                            <feather-icon icon="TrashIcon" svgClasses="h-4 w-4" class="mr-2" />
                                            <span>Delete</span>
                                            </span>
                                        </vs-dropdown-item>

                                        <vs-dropdown-item>
                                            <span class="flex items-center">
                                            <feather-icon icon="ArchiveIcon" svgClasses="h-4 w-4" class="mr-2" />
                                            <span>Archive</span>
                                            </span>
                                        </vs-dropdown-item>

                                        <vs-dropdown-item>
                                            <span class="flex items-center">
                                            <feather-icon icon="FileIcon" svgClasses="h-4 w-4" class="mr-2" />
                                            <span>Print</span>
                                            </span>
                                        </vs-dropdown-item>

                                        <vs-dropdown-item>
                                            <span class="flex items-center">
                                            <feather-icon icon="SaveIcon" svgClasses="h-4 w-4" class="mr-2" />
                                            <span>Another Action</span>
                                            </span>
                                        </vs-dropdown-item>

                                        </vs-dropdown-menu>
                                    </vs-dropdown>

                                    <!-- ADD NEW -->
                                    <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
                                        <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
                                        <span class="ml-2 text-base text-primary">{{$t("AddNew")}}</span>
                                    </div>
                                </div>

                                <div id="popup-demo">
                                    <popup-fullscreen></popup-fullscreen>
                                </div>
                                
                                <!-- ITEMS PER PAGE -->
                                <vs-dropdown vs-trigger-click class="cursor-pointer mb-4 mr-4 items-per-page-handler">
                                    <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
                                        <span class="mr-2">{{ currentPage * itemsPerPage - (itemsPerPage - 1) }} - {{ products.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : products.length }} of {{ queriedItems }}</span>
                                        <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
                                    </div>
                                    <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
                                    <vs-dropdown-menu>

                                        <vs-dropdown-item @click="itemsPerPage=4">
                                        <span>4</span>
                                        </vs-dropdown-item>
                                        <vs-dropdown-item @click="itemsPerPage=10">
                                        <span>10</span>
                                        </vs-dropdown-item>
                                        <vs-dropdown-item @click="itemsPerPage=15">
                                        <span>15</span>
                                        </vs-dropdown-item>
                                        <vs-dropdown-item @click="itemsPerPage=20">
                                        <span>20</span>
                                        </vs-dropdown-item>
                                    </vs-dropdown-menu>
                                </vs-dropdown>
                            </div>

                            <template slot="thead">
                                <vs-th sort-key="name">កូដ</vs-th>
                                <vs-th sort-key="category">ឈ្មោះ</vs-th>
                                <vs-th sort-key="category">មេ</vs-th>
                                <vs-th sort-key="category">ពីព័ណ៌នា</vs-th>
                                <vs-th sort-key="category">លំដាប់</vs-th>
                                <vs-th>​​ប៊ូតុងសកម្ម</vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <tbody>
                                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                    <vs-td>{{ tr.code }}</vs-td>
                                    <vs-td>{{ tr.name }}</vs-td>
                                    <vs-td>{{ tr.parent }}</vs-td>
                                    <vs-td>{{ tr.description }}</vs-td>
                                    <vs-td>{{ tr.order_level }}</vs-td>
                                    <vs-td class="whitespace-no-wrap">
                                        <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" @click.stop="editData(tr)" />
                                        <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2" @click.stop="deleteData(tr.id)" />
                                    </vs-td>

                                    </vs-tr>
                                </tbody>
                            </template>
                        </vs-table>
                    </vx-card>
                </vs-tab>
                <vs-tab label="គំរូថវិកា">
                    <div></div>
                </vs-tab>
            </vs-tabs>
        </div>

    </vx-card>
</template>

<script>
    import moduleDataList from "@/store/data-list/moduleDataList.js"
    export default {
    components: {
    },
    data() {
        return {
            // popupActive: false,
            selected: [],
            // products: [],
            itemsPerPage: 4,
            isMounted: false,

            // Data Sidebar
            addNewDataSidebar: false,
            sidebarData: {},
            price_list_groups:[
                {
                    code: "1",
                    name: "សិក្ខាសាលា /បណ្តុះបណ្តាល និងកិច្ចប្រជុំ ក្នុងប្រទេស",
                    description: "",
                    order_level: 1,
                    is_active: 1
                },
                {
                    code: "1.1",
                    name: "កញ្ចប់សេវាសិក្ខាសាលា/បណ្តុះបណ្តាលនៅសណ្ឋាគារផ្កាយ៤",
                    description: "",
                    order_level: 1,
                    is_active: 1
                },
                {
                    code: "2",
                    name: "ទស្សកិច្ចសិក្សា/បណ្តុះបណ្តាល និងកិច្ចប្រជុំ ក្រៅប្រទេស",
                    description: "",
                    order_level: 1,
                    is_active: 1
                },
                {
                    code: "2.1",
                    name: "ថ្លៃ​វគ្គបណ្តុះបណ្តាល",
                    description: "",
                    order_level: 1,
                    is_active: 1
                },
            ],
            accountGroups:[
                {
                    code: "60",
                    name: "ការទិញ",
                    description: "",
                    order_level: 1,
                    is_active: 1
                },
            ],
            accounts:[
                {
                    code: "6001",
                    parent: "",
                    name: "សម្ភារៈផ្គត់ផ្គង់ថែទាំ",
                    description: "",
                    order_level: 1,
                    is_active: 1
                },
                {
                    code: "60011",
                    parent: "សម្ភារៈផ្គត់ផ្គង់ថែទាំ",
                    name: "សម្ភារៈផ្គត់ផ្គង់សម្អាត និងអនាម័យ",
                    description: "",
                    order_level: 1,
                    is_active: 1
                },
                {
                    code: "60012",
                    parent: "សម្ភារៈផ្គត់ផ្គង់ថែទាំ",
                    name: "សម្ភារៈផ្គត់ផ្គង់សម្រាប់ថែទាំអាគារ ប្រសាទ និងសំណង់ផ្សេងៗ",
                    description: "",
                    order_level: 1,
                    is_active: 1
                },
            ],
        }
    },
    computed: {
        currentPage() {
        if(this.isMounted) {
            return this.$refs.table.currentx
        }
        return 0
        },
        products() {
        return this.$store.state.dataList.products
        },
        queriedItems() {
        return this.$refs.table ? this.$refs.table.queriedResults.length : this.products.length
        }
    },
    methods: {
        viewBudgetList(){
        this.$router.push('/module/budget-arrangement/budget-ceiling/list').catch(() => {});
        },
        addNewData() {
        this.sidebarData = {}
        this.toggleDataSidebar(true)
        },
        deleteData(id) {
        this.$store.dispatch("dataList/removeItem", id).catch(err => { console.error(err) })
        },
        editData(data) {
        // this.sidebarData = JSON.parse(JSON.stringify(this.blankData))
        this.sidebarData = data
        this.toggleDataSidebar(true)
        },
        getOrderStatusColor(status) {
        if(status == 'on_hold') return "warning"
        if(status == 'completed') return "success"
        if(status == 'canceled') return "danger"
        return "primary"
        },
        getPopularityColor(num) {
        if(num > 90) return "success"
        if(num >70) return "primary"
        if(num >= 50) return "warning"
        if(num < 50) return "danger"
        return "primary"
        },
        toggleDataSidebar(val=false) {
        this.addNewDataSidebar = val
        },
        viewCeiling(){
        alert("testing");
        }
    },
    created() {
        if(!moduleDataList.isRegistered) {
        this.$store.registerModule('dataList', moduleDataList)
        moduleDataList.isRegistered = true
        }
        this.$store.dispatch("dataList/fetchDataListItems")
        this.data;
    },
    mounted() {
        this.isMounted = true;
    }
    }
</script>