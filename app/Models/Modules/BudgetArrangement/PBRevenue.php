<?php

  namespace App\Models\Modules\BudgetArrangement;
  use App\Models\Settings\Account;
  use App\Models\Settings\AccountGroup;
  use App\Models\Settings\AccountType;
  use App\Models\Settings\AccountTypeGroup;
  use Illuminate\Database\Eloquent\Model;

  class PBRevenue extends Model
  {
    protected $table = 'mef_revenue';
    protected $fillable = [
                            'planning_id',
                            'account_id',
                            'sub_account_id',
                            'imple_income_budget',
                            'rule_basic_income_plan',
                            'rule_qty_income_plan',
                            'rule_budget_credit',
                            'imple_budget_semester_1',
                            'imple_budget_semester_2',
                            'annual_estimate',
                            'percentage_rule',
                            'basic_income_plan',
                            'qty_income_plan',
                            'total_income_plan',
                            'percentage_income_plan',
                            'is_delete',
                            'created_by',
                            'modified_by',
                          ];
    public $timestamps = true;

    public static function getRevenues(){
      $accountTypeGroups = AccountTypeGroup::orderBy("order_level")->limit("1")->get();
      $accountTypeGroupArr = array();
      foreach($accountTypeGroups as $accountTypeGroup){
        $accountTypeGroupId = $accountTypeGroup->id;
        $accountTypes = AccountType::where("account_type_group_id", $accountTypeGroupId)->limit("1")->orderBy("order_level")->get();
        $accTypeArr = array();
        if($accountTypes){
          foreach($accountTypes as $accountType){
            $accountTypeId = $accountType->id;
            $accountGroups = AccountGroup::where("account_type_id", $accountTypeId)
                              ->orderBy("order_level")->get();
            $accountGroupArr = array();
            // if($accountGroups){
            //   foreach($accountGroups as $accountGroup){
            //     $accountGroupId = $accountGroup->id;
            //     // $accounts = Account::where("account_group_id", $accountGroupId)
            //     //                     ->orderBy("order_level")->get();
            //     // $accountArr = array();
            //     // foreach($accounts as $account){
            //     //   $accountId = $account->id;
            //     //   // $subAccounts = Account::where("account_group_id", $accountGroupId)
            //     //   //                       ->where("parent_id", $accountId)
            //     //   //                       ->orderBy("order_level")
            //     //   //                       ->get();
            //     //   $subAccountArr = array();
            //     //   // foreach($subAccounts as $subAccount){
            //     //   //   $subAccountId = $subAccount->id;
            //     //   //   $revenues = PBRevenue::where("account_id", $accountId) 
            //     //   //                         ->where("sub_account_id", $subAccountId)
            //     //   //                         ->where("planning_id", PLANNING_YEAR)
            //     //   //                         ->limit(1)
            //     //   //                         ->get();
            //     //   //   $revenueArr = array();
            //     //   //   foreach($revenues as $revenue){
            //     //   //     $revenueArr[] = array(
            //     //   //       "imple_income_budget" => $revenue->imple_income_budget,
            //     //   //       "rule_basic_income_plan" => $revenue->rule_basic_income_plan,
            //     //   //       "rule_qty_income_plan" => $revenue->rule_qty_income_plan,
            //     //   //       "rule_budget_credit" => $revenue->rule_budget_credit,
            //     //   //       "imple_budget_semester_1" => $revenue->imple_budget_semester_1,
            //     //   //       "imple_budget_semester_2" => $revenue->imple_budget_semester_2,
            //     //   //       "annual_estimate" => $revenue->annual_estimate,
            //     //   //       "percentage_rule" => $revenue->percentage_rule,
            //     //   //       "basic_income_plan" => $revenue->basic_income_plan,
            //     //   //       "qty_income_plan" => $revenue->qty_income_plan,
            //     //   //       "total_income_plan" => $revenue->total_income_plan,
            //     //   //       "percentage_income_plan" => $revenue->percentage_income_plan,
            //     //   //       "is_delete" => $revenue->is_delete,
            //     //   //       "created_at" => $revenue->created_at,
            //     //   //       "updated_at" => $revenue->updated_at,
            //     //   //       "created_by" => $revenue->created_by,
            //     //   //       "modified_by" => $revenue->modified_by,
            //     //   //     );
            //     //   //   }
            //     //   //   $subAccountArr[] = array(
            //     //   //     "code" => $subAccount->code, 
            //     //   //     "name_en" => $subAccount->name_en,
            //     //   //     "name_kh" => $subAccount->name_kh,
            //     //   //     "description" => $subAccount->description,
            //     //   //     "order_level" => $subAccount->order_level, 
            //     //   //     "revenues" => $revenueArr
            //     //   //   );
            //     //   // }
            //     //   $accountArr[] = array(
            //     //     "code" => $account->code, 
            //     //     "name_en" => $account->name_en,
            //     //     "name_kh" => $account->name_kh,
            //     //     "description" => $account->description,
            //     //     "order_level" => $account->order_level, 
            //     //     "sub_accounts" => $subAccountArr
            //     //   );
            //     // }
            //     $accountGroupArr[] = array(
            //       "title_en" => $accountGroup->title_en,
            //       "title_kh" => $accountGroup->title_kh,
            //       "order_level" => $accountGroup->order_level, 
            //       "account_groups" => $accountGroupArr
            //     );
            //   }
            // }
            $accTypeArr[] = array(
              "title_en" => $accountType->title_en,
              "title_kh" => $accountType->title_kh,
              "order_level" => $accountType->order_level,
              "account_groups" => $accountGroupArr
            );
          }
        }
        $accountTypeGroupArr[] = array(
          "title_en" => $accountTypeGroup->title_en,
          "title_kh" => $accountTypeGroup->title_kh,
          "order_level" => $accountTypeGroup->order_level,
          "account_group_types" => $accTypeArr
        );
      }
      return $accountTypeGroupArr;
    }
  }