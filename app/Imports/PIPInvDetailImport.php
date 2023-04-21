<?php

namespace App\Imports;

use App\Models\Modules\BudgetArrangement\PIPInvDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Auth;
class PIPInvDetailImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(isset($row["pip_inv_id"]) && $row["pip_inv_id"]!=""){
            // $queryCheck = PIPInvDetai   l::where("pip_inv_id", (int)$row["pip_inv_id"])->delete();
            // if(!$queryCheck){
                PIPInvDetail::insert([
                    "pip_inv_id"=>$row["pip_inv_id"],
                    "entity_id"=>$row["entity_id"],
                    "attribute_en"=>$row["project_name_en"],
                    "attribute_kh"=>$row["project_name_kh"],
                    "est_costing_year_0"=>$row["est_costing_year_0"],
                    "est_costing_year_1"=>$row["est_costing_year_1"],
                    "est_costing_year_2"=>$row["est_costing_year_2"],
                    "s_fin_year_0"=>$row["s_fin_year_0"],
                    "s_fin_year_1"=>$row["s_fin_year_1"],
                    "s_fin_year_2"=>$row["s_fin_year_2"],
                ]);
            // }
        }
    }
}
