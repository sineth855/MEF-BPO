<?php

namespace App\Models\Modules\BudgetArrangement;

use Illuminate\Database\Eloquent\Model;

class PBExpense extends Model
{
  protected $table = 'mef_expense';
  protected $fillable = [
                          'planning_id',
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
                          'modified_by',
                          'created_at',
                          'updated_at'
                        ];
                        
  public $timestamps = true;
}