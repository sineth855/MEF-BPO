<template>
    <vx-card :title="$t('setting_account_administration')" code-toggler>
        <div class="mt-5">
            <vs-tabs alignment="center">
                <vs-tab :label="$t('setting_budget_template')">
                    <budget-template></budget-template>
                </vs-tab>
                
                <vs-tab :label="$t('setting_planning')">
                    <planning></planning>
                </vs-tab>

                <vs-tab :label="$t('setting_account_type_group')">
                    <account-type-group></account-type-group>
                </vs-tab>

                <vs-tab :label="$t('setting_account_type')">
                    <account-type></account-type>
                </vs-tab>

                <vs-tab :label="$t('setting_group_chapter')">
                    <account-group></account-group>
                </vs-tab>

                <vs-tab :label="$t('setting_account_sub_account')">
                    <account></account>
                </vs-tab>

                <vs-tab :label="$t('setting_unit')">
                    <unit></unit>
                </vs-tab>

                <vs-tab :label="$t('setting_category')">
                    <item-category></item-category>
                </vs-tab>

                <vs-tab :label="$t('setting_product_service')">
                    <item></item>
                </vs-tab>

                <!-- <vs-tab :label="$t('setting_cost_list')">
                    <price-list-type></price-list-type>
                </vs-tab> -->
            </vs-tabs>
        </div>
    </vx-card>
</template>

<script>
import moduleDataList from "@/store/data-list/moduleDataList.js";
import Planning from '@/views/settings/_Planning.vue';
import Item from '@/views/settings/_Item.vue';
import ItemCategory from '@/views/settings/_Item_Category.vue';
import AccountTypeGroup from '@/views/settings/_Account_Type_Group.vue';
import AccountType from '@/views/settings/_Account_Type.vue';
import AccountGroup from '@/views/settings/_Account_Group.vue';
import Account from '@/views/settings/_Account.vue';
import Unit from '@/views/settings/_Unit.vue';
import PriceListType from '@/views/settings/_Price_List_Type.vue';
import BudgetTemplate from '@/views/settings/_Budget_Template.vue';
export default {
    components: {
        Planning,
        ItemCategory,
        Item,
        AccountTypeGroup,
        AccountType,
        AccountGroup,
        Account,
        Unit,
        PriceListType,
        BudgetTemplate
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
            price_list_groups: [
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
            accountGroups: [
                {
                    code: "60",
                    name: "ការទិញ",
                    description: "",
                    order_level: 1,
                    is_active: 1
                },
            ],
            accounts: [
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
            items: [
                {
                    code: "ITM0001",
                    account_group: "ការទិញ",
                    account_type: "សម្ភារៈផ្គត់ផ្គង់ថែទាំ->សម្ភារៈផ្គត់ផ្គង់និងអនាម័យ",
                    name: "រាយនាមទំនិញ/សេវ៉ាកម្ម",
                    unit: "ឯកតា",
                    description: "",
                    order_level: 1,
                    is_active: 1
                },
                {
                    code: "ITM0001",
                    account_group: "ការទិញ",
                    account_type: "សម្ភារៈផ្គត់ផ្គង់ថែទាំ->សម្ភារៈផ្គត់ផ្គង់និងអនាម័យ",
                    name: "រាយនាមទំនិញ/សេវ៉ាកម្ម",
                    unit: "ឯកតា",
                    description: "",
                    order_level: 1,
                    is_active: 1
                },
                {
                    code: "ITM0001",
                    account_group: "ការទិញ",
                    account_type: "សម្ភារៈផ្គត់ផ្គង់ថែទាំ->សម្ភារៈផ្គត់ផ្គង់និងអនាម័យ",
                    name: "រាយនាមទំនិញ/សេវ៉ាកម្ម",
                    unit: "ឯកតា",
                    description: "",
                    order_level: 1,
                    is_active: 1
                },
            ],
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