<template>
    <div class="mt-5">
        <vs-tabs position="top" alignment="center" class="mt-8">

            <vs-tab :label="$t('setting_finance_resource')">
                <!-- គម្រោងវិនិយោគសាធារណៈ Finance Resource-->
                <PIP-finance-resource></PIP-finance-resource>
            </vs-tab>

            <vs-tab :label="$t('setting_project_status')">
                <!-- គម្រោងវិនិយោគសាធារណៈ Project Status-->
                <PIP-project-status></PIP-project-status>
            </vs-tab>

            <vs-tab :label="$t('setting_project_type')">
                <!-- គម្រោងវិនិយោគសាធារណៈ Project Type-->
                <PIP-project-type></PIP-project-type>
            </vs-tab>

            <vs-tab :label="$t('setting_expenditure_group')">
                <expenditure-group></expenditure-group>
            </vs-tab>

            <vs-tab :label="$t('setting_expenditure_type')">
                <expenditure-type></expenditure-type>
            </vs-tab>

            <vs-tab :label="$t('ceiling_group')">
                <ceiling-group></ceiling-group>
            </vs-tab>

            <vs-tab :label="$t('ceiling_type')">
                <ceiling-type></ceiling-type>
            </vs-tab>

        </vs-tabs>
    </div>
</template>


<script>
import moduleDataList from "@/store/data-list/moduleDataList.js"
import PIPFinanceResource from '@/views/settings/include_budget_arrangement/_PIPFinanceResource.vue';
import PIPProjectStatus from '@/views/settings/include_budget_arrangement/_PIPProjectStatus.vue';
import PIPProjectType from '@/views/settings/include_budget_arrangement/_PIPProjectType.vue';
import ExpenditureGroup from '@/views/settings/include_budget_arrangement/_ExpenditureGroup.vue';
import ExpenditureType from '@/views/settings/include_budget_arrangement/_ExpenditureType.vue';
// Ceiling
import CeilingGroup from '@/views/settings/ceiling/_CeilingGroup.vue';
import CeilingType from '@/views/settings/ceiling/_CeilingType.vue';

export default {
    components: {
        PIPFinanceResource,
        PIPProjectStatus,
        PIPProjectType,
        ExpenditureGroup,
        ExpenditureType,
        CeilingGroup,
        CeilingType
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
            pip: [
                {
                    code: "GD01",
                    name: "នាយកដ្ឋានផែនការថវិកា",
                    secretary: "អគ្គលេខាធិការដ្ឋាន អ.គ.ហ",
                    parent: "អគ្គលេខាធិការដ្ឋាន អ.គ.ហ",
                    order_level: 1,
                },
            ],
            titles: [
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
            positions: [
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
            if (this.isMounted) {
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
        viewBudgetList() {
            this.$router.push('/module/budget-arrangement/budget-ceiling/list').catch(() => { });
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
            if (status == 'on_hold') return "warning"
            if (status == 'completed') return "success"
            if (status == 'canceled') return "danger"
            return "primary"
        },
        getPopularityColor(num) {
            if (num > 90) return "success"
            if (num > 70) return "primary"
            if (num >= 50) return "warning"
            if (num < 50) return "danger"
            return "primary"
        },
        toggleDataSidebar(val = false) {
            this.addNewDataSidebar = val
        },
        viewCeiling() {
            alert("testing");
        }
    },
    created() {
        if (!moduleDataList.isRegistered) {
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