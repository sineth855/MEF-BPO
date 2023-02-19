<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get("/users", function() {
    $users = factory(User::class, 100)->make();
    return $users;
});


Route::group([
    'prefix' => 'auth'
], function () {
    Route::group([
        'middleware' => ['cors', 'global_site']
    ], function() {
        Route::post('login', 'AuthController@login');
        Route::post('device_login_otp', 'AuthController@loginMobileOTP');
        Route::post('verify_otp', 'AuthController@VerifyMobileOTP');
        Route::post('device_login', 'AuthController@loginMobile');
        Route::post('signup', 'AuthController@signup');
    });
    Route::group([
        'middleware' => ['auth:api', 'global_site', 'cors']
    ], function() {
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

Route::group([
    'prefix' => 'v1/mobile'
], function () {
    Route::group([
        'middleware' => ['auth:api', 'global_site']
    ], function() {
        Route::resource('department', 'DepartmentController');
        Route::resource('incentive', 'MobileIncentiveController');
        Route::get('profile', 'UserController@getProfile');
        Route::post('profile', 'UserController@updateProfile');
        Route::get('summary', 'MobileIncentiveController@summary');
        Route::resource('notification', 'NotificationController');
        Route::post('FCMregisterDevice', 'AuthController@registerDevice');
    });
});

Route::group([
    'prefix' => 'v1'
], function () {
    Route::group([
        'middleware' => ['auth:api', 'global_site', 'cors']
    ], function() {
        // គ្រប់គ្រងកម្មវិធី
        Route::post('module/program_management/objective/search', 'Modules\ProgramManagement\ObjectiveController@index');
        Route::post('module/program_management/program/search', 'Modules\ProgramManagement\ProgramController@index');
        Route::post('module/program_management/sub_program/search', 'Modules\ProgramManagement\SubProgramController@index');
        Route::post('module/program_management/cluster_activity/search', 'Modules\ProgramManagement\ClusterActivityController@index');
        Route::post('module/program_management/activity/search', 'Modules\ProgramManagement\ActivityController@index');
        // Setting
        Route::resource('module/program_management/objective', 'Modules\ProgramManagement\ObjectiveController');
        Route::resource('module/program_management/program', 'Modules\ProgramManagement\ProgramController');
        Route::resource('module/program_management/sub_program', 'Modules\ProgramManagement\SubProgramController');
        Route::resource('module/program_management/cluster_activity', 'Modules\ProgramManagement\ClusterActivityController');
        Route::resource('module/program_management/activity', 'Modules\ProgramManagement\ActivityController');

        Route::resource('setting/department', 'Settings\DepartmentController');
        Route::resource('setting/sector', 'Settings\SectorController');
        Route::resource('setting/duty', 'Settings\DutyController');
        Route::resource('setting/entity', 'Settings\EntityController');
        Route::resource('setting/bank', 'Settings\BankController');
        Route::resource('setting/position', 'Settings\PositionController');
        Route::resource('setting/title', 'Settings\TitleController');
        Route::resource('setting/role', 'Settings\RoleController');
        Route::resource('setting/currency', 'Settings\CurrencyController');
        Route::resource('setting/taxable_salary', 'Settings\TaxableSalaryController');
        Route::resource('setting/notificatoin_type', 'Settings\NotificationTypeController');
        Route::resource('setting/circular', 'Settings\CircularController');
        Route::resource('setting/incentive_officer', 'Settings\IncentiveOfficerController');

        Route::post('update_officer_user', 'IncentiveOfficerController@updateIncentiveOfficer');
        Route::post('incentive/officer_by_bank', 'IncentiveController@getIncentiveOfficerByBanks');
        Route::resource('incentive', 'IncentiveController');
        Route::resource('letter_type', 'LetterTypeController');
        Route::resource('document_type', 'DocumentTypeController');
        Route::resource('document_template', 'DocumentTemplateController');
        Route::resource('composition_request', 'CompositionRequestController');
        Route::resource('user', 'UserController');
        Route::resource('payment_method', 'PaymentMethodController');
        Route::resource('category', 'CategoryController');
        Route::resource('account', 'AccountController');
        Route::resource('account_type', 'AccountTypeController');
        Route::resource('bank_account', 'BankAccountController');
        Route::resource('account_group', 'AccountGroupController');
        Route::resource('expense', 'ExpenseController');
        Route::resource('income', 'IncomeController');
        Route::resource('configuration', 'ConfigurationController');
        Route::get('report/summary', 'ReportController@summary');
        Route::get('report/summary_income_outcome', 'ReportController@summaryIncomeOutcome');
        Route::get('report/income_by_sector', 'ReportController@incomeBySector');
        Route::get('report/income_by_entity', 'ReportController@incomeByEntity');
        Route::get('report/expense_by_entity', 'ReportController@expenseByEntity');
        Route::get('report/expense_by_sector', 'ReportController@expenseBySector');
        Route::get('report/income_outcome_by_quarter', 'ReportController@getIncomeOutcomeByQuarter');
        Route::get('report/income_tax_monthly', 'ReportController@incomeTaxMonthly');
        Route::get('report/top_rank_income', 'ReportController@getTopRankEntity');
        Route::post('report/convert/convert_excel_by_bank', 'ReportController@convertToExcelByBank');
        Route::post('report/convert/convert_annex_lm_to_excel', 'ReportController@convertAnnexLMToExcel');
        Route::post('report/convert/convert_annex_bank_to_excel', 'ReportController@convertAnnexBankToExcel');
        Route::post('report/convert/convert_annex_gdnt_excel', 'ReportController@convertAnnexGDNTToExcel');
        Route::post('report/convert/convert_summary_income_outcome_excel', 'ReportController@convertSummaryIncomeOutcomeToExcel');
        // getOfficerByEntities
        Route::get('officer_group_by_entities', 'IncentiveOfficerController@getOfficerGroupByEntities');
        Route::get('officer_by_entities', 'IncentiveOfficerController@getOfficerByEntities');
        Route::get('officer_list_by_entities', 'IncentiveOfficerController@getOfficerListByEntities');
        // Upload File
        Route::post('file_upload', 'FileManagerController@fileUploadService');
        Route::post('file_officer_upload', 'FileManagerController@fileUploadOfficer');
        Route::post('file_officer_expense_upload', 'FileManagerController@OfficerIncentiveExpenseImport');
        Route::post('file_income_upload', 'FileManagerController@fileIncomeUploadService');
        Route::post('file_outcome_upload', 'FileManagerController@fileOutcomeUploadService');
        // Send Push Notification
        Route::post('send_notification', 'NotificationController@sendNotification');
    });
});