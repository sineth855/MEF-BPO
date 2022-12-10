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
  // Program Management - គ្រប់គ្រងកម្មវិធី
  // =============================================================================
  {
    url: null,
    name: "ProgramManagement",
    tagColor: "warning",
    icon: "AirplayIcon",
    i18n: "ProgramManagement",
    url: '/module/program-arrangement',
    slug: "module-program-arrangement",
    submenu: [
      {
        url: '/module/program-arrangement',
        slug: 'program-arrangement',
        name: "program-arrangement",
        icon: "UserIcon",
        i18n: "ProgramArrangement",
      },
      {
        url: '/module/program-arrangement/objective',
        slug: 'objective',
        name: "objective",
        icon: "UserIcon",
        i18n: "ProgramObjective",
      },
      {
        url: '/module/program-arrangement/program',
        slug: 'program',
        name: "program",
        icon: "UserIcon",
        i18n: "ProgramProgram",
      },
      {
        url: '/module/program-arrangement/subprogram',
        slug: 'subprogram',
        name: "subprogram",
        icon: "UserIcon",
        i18n: "ProgramSubProgram",
      },
      {
        url: '/module/program-arrangement/cluster-activity',
        slug: 'cluster-activity',
        name: "cluster-activity",
        icon: "UserIcon",
        i18n: "ProgramClusterActivity",
      },
      {
        url: '/module/program-arrangement/activity',
        slug: 'activity',
        name: "activity",
        icon: "UserIcon",
        i18n: "ProgramActivity",
      },
    ]
  },
  // =============================================================================
  // Budget Arrangement - រៀបចំថវិកា
  // =============================================================================
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
  // =============================================================================
  // Budget Monitoring - តាមដានអនុវត្តថវិកា
  // =============================================================================
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
  // File Management - ឃាំ្លងឯកសារ
  // =============================================================================
  {
    url: '/file-manager',
    name: "FileManager",
    slug: "file-manager",
    tagColor: "warning",
    icon: "FileTextIcon",
    i18n: "FileManager",
  },
  // =============================================================================
  // Report - គ្រប់គ្រងរបាយការណ៍
  // =============================================================================
  {
    url: '/report',
    name: 'Report',
    slug: "report",
    tagColor: "primary",
    icon: "BarChart2Icon",
    i18n: "Report"
  },  
]

