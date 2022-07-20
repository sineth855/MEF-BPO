<?php

namespace App\Imports;
use App\Models\Incentive;
use App\Models\IncentiveOfficer;
use App\Models\IncentiveToOfficer;
use App\Models\IncentiveToBank;
use App\Models\IncentiveToEntity;
use App\Models\Entity;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Auth; 

class OfficerExpenseIncentiveImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // print_r($dateExplode);
        // dd(date("Y-m-d", "1583020800"));
        // dd($dateExplode);
        // dd(date("Y-m-d", "1583020800"));
        // return false;

        $checkHasIncentive = Incentive::where("issue_date", $row["issue_from_date"])->first();
        if(!$checkHasIncentive){
            Incentive::create([
                'title' => "បើកផ្តល់ប្រាក់ឧបត្ថម្ភប្រចាំខែ ".$row['issue_from_date']. " ដល់ ". $row['issue_to_date'],
                'sent_to' => "",
                'prepared_by' => "",
                'seen_by' => "",
                'approved_by' => "",
                'reference' => "",
                'letter_type' => "",
                'issue_date' => $row["issue_from_date"],
                'issue_from_date' => $row["issue_from_date"],
                'issue_to_date' => $row["issue_to_date"],
                'effective_date' => date("Y-m-d"),
                'attach_fille' => "",
                'is_approve' => "1",
                'created_by' => Auth::user()->id,
                'modified_by' => Auth::user()->id,
                'created_at' => date("Y-m-d"),
                'updated_at' => date("Y-m-d")
            ]);
            $incentiveInfo = Incentive::where("issue_date", $row["issue_from_date"])->first();
        }else{
            $incentiveInfo = Incentive::where("issue_date", $row["issue_from_date"])->first();
        }
        
        $checkIncentiveToBank = IncentiveToBank::where("incentive_id", $incentiveInfo->id)->where("bank_id", $row["bank_id"])->first();
        if(!$checkIncentiveToBank){
            if($row["bank_id"] != 0){
                IncentiveToBank::create([
                    "incentive_id" => $incentiveInfo->id,
                    "bank_id" => $row["bank_id"] ? $row["bank_id"] : 0,
                    "remark" => "",
                    "exchange_rate" => "4000"
                ]);
            }
        }

        $officerInfo = IncentiveOfficer::where("identity_no", $row["officer_id"])->first();
        $entityInfo = Entity::where("code", $row["entity_code"])->first();

        if(!$entityInfo){
            
        }else{
            $checkIncentiveToEntity = IncentiveToEntity::where("incentive_id", $incentiveInfo->id)
                                                        ->where("entity_id", $entityInfo->id)->first();
            if(!$checkIncentiveToEntity){
                IncentiveToEntity::create(
                    [
                        "incentive_id" => $incentiveInfo->id,
                        "entity_id" => $entityInfo->id
                    ]
                );
            }
        }
        if(!$officerInfo){
            dd($row["officer_id"]);
        }
        
        Incentive::where("id", $incentiveInfo->id)->update(
            [
                "total_incentive" => DB::raw('total_incentive + '.$row["incentive"].''),
                "total_tax" => DB::raw('total_tax + '.$row["taxable_payment"].''),
                "total_officer" => (IncentiveToOfficer::where("incentive_id", $incentiveInfo->id)->count() + 1),
                "total_entity" => IncentiveToEntity::where("incentive_id", $incentiveInfo->id)->count(),
            ]
        );
        
        return new IncentiveToOfficer([
            "incentive_id" => $incentiveInfo->id,
            "officer_id" => $officerInfo->id?$officerInfo->id:0,
            "entity" => $entityInfo->name ? $entityInfo->name : null,
            "entity_id" => $entityInfo->id ? $entityInfo->id : null,
            "position" => "",
            "duty" => $row["duty"],
            "bank" => $row["bank"],
            "bank_account_no" => $row["account_bank"],
            "bank_code" => "",
            "bank_id" => $row["bank_id"] ? $row["bank_id"] : 0,
            // "identity_card" => $row["officer_id"],
            "index" => $row["index"],
            "achievement" => "",
            "reference_id" => 0,
            "incentive" => floatval($row["incentive"]),
            "tax" => floatval($row["taxable_payment"]),
            "return_amount" => floatval($row["return_amount"]),
            "incentive_after_tax" => floatval($row["incentive_after_tax"]),
            "reminder_amount" => floatval($row["reminder_incentive"]),
            "remark" => "",
            "issue_from_date" => $row["issue_from_date"],
            "issue_to_date" => $row["issue_to_date"],
            "is_notify" => 0,
            "created_by" => Auth::user()->id,
        ]);

        
    }
}
