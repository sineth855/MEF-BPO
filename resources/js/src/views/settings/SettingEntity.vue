<template>
    <!-- <vx-card title="អង្គភាព" code-toggler> -->
        <div class="mt-5">
            <h6 class="mb-3"> {{ $t("setting_entity")}} </h6>
            <vs-tabs position="top" alignment="left" class="mt-8">
                <vs-tab :label="$t('setting_secretary')">
                    <vx-card>
                        <vs-table ref="table" multiple v-model="selected" pagination :max-items="itemsPerPage" search :data="data">
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
                                <vs-th sort-key="name">ឈ្មោះ</vs-th>
                                <vs-th sort-key="category">ពិព័ណ៌នា</vs-th>
                                <vs-th>​​ប៊ូតុងសកម្ម</vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <tbody>
                                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

                                    <vs-td>
                                        <p class="product-name font-medium truncate">{{ tr.name }}</p>
                                    </vs-td>

                                    <vs-td>
                                        <p class="product-name font-medium truncate">{{ tr.description }}</p>
                                    </vs-td>

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
                <vs-tab :label="$t('setting_department')">
                    <vx-card>
                        <vs-table ref="table" multiple v-model="selected" pagination :max-items="itemsPerPage" search :data="departments">
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
                                <vs-th sort-key="category">លេខាធិការដ្ឋាន</vs-th>
                                <vs-th sort-key="category">មេផ្នែក</vs-th>
                                <vs-th sort-key="category">លំដាប់</vs-th>
                                <vs-th>​​ប៊ូតុងសកម្ម</vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <tbody>
                                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                                    <vs-td>{{ tr.code }}</vs-td>
                                    <vs-td>{{ tr.name }}</vs-td>
                                    <vs-td>{{ tr.secretary }}</vs-td>
                                    <vs-td>{{ tr.parent }}</vs-td>
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
                <vs-tab :label="$t('setting_structure')">
                    <div></div>
                </vs-tab>
                <vs-tab :label="$t('setting_title')">
                    <vx-card>
                        <vs-table ref="table" multiple v-model="selected" pagination :max-items="itemsPerPage" search :data="titles">
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
                                <vs-th sort-key="name">ឈ្មោះ</vs-th>
                                <vs-th sort-key="category">ពិព័ណ៌នា</vs-th>
                                <vs-th>​​ប៊ូតុងសកម្ម</vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <tbody>
                                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

                                    <vs-td>
                                        <p class="product-name font-medium truncate">{{ tr.name }}</p>
                                    </vs-td>

                                    <vs-td>
                                        <p class="product-name font-medium truncate">{{ tr.description }}</p>
                                    </vs-td>

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
                <vs-tab :label="$t('setting_position')">
                    <vx-card>
                        <vs-table ref="table" multiple v-model="selected" pagination :max-items="itemsPerPage" search :data="positions">
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
                                <vs-th sort-key="name">ឈ្មោះ</vs-th>
                                <vs-th sort-key="description">ពិព័ណ៌នា</vs-th>
                                <vs-th>​​ប៊ូតុងសកម្ម</vs-th>
                            </template>

                            <template slot-scope="{data}">
                                <tbody>
                                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

                                    <vs-td>
                                        <p class="product-name font-medium truncate">{{ tr.name }}</p>
                                    </vs-td>

                                    <vs-td>
                                        <p class="product-name font-medium truncate">{{ tr.description }}</p>
                                    </vs-td>

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
            </vs-tabs>
        </div>

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
            data: [
                {
                    name: "ក្រសួង-ស្ថាប័ន",
                    description: "អគ្គលេខាធិការដ្ឋានគណៈកម្មាធិការដឹកនាំការងារកែទម្រង់ការគ្រប់គ្រងហិរញ្ញវត្ថុសាធារណៈ",
                },
                {
                    name: "អង្គភាពក្រោមឱវាទ កសហវ",
                    description: "ថវិកាដែលប្រើប្រាស់ក្រោមអង្គភាពក្រោមឱវាទ កសហវ",
                },
            ],
            departments:[
                {
                    code: "GD01",
                    name: "នាយកដ្ឋានផែនការថវិកា",
                    secretary: "អគ្គលេខាធិការដ្ឋាន អ.គ.ហ",
                    parent: "អគ្គលេខាធិការដ្ឋាន អ.គ.ហ",
                    order_level: 1,
                },
            ],
            titles:[
                {
                    name: "កញ្ញា",
                    description: "Miss",
                },
                {
                    name: "ជំទាវ",
                    description: "YE",
                },
                {
                    name: "លោក",
                    description: "Mr",
                },
                {
                    name: "លោកស្រី",
                    description: "Mrs",
                },
                {
                    name: "អ្នកនាង",
                    description: "Ms.",
                },
            ],
            positions:[
                {
                    name: "អគ្គលេខាធិការ",
                    description: "Secretary General",
                },
                {
                    name: "អគ្គលេខាធិការរង",
                    description: "Deputy Secretary General",
                },
                {
                    name: "មន្ត្រីជំនាញជាន់ខ្ពស់",
                    description: "",
                },
                {
                    name: "មន្ត្រីជំនាញ",
                    description: "",
                },
                {
                    name: "ជំនួយការមន្រ្តីជំនាញ",
                    description: "",
                },
            ]
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