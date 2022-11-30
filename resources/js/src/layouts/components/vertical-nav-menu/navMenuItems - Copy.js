export default [
  {
    url: null,
    name: "Dashboard",
    tagColor: "warning",
    icon: "HomeIcon",
    i18n: "Dashboard",
    url: '/dashboard',
    slug: "dashboard",
  },

  // =============================================================================
  // Program Management
  // =============================================================================
  {
    url: null,
    name: "ProgramManagement",
    tagColor: "warning",
    icon: "AirplayIcon",
    i18n: "ProgramManagement",
    url: '/module/program-arragement',
    slug: "module-program-arragement",
  },
  
  {
    url: 'module',
    name: 'BudgetArrangement',
    tagColor: "primary",
    icon: "DollarSignIcon",
    i18n: "BudgetArrangement",
    submenu: [
      {
        url: '/module/budget-arrangement/budget-ceiling',
        slug: 'budget-ceiling',
        name: "BudgetCeiling",
        icon: "UserIcon",
        i18n: "CeilingBudget",
      },
      {
        url: '/module/budget-arrangement/pip',
        slug: 'pip',
        name: "PIP",
        icon: "UserIcon",
        i18n: "PublicInvestmentPlan",
      },
      {
        url: '/module/budget-arrangement/bsp',
        slug: 'bps',
        name: "BSP",
        icon: "UserIcon",
        i18n: "BudgetStrategyPlan",
      },
      {
        url: '/module/budget-arrangement/pb',
        slug: 'pb',
        name: "PB",
        icon: "UserIcon",
        i18n: "ProjectBudgetPlan",
      },
    ]
  },
  {
    url: null,
    name: 'BudgetMonitoring',
    tagColor: "primary",
    icon: "BarChart2Icon",
    i18n: "BudgetMonitoring",
    submenu: [
      {
        url: '/module/budget-monitoring/income-expense-arrangement',
        slug: 'income-expense-arrangement',
        name: "IncomeExpenseArrangement",
        icon: "UserIcon",
        i18n: "IncomeOutcomeProgram",
      },
      {
        url: '/module/budget-monitoring/income-implementing-result',
        slug: 'income-implementing-result',
        name: "IncomeExpenseResult",
        icon: "UserIcon",
        i18n: "IncomeOutcomeResult",
      },
      {
        url: '/module/budget-monitoring/expenditure-certificate',
        slug: 'expenditure-certificate',
        name: "ExpenditureCertificate",
        icon: "UserIcon",
        i18n: "ExpendCard",
      },
      {
        url: '/module/budget-monitoring/credit-movement',
        slug: 'credit-movement',
        name: "CreditMovement",
        icon: "UserIcon",
        i18n: "CreditMovement",
      },
    ]
},

  // =============================================================================
  // Budget Arrangement
  // =============================================================================

  // {
  //   url: null,
  //   name: 'Setup',
  //   tagColor: "primary",
  //   icon: "EditIcon",
  //   i18n: "Setup",
  //   submenu: [
  //     {
  //       url: '/setup/department',
  //       slug: 'department',
  //       name: "Department",
  //       icon: "UserIcon",
  //       i18n: "Department",
  //     },
  //     {
  //       url: '/setup/sector',
  //       slug: 'sector',
  //       name: "Sector",
  //       icon: "UserIcon",
  //       i18n: "Sector",
  //     },
  //     {
  //       url: '/setup/duty',
  //       slug: 'duty',
  //       name: "Duty",
  //       icon: "UserIcon",
  //       i18n: "Duty",
  //     },
  //     {
  //       url: '/setup/entity',
  //       slug: 'entity',
  //       name: "Entity",
  //       icon: "UserIcon",
  //       i18n: "Entity",
  //     },
  //     {
  //       url: '/setup/bank',
  //       slug: 'bank',
  //       name: "Bank",
  //       icon: "UserIcon",
  //       i18n: "Bank",
  //     },
  //     {
  //       url: '/setup/position',
  //       slug: 'position',
  //       name: "Position",
  //       icon: "UserIcon",
  //       i18n: "Position",
  //     },
  //     {
  //       url: '/setup/title',
  //       slug: 'title',
  //       name: "Title",
  //       icon: "UserIcon",
  //       i18n: "Title",
  //     },
  //     {
  //       url: '/setup/currency',
  //       slug: 'currency',
  //       name: "Currency",
  //       icon: "UserIcon",
  //       i18n: "Currency",
  //     },
  //     {
  //       url: '/setup/letter-type',
  //       slug: 'letter-type',
  //       name: "LetterType",
  //       icon: "UserIcon",
  //       i18n: "LetterType",
  //     },
  //   ]
  // },
  // {
  //   header: "IncentiveMgr",
  //   icon: "LayersIcon",
  //   i18n: "IncentiveMgr",
  //   items: [
  //     {
  //       url: null,
  //       name: "Incentive List",
  //       tagColor: "primary",
  //       icon: "FileTextIcon",
  //       i18n: "Incentive",
  //       submenu: [
  //         {
  //           url: '/officer/list',
  //           name: "List View",
  //           slug: "data-officer-list",
  //           i18n: "OfficerList",
  //         },
  //         {
  //           url: '/incentive/list',
  //           name: "List View",
  //           slug: "data-incentive-list",
  //           i18n: "IncentiveList",
  //         },
  //         {
  //           url: '/incentive/form',
  //           name: "Incentive Form",
  //           slug: "data-incentive-form-list",
  //           i18n: "FormIncentive",
  //         },
  //         {
  //           url: '/incentive/composition-request',
  //           name: "Composition Request View",
  //           slug: "data-composition-request-list",
  //           i18n: "CompositionRequest",
  //         },
  //       ]
  //     },
  //     {
  //       url: null,
  //       name: "Transactions",
  //       icon: "DollarSignIcon",
  //       i18n: "Transactions",
  //       submenu: [
  //         {
  //           url: '/account/income',
  //           name: "Select",
  //           icon: "PocketIcon",
  //           slug: "account-income",
  //           i18n: "Income",
  //         },
  //         {
  //           url: '/account/category',
  //           name: "Select",
  //           icon: "PocketIcon",
  //           slug: "account-category",
  //           i18n: "Category",
  //         },
  //         {
  //           url: '/account/bank-account',
  //           name: "Select",
  //           icon: "PocketIcon",
  //           slug: "account-bank-account",
  //           i18n: "BankAccount",
  //         },
  //         {
  //           url: '/account/account-group',
  //           name: "Select",
  //           icon: "PocketIcon",
  //           slug: "account-account-group",
  //           i18n: "AccountGroup",
  //         },
  //         {
  //           url: '/account/account',
  //           name: "Select",
  //           icon: "PocketIcon",
  //           slug: "account-account",
  //           i18n: "Account",
  //         },
  //         {
  //           url: '/account/account-type',
  //           name: "Select",
  //           icon: "PocketIcon",
  //           slug: "account-account-type",
  //           i18n: "AccountType",
  //         },
  //         {
  //           url: '/account/payment-method',
  //           name: "Select",
  //           icon: "PocketIcon",
  //           slug: "account-payment-method",
  //           i18n: "PaymentMethod",
  //         },
  //         {
  //           url: '/account/taxable-salary',
  //           name: "Select",
  //           icon: "PocketIcon",
  //           slug: "account-taxable-salary",
  //           i18n: "TaxableSalary",
  //         },
  //       ]
  //     },
  //   ]
  // },
  // {
  //   url: null,
  //   name: "User",
  //   icon: "UserIcon",
  //   i18n: "User",
  //   submenu: [
  //     {
  //       url: '/user/list',
  //       name: "app-user-list",
  //       slug: "app-user-list",
  //       i18n: "UserList",
  //     },
  //     {
  //       url: '/role/list',
  //       name: "app-user-role",
  //       slug: "app-user-role",
  //       i18n: "RoleList",
  //     },
  //   ]
  // },
  {
    url: '/file-manager',
    name: "FileManager",
    slug: "file-manager",
    tagColor: "warning",
    icon: "FileTextIcon",
    i18n: "FileManager",
  },
  {
    url: 'report',
    name: 'Report',
    slug: "report",
    tagColor: "primary",
    icon: "BarChart2Icon",
    i18n: "Report",
    // submenu: [
    //   {
    //     url: "/report/summary_income_outcome",
    //     name: "ReportOfficerByEntity",
    //     slug: "ReportOfficerByEntity",
    //     icon: "MailIcon",
    //     i18n: "ReportSummaryIncomeExpense",
    //   },
    // ]
  },  
]

