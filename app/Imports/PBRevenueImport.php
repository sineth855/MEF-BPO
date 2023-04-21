<?php

namespace App\Imports;

use App\Models\Modules\BudgetArrangement\PBRevenue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Auth;
class PBRevenueImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd(count($row));
        $queryCheck = PBRevenue::where("id", (int)$row["id"])->first();
        if(!$queryCheck){
            PBRevenue::insert([
                'id' => $row["id"],
                'planning_id' => $row["planning_id"],
                'account_id' => $row["account_id"],
                'sub_account_id' => (int)$row["sub_account_id"],
                'imple_income_budget' => $row["imple_income_budget"],
                'rule_basic_income_plan' => $row["rule_basic_income_plan"],
                'rule_qty_income_plan' => (int)$row["rule_qty_income_plan"],
                'rule_budget_credit' => $row["rule_budget_credit"],
                'imple_budget_semester_1' => $row["imple_budget_semester_1"],
                'imple_budget_semester_2' => $row["imple_budget_semester_2"],
                'annual_estimate' => $row["annual_estimate"],
                'percentage_rule' => $row["percentage_rule"],
                'basic_income_plan' => $row["basic_income_plan"],
                'qty_income_plan' => (int)$row["qty_income_plan"],
                'total_income_plan' => $row["total_income_plan"],
                'percentage_income_plan' => $row["percentage_income_plan"],
                'is_delete' => 0,
                'created_by' => Auth::user()->id,
            ]);
        }
    }
}