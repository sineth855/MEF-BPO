<?php

namespace App\Models\Modules\BudgetArrangement;
use App\Models\Modules\Settings\AccountGroup;
use App\Models\Modules\Settings\Account;
use Illuminate\Database\Eloquent\Model;

class PBExpenditure extends Model
{
  protected $table = 'mef_expenditure';
  protected $fillable = [
                          'planning_id',
                          'entity_id',
                          'account_group_id',
                          'account_id',
                          'sub_account_id',
                          'imple_income_budget',
                          'annual_credit',
                          'review_credit',
                          'new_credit',
                          'imple_budget_semester_1',
                          'imple_estimate_budget_semester_2',
                          'total_estimate_budget',
                          'percent_credit_budget_rule',
                          'new_credit_budget',
                          'total_budget_plan',
                          'percentage_credit_budget_plan',
                          'percentage_new_credit_rule_plan',
                          'total_compare_year',
                          'percentage_compare_credit_rule',
                          'non_regular_expense',
                          'description_inc_dec',
                          'is_delete',
                          'created_by',
                          'modified_by'
                        ];
                        
  public $timestamps = true;

  public static function getSumaryExpeditures($filters){

  }

  public static function getExpenditures($filters){
    $accGroupArr = array();
    $queryAccountGroups = AccountGroup::where("group", 2)->orderBy("order_level")->get();
    foreach($queryAccountGroups as $accGroup){
      $accArr = array();
      $accGroupId = $accGroup->id;
      $queryAccounts = Account::where("account_group_id", $accGroupId)->orderBy("order_level")->get();
      foreach($queryAccounts as $acc){
        $subAccArr = array();
        $accId = $acc->id;
        $querySubAccounts = Account::where("parent_id", $accId)->orderBy("order_level")->get();
        foreach($querySubAccounts as $subAcc){
          $subAccArr[] = array(
            "code" => ""
          );
        }
        $accArr[] = array(
          "code" => ""
        );
      }
      $accGroupArr[] = array(
        "code" => ""
      );
    }

    return $accGroupArr;
  }

}