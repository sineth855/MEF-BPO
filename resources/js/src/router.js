import Vue from 'vue'
import Router from 'vue-router'
import auth from "@/auth/authService";

import firebase from 'firebase/app'
import 'firebase/auth'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    scrollBehavior () {
        return { x: 0, y: 0 }
    },
    routes: [

        {
            // =============================================================================
            // MAIN LAYOUT ROUTES
            // =============================================================================
            path: '',
            component: () => import('./layouts/main/Main.vue'),
            children: [
            // =============================================================================
            // Theme Routes
            // =============================================================================
                    {
                        path: '/',
                        redirect: '/dashboard'
                    },
                    {
                        path: '/dashboard',
                        name: 'dashboard',
                        component: () => import('./views/Dashboard.vue'),
                        meta: {
                            rule: 'editor',
                        }
                    },
                    // {
                    //     path: '/dashboard',
                    //     name: 'dashboard-ecommerce',
                    //     component: () => import('./views/DashboardECommerce.vue'),
                    //     meta: {
                    //         rule: 'admin'
                    //     }
                    // },
                // =============================================================================
                // User
                // =============================================================================
                {
                    path: '/user/list',
                    name: 'data-user-list',
                    component: () => import('@/views/users/UserList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'អ្នកប្រើប្រាស់'},
                            { title: 'រាយនាមអ្នកប្រើប្រាស់', active: true },
                        ],
                        pageTitle: 'អ្នកប្រើប្រាស់',
                        rule: 'editor'
                    },
                },
                {
                    path: '/user/form',
                    name: 'data-user-form',
                    component: () => import('@/views/users/user-edit/UserSettings.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'អ្នកប្រើប្រាស់', url: '/user/list'},
                            { title: 'រាយនាមអ្នកប្រើប្រាស់', active: true },
                        ],
                        pageTitle: 'អ្នកប្រើប្រាស់',
                        rule: 'editor'
                    },
                },
                {
                    path: '/user/view/:userId',
                    name: 'user-view',
                    component: () => import('@/views/users/user-edit/UserSettings.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'អ្នកប្រើប្រាស់', url: '/user/list'},
                            { title: 'View', active: true },
                        ],
                        pageTitle: 'User View',
                        rule: 'editor'
                    },
                },
                {
                    path: '/user/edit/:userId',
                    name: 'user-edit',
                    component: () => import('@/views/users/user-edit/UserSettings.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'User', url: '/user/list'},
                            { title: 'View', active: true },
                        ],
                        pageTitle: 'User View',
                        rule: 'editor'
                    },
                },
                // =============================================================================
                // Policy Form
                // =============================================================================
                {
                    path: '/policy/list',
                    name: 'PolicyRequestList',
                    component: () => import('@/views/policy-form/List.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បញ្ជីសំណើរ'},
                            { title: 'រាយនាមបញ្ជីសំណើរ', active: true },
                        ],
                        pageTitle: 'បញ្ជីសំណើរ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/policy/form',
                    name: 'PolicyRequestForm',
                    component: () => import('@/views/policy-form/form/FormWizard.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បញ្ជីសំណើរ'},
                            { title: 'រាយនាមបញ្ជីសំណើរ', active: true },
                        ],
                        pageTitle: 'អ្នកប្រើប្រាស់',
                        rule: 'editor'
                    },
                },
                {
                    path: '/user/view/:userId',
                    name: 'user-view',
                    component: () => import('@/views/users/user-edit/UserSettings.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'អ្នកប្រើប្រាស់', url: '/user/list'},
                            { title: 'View', active: true },
                        ],
                        pageTitle: 'User View',
                        rule: 'editor'
                    },
                },
                {
                    path: '/user/edit/:userId',
                    name: 'user-edit',
                    component: () => import('@/views/users/user-edit/UserSettings.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'User', url: '/user/list'},
                            { title: 'View', active: true },
                        ],
                        pageTitle: 'User View',
                        rule: 'editor'
                    },
                },
                // =============================================================================
                // Role
                // =============================================================================
                {
                    path: '/role/list',
                    name: 'data-role-list',
                    component: () => import('@/views/roles/RoleList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'សិទ្ធិ'},
                            { title: 'រាយឈ្មោះសិទ្ធិ', active: true },
                        ],
                        pageTitle: 'សិទ្ធិ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/role/form',
                    name: 'data-role-form',
                    component: () => import('@/views/roles/RoleForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'សិទ្ធិ', url: '/role/list'},
                            { title: 'រាយឈ្មោះសិទ្ធិ', active: true },
                        ],
                        pageTitle: 'សិទ្ធិ',
                        rule: 'editor'
                    },
                },
                // =============================================================================
                // Incentives
                // =============================================================================
                {
                    path: '/officer/list',
                    name: 'data-officer-list',
                    component: () => import('@/views/officers/data-list/list-view/DataListListView.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បញ្ជីមន្ត្រីបើកប្រាក់ឧបត្ថម្ភ', url: '/officer/list' },
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'List View',
                        rule: 'editor'
                    },
                },
                {
                    path: '/officer/form',
                    name: 'data-officer-form',
                    component: () => import('@/views/officers/form/UserSettings.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បញ្ជីមន្ត្រីបើកប្រាក់ឧបត្ថម្ភ', url: '/officer/list' },
                            { title: 'ទម្រង់បង្កើត', active: true },
                        ],
                        pageTitle: 'រាយនាមមន្ត្រី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/officer/edit/:id',
                    name: 'data-officer-edit',
                    component: () => import('@/views/officers/form/UserSettings.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បញ្ជីមន្ត្រីបើកប្រាក់ឧបត្ថម្ភ', url: '/officer/list' },
                            { title: 'ពត៌មានលម្អិត', active: true },
                        ],
                        pageTitle: 'រាយនាមមន្ត្រី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/officer/activity/:id',
                    name: 'data-officer-activity',
                    component: () => import('@/views/officers/ActivityDetail.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បញ្ជីមន្ត្រីបើកប្រាក់ឧបត្ថម្ភ', url: '/officer/list' },
                            { title: 'ពត៌មានលម្អិតពីសកម្មភាព', active: true },
                        ],
                        pageTitle: 'រាយនាមមន្ត្រី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/incentive/composition',
                    name: 'data-composition-form-list',
                    component: () => import('@/views/compositions/data-list/list-view/DataListListView.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'រាយនាមមន្ត្រី'},
                            { title: 'រាយនាមមន្ត្រីផ្លាស់ប្តូរសមាសភាព', active: true },
                        ],
                        pageTitle: 'គ្រប់គ្រងប្រាក់ឧបត្ថម្ភ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/incentive/composition-request',
                    name: 'data-composition-request-list',
                    component: () => import('@/views/compositions-request/data-list/list-view/DataListListView.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាង'},
                            { title: 'ការផ្លាស់ប្តូរសមាសភាព', active: true },
                        ],
                        pageTitle: 'គ្រប់គ្រងប្រាក់ឧបត្ថម្ភ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/incentive/composition-request/form',
                    name: 'data-composition-request-form',
                    component: () => import('@/views/compositions-request/form/FormWizard.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ទម្រង់', url: '/incentive/composition-request'},
                            { title: 'ការផ្លាស់ប្តូរសមាសភាព', active: true },
                        ],
                        pageTitle: 'គ្រប់គ្រងប្រាក់ឧបត្ថម្ភ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/incentive/composition-request/edit/:id',
                    name: 'data-composition-request-edit',
                    component: () => import('@/views/compositions-request/form/FormWizard.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ទម្រង់', url: '/incentive/composition-request'},
                            { title: 'ការផ្លាស់ប្តូរសមាសភាព', active: true },
                        ],
                        pageTitle: 'គ្រប់គ្រងប្រាក់ឧបត្ថម្ភ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/incentive/list',
                    name: 'data-incentive-list',
                    component: () => import('@/views/incentives/data-list/list-view/DataListListView.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាងបើកផ្តល់ប្រាក់ឧបត្ថម្ភ'},
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'List View',
                        rule: 'editor'
                    },
                },
                {
                    path: '/incentive/form',
                    name: 'data-incentive-form',
                    component: () => import('@/views/incentives/incentive-form-wizard/FormWizard.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បង្កើតប្រាក់ឧបត្ថម្ភ', url: '/incentive/list'},
                            { title: 'ទម្រង់បង្កើត', active: true },
                        ],
                        pageTitle: 'ការគ្រប់គ្រងប្រាក់ឧបត្ថម្ភ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/incentive/edit/:id',
                    name: 'data-incentive-edit',
                    component: () => import('@/views/incentives/incentive-form-wizard/FormWizard.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បង្កើតប្រាក់ឧបត្ថម្ភ', url: '/incentive/list'},
                            { title: 'ទម្រង់បង្កើត', active: true },
                        ],
                        pageTitle: 'ការគ្រប់គ្រងប្រាក់ឧបត្ថម្ភ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/account/payment-method',
                    name: 'account-paymentMethod-list',
                    component: () => import('@/views/account/payment-method/PaymentMethodList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'វិធីបង់ប្រាក់'},
                            { title: 'បញ្ជី', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/account/payment-method/form',
                    name: 'account-paymentMethod-form',
                    component: () => import('@/views/account/payment-method/PaymentMethodForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'វិធីបង់ប្រាក់'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },

                {
                    path: '/account/category',
                    name: 'account-category-list',
                    component: () => import('@/views/account/category/CategoryList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'វិធីបង់ប្រាក់'},
                            { title: 'បញ្ជី', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/account/category/form',
                    name: 'account-category-form',
                    component: () => import('@/views/account/category/CategoryForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'វិធីបង់ប្រាក់'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },

                {
                    path: '/account/account',
                    name: 'account-account-list',
                    component: () => import('@/views/account/account/AccountList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'វិធីបង់ប្រាក់'},
                            { title: 'បញ្ជី', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/account/account/form',
                    name: 'account-account-form',
                    component: () => import('@/views/account/account/AccountForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'វិធីបង់ប្រាក់'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },

                {
                    path: '/account/account-group',
                    name: 'account-account-group-list',
                    component: () => import('@/views/account/account-group/AccountGroupList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ក្រុមគណនីយ'},
                            { title: 'បញ្ជី', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/account/account-group/form',
                    name: 'account-account-group-form',
                    component: () => import('@/views/account/account-group/AccountGroupForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ក្រុមគណនីយ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },

                {
                    path: '/account/account-type',
                    name: 'account-account-type-list',
                    component: () => import('@/views/account/account-type/AccountTypeList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ប្រភេទគណនី'},
                            { title: 'បញ្ជី', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/account/account-type/form',
                    name: 'account-account-type-form',
                    component: () => import('@/views/account/account-type/AccountTypeForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ប្រភេទគណនី'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },

                {
                    path: '/account/bank-account',
                    name: 'account-bank-account-list',
                    component: () => import('@/views/account/bank-account/BankAccountList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'គណនីធនាគារ'},
                            { title: 'បញ្ជី', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/account/bank-account/form',
                    name: 'account-bank-account-form',
                    component: () => import('@/views/account/bank-account/BankAccountForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'គណនីធនាគារ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },

                {
                    path: '/account/expense',
                    name: 'account-expense-list',
                    component: () => import('@/views/account/expense/ExpenseList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ការចំនាយ', url: '/account/expense'},
                            { title: 'បញ្ជី', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/account/expense/form',
                    name: 'account-expense-form',
                    component: () => import('@/views/account/expense/ExpenseForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ការចំនាយ', url: '/account/expense'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },

                {
                    path: '/account/expense/edit/:id',
                    name: 'account-expense-edit',
                    component: () => import('@/views/account/expense/ExpenseForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ការចំនាយ', url: '/account/expense'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },

                {
                    path: '/account/income',
                    name: 'account-income-list',
                    component: () => import('@/views/account/income/IncomeList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ការគ្រប់គ្រងចំណូល', url: '/account/income'},
                            { title: 'បញ្ជី', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/account/income/form',
                    name: 'account-income-form',
                    component: () => import('@/views/account/income/IncomeForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ការគ្រប់គ្រងចំណូល', url: '/account/income'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/account/income/edit/:id',
                    name: 'account-income-edit',
                    component: () => import('@/views/account/income/IncomeForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ការគ្រប់គ្រងចំណូល', url: '/account/income'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },


                {
                    path: '/account/taxable-salary',
                    name: 'account-taxable-salary-list',
                    component: () => import('@/views/account/taxable-salary/TaxList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ការគណនាពន្ធ', url: '/account/taxable-salary'},
                            { title: 'បញ្ជី', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/account/taxable-salary/form',
                    name: 'account-taxable-salary-form',
                    component: () => import('@/views/account/taxable-salary/TaxForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ការគណនាពន្ធ', url: '/account/taxable-salary'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },
                {
                    path: '/account/taxable-salary/edit/:id',
                    name: 'account-taxable-salary-edit',
                    component: () => import('@/views/account/taxable-salary/TaxForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ការគណនាពន្ធ', url: '/account/taxable-salary'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'គណនី',
                        rule: 'editor'
                    },
                },
                // =============================================================================
                // Incentives Setup
                // =============================================================================
                {
                    path: '/setup/department',
                    name: 'department-list',
                    component: () => import('@/views/setup/department/DepartmentList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាងផ្នែក'},
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'រៀបចំទិន្នន័យ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/department/form',
                    name: 'department-form',
                    component: () => import('@/views/setup/department/DepartmentForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'រៀបចំទិន្នន័យ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'ទម្រង់បំពេញ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/bank',
                    name: 'bank-list',
                    component: () => import('@/views/setup/bank/BankList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាងផ្នែក'},
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'រៀបចំទិន្នន័យ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/bank/form',
                    name: 'bank-form',
                    component: () => import('@/views/setup/bank/BankForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'រៀបចំទិន្នន័យ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'ទម្រង់បំពេញ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/circular',
                    name: 'circular-list',
                    component: () => import('@/views/setup/circular/CircularList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាងផ្នែក'},
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'រៀបចំទិន្នន័យ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/circular/form',
                    name: 'circular-form',
                    component: () => import('@/views/setup/circular/CircularForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'រៀបចំទិន្នន័យ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'ទម្រង់បំពេញ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/currency',
                    name: 'currency-list',
                    component: () => import('@/views/setup/currency/CurrencyList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាងផ្នែក'},
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'រៀបចំទិន្នន័យ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/currency/form',
                    name: 'currency-form',
                    component: () => import('@/views/setup/currency/CurrencyForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'រៀបចំទិន្នន័យ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'ទម្រង់បំពេញ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/entity',
                    name: 'entity-list',
                    component: () => import('@/views/setup/entity/EntityList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាងផ្នែក'},
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'រៀបចំទិន្នន័យ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/entity/form',
                    name: 'entity-form',
                    component: () => import('@/views/setup/entity/EntityForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'រៀបចំទិន្នន័យ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'ទម្រង់បំពេញ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/position',
                    name: 'position-list',
                    component: () => import('@/views/setup/position/PositionList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាងផ្នែក'},
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'រៀបចំទិន្នន័យ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/position/form',
                    name: 'position-form',
                    component: () => import('@/views/setup/position/PositionForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'រៀបចំទិន្នន័យ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'ទម្រង់បំពេញ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/letter-type',
                    name: 'setup-letter-type-list',
                    component: () => import('@/views/setup/letter-type/LetterTypeList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាងផ្នែក'},
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'រៀបចំទិន្នន័យ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/letter-type/form',
                    name: 'setup-letter-type-form',
                    component: () => import('@/views/setup/letter-type/LetterTypeForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'រៀបចំទិន្នន័យ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'ទម្រង់បំពេញ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/role',
                    name: 'role-list',
                    component: () => import('@/views/setup/role/RoleList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាងផ្នែក'},
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'រៀបចំទិន្នន័យ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/role/form',
                    name: 'role-form',
                    component: () => import('@/views/setup/role/RoleForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'រៀបចំទិន្នន័យ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'ទម្រង់បំពេញ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/sector',
                    name: 'sector-list',
                    component: () => import('@/views/setup/sector/SectorList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាងផ្នែក'},
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'រៀបចំទិន្នន័យ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/sector/form',
                    name: 'sector-form',
                    component: () => import('@/views/setup/sector/SectorForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'រៀបចំទិន្នន័យ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'ទម្រង់បំពេញ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/title',
                    name: 'title-list',
                    component: () => import('@/views/setup/title/TitleList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាងផ្នែក'},
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'រៀបចំទិន្នន័យ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/title/form',
                    name: 'title-form',
                    component: () => import('@/views/setup/title/TitleForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'រៀបចំទិន្នន័យ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'ទម្រង់បំពេញ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/duty',
                    name: 'duty-list',
                    component: () => import('@/views/setup/duty/DutyList.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'តារាងផ្នែក'},
                            { title: 'List View', active: true },
                        ],
                        pageTitle: 'រៀបចំទិន្នន័យ',
                        rule: 'editor'
                    },
                },
                {
                    path: '/setup/duty/form',
                    name: 'duty-form',
                    component: () => import('@/views/setup/duty/DutyForm.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'រៀបចំទិន្នន័យ'},
                            { title: 'ទម្រង់', active: true },
                        ],
                        pageTitle: 'ទម្រង់បំពេញ',
                        rule: 'editor'
                    },
                },
                // =============================================================================
                // Incentives Report
                // =============================================================================
                {
                    path: '/report/incentive',
                    name: 'report-incentive',
                    component: () => import('@/views/reports/IncentiveReport.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បញ្ជីរបាយការណ៍'},
                            { title: 'របាយការណ៍ការបើកផ្តល់ប្រាក់ឧបត្ថម្ភ', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },
                {
                    path: '/report/incentive/letter_to_bank/:id',
                    name: 'report-incentive-letter-to-bank',
                    component: () => import('@/views/reports/IncentiveLetterToBank.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'របាយការណ៍លម្អិតការបើកផ្តល់ប្រាក់ឧបត្ថម្ភ', url: '/incentive/list'},
                            { title: 'លម្អិត', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },
                {
                    path: '/report/incentive/letter_to_GDNT/:id',
                    name: 'report-incentive-lettter-to-GDNT',
                    component: () => import('@/views/reports/IncentiveLetterToGDNT.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'របាយការណ៍លម្អិតការបើកផ្តល់ប្រាក់ឧបត្ថម្ភ', url: '/incentive/list'},
                            { title: 'លម្អិត', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },
                {
                    path: '/report/incentive/annex_to_GDNT/:id',
                    name: 'report-incentive-incentive-to-GDNT',
                    component: () => import('@/views/reports/IncentiveAnnexToGDNT.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'របាយការណ៍លម្អិតការបើកផ្តល់ប្រាក់ឧបត្ថម្ភ', url: '/incentive/list'},
                            { title: 'លម្អិត', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },
                {
                    path: '/report/incentive/incentive_to_bank/:id',
                    name: 'report-incentive-incentive-to-bank',
                    component: () => import('@/views/reports/IncentiveToBank.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'របាយការណ៍លម្អិតការបើកផ្តល់ប្រាក់ឧបត្ថម្ភ', url: '/incentive/list'},
                            { title: 'លម្អិត', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },
                {
                    path: '/report/incentive/incentive_to_lm/:id',
                    name: 'report-incentive-incentive-to-lm',
                    component: () => import('@/views/reports/IncentiveLetterToLM.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'របាយការណ៍លម្អិតការបើកផ្តល់ប្រាក់ឧបត្ថម្ភ', url: '/incentive/list'},
                            { title: 'លម្អិត', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },
                {
                    path: '/report/incentive/incentive_annex_to_lm/:id',
                    name: 'report-incentive-annex-to-lm',
                    component: () => import('@/views/reports/IncentiveAnnexToLM.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'របាយការណ៍លម្អិតការបើកផ្តល់ប្រាក់ឧបត្ថម្ភ', url: '/incentive/list'},
                            { title: 'លម្អិត', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },
                {
                    path: '/report/incentive/annex/:id',
                    name: 'report-incentive-annex',
                    component: () => import('@/views/reports/IncentiveAnnex.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'របាយការណ៍លម្អិតការបើកផ្តល់ប្រាក់ឧបត្ថម្ភ', url: '/incentive/list'},
                            { title: 'លម្អិត', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },
                {
                    path: '/report/entity',
                    name: 'report-entity',
                    component: () => import('@/views/reports/IncentiveByEntity.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បញ្ជីរបាយការណ៍'},
                            { title: 'របាយការណ៍ប្រាក់ឧបត្ថម្ភតាមវិស័យ', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },
                {
                    path: '/report/bank',
                    name: 'report-bank',
                    component: () => import('@/views/reports/IncentiveByBank.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បញ្ជីរបាយការណ៍'},
                            { title: 'របាយការណ៍ប្រាក់ឧបត្ថម្ភតាមធនាគារ', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },
                {
                    path: '/report/quarter',
                    name: 'report-quarter',
                    component: () => import('@/views/reports/IncentiveByQuarter.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បញ្ជីរបាយការណ៍'},
                            { title: 'របាយការណ៍ប្រាក់ឧបត្ថម្ភតាមត្រីមាស', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },
                {
                    path: '/report/monthly',
                    name: 'report-monthly',
                    component: () => import('@/views/reports/IncentiveMonthly.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បញ្ជីរបាយការណ៍'},
                            { title: 'របាយការណ៍ប្រាក់ឧបត្ថម្ភប្រចាំខែ', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },
                {
                    path: '/report/summary_income_outcome',
                    name: 'report-summary-income-outcome',
                    component: () => import('@/views/reports/SummaryIncomeOutcome.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'បញ្ជីរបាយការណ៍'},
                            { title: 'របាយការណ៍សង្ខេបចំណូល ចំណាយ', active: true },
                        ],
                        pageTitle: 'របាយការណ៍',
                        rule: 'editor'
                    },
                },

                // =============================================================================
                // Settings
                // =============================================================================
                {
                    path: '/setting',
                    name: 'data-user-form',
                    component: () => import('@/views/settings/Setting.vue'),
                    meta: {
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'អ្នកប្រើប្រាស់', url: '/user/list'},
                            { title: 'រាយនាមអ្នកប្រើប្រាស់', active: true },
                        ],
                        pageTitle: 'អ្នកប្រើប្រាស់',
                        rule: 'editor'
                    },
                },
                // =============================================================================
                // File Manager
                // =============================================================================
                {
                        path: '/file-manager',
                        name: 'file-manager',
                        component: () => import('./views/file-managers/FileManager.vue'),
                        meta: {
                            rule: 'editor',
                        }
                    },
        
            ],
        },
        
         // =============================================================================
        // FULL PAGE LAYOUTS
        // =============================================================================
        {
            path: '',
            component: () => import('@/layouts/full-page/FullPage.vue'),
            children: [
        // =============================================================================
        // PAGES
        // =============================================================================
                {
                    path: '/callback',
                    name: 'auth-callback',
                    component: () => import('@/views/Callback.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/pages/login',
                    name: 'page-login',
                    component: () => import('@/views/pages/login/Login.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/pages/register',
                    name: 'page-register',
                    component: () => import('@/views/pages/register/Register.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/pages/forgot-password',
                    name: 'page-forgot-password',
                    component: () => import('@/views/pages/ForgotPassword.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/pages/reset-password',
                    name: 'page-reset-password',
                    component: () => import('@/views/pages/ResetPassword.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/pages/lock-screen',
                    name: 'page-lock-screen',
                    component: () => import('@/views/pages/LockScreen.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/pages/comingsoon',
                    name: 'page-coming-soon',
                    component: () => import('@/views/pages/ComingSoon.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/pages/error-404',
                    name: 'page-error-404',
                    component: () => import('@/views/pages/Error404.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/pages/error-500',
                    name: 'page-error-500',
                    component: () => import('@/views/pages/Error500.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/pages/not-authorized',
                    name: 'page-not-authorized',
                    component: () => import('@/views/pages/NotAuthorized.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/pages/maintenance',
                    name: 'page-maintenance',
                    component: () => import('@/views/pages/Maintenance.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
            ]
        },
        
        // Redirect to 404 page, if no match found
        {
            path: '*',
            redirect: '/pages/error-404'
        }
    ],
})

router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = "none";
    }
})

router.beforeEach((to, from, next) => {
    firebase.auth().onAuthStateChanged(() => {

        // get firebase current user
        const firebaseCurrentUser = firebase.auth().currentUser

        // if (
        //     to.path === "/pages/login" ||
        //     to.path === "/pages/forgot-password" ||
        //     to.path === "/pages/error-404" ||
        //     to.path === "/pages/error-500" ||
        //     to.path === "/pages/register" ||
        //     to.path === "/callback" ||
        //     to.path === "/pages/comingsoon" ||
        //     (auth.isAuthenticated() || firebaseCurrentUser)
        // ) {
        //     return next();
        // }

        // If auth required, check login. If login fails redirect to login page
        if(to.meta.authRequired) {
          if (!(auth.isAuthenticated() || firebaseCurrentUser)) {
            router.push({ path: '/pages/login', query: { to: to.path } })
          }
        }

        return next()
        // Specify the current path as the customState parameter, meaning it
        // will be returned to the application after auth
        // auth.login({ target: to.path });

    });

});

export default router
