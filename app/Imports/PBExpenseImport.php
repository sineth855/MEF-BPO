<?php

namespace App\Imports;

use App\Models\Modules\BudgetArrangement\PBExpense;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Auth;
class PBExpenseImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $queryCheck = PBExpense::where("id", (int)$row["id"])->first();
        // if($row["chapter_id"]!="" && $row["account_id"]!="" && $row["sub_account_id"]!=""){
        PBExpense::insert([
            'id' => $row["id"],
            'planning_id' => $row["planning_id"],
            'account_group_id' => $row["account_group_id"],
            'account_id' => $row["account_id"],
            'sub_account_id' => $row["sub_account_id"],
            'imple_income_budget' => flatval($row["imple_income_budget"]),
            'annual_credit' => flatval($row["annual_credit"]),
            'review_credit' => flatval($row["review_credit"]),
            'new_credit' => flatval($row["new_credit"]),
            'imple_budget_semester_1' => flatval($row["imple_budget_semester_1"]),
            'imple_estimate_budget_semester_2' => flatval($row["imple_estimate_budget_semester_2"]),
            'total_estimate_budget' => flatval($row["total_estimate_budget"]),
            'percent_credit_budget_rule' => (int)$row["percent_credit_budget_rule"],
            'new_credit_budget' => flatval($row["new_credit_budget"]),
            'total_budget_plan' => flatval($row["total_budget_plan"]),
            'percentage_credit_budget_plan' => (int)$row["percentage_credit_budget_plan"],
            'percentage_new_credit_rule_plan' => (int)$row["percentage_new_credit_rule_plan"],
            'total_compare_year' => flatval($row["total_compare_year"]),
            'percentage_compare_credit_rule' => (int)$row["percentage_compare_credit_rule"],
            'non_regular_expense' => flatval($row["non_regular_expense"]),
            'description_inc_dec' => $row["description_inc_dec"],
            'created_by' => Auth::user()->id,
            'is_delete' => 0,
        ]);
        // }
    }
}