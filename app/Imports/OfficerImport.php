<?php

namespace App\Imports;

use App\Models\IncentiveOfficer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
class OfficerImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row["fname"]);
        // $explodeName = explode(" ", $row["fname"]);
        // dd($explode);
        // return false;
        $status = 0;
        switch ($row["status"]) {
            case 'Active':
                # code...
                $status = 1;
                break;
            case 'Inactive':
                # code...
                $status = 0;
                break;
        }
        // $duty_id = "";
        // switch ($row["duty"]) {
        //     case 'ប្រធាន​':
        //         # code...
        //         $duty_id = 4;
        //         break;
        //     case 'អនុប្រធាន':
        //         # code...
        //         $duty_id = 6;
        //         break;
        //     case 'មន្ត្រីបង្គោល':
        //         # code...
        //         $duty_id = 7;
        //         break;
        //     case 'សមាជិក':
        //         # code...
        //         $duty_id = 8;
        //         break;
        // }

        $entity_id = 0;
        
        $entityInfo = DB::table("entity as e")->Join("department as d", "d.id" ,"=" ,"e.department_id")->Select("e.id", "d.name as department", "d.id as deparment_id")->where("code", $row["code"])->first();
        // dd($entityInfo);
        if($entityInfo){
            $entity_id = $entityInfo->id;
        }
        // dd($row);
        // if(isset($explodeName[2])){
            // IncentiveOfficer::delete();
            // DB::table("incentive_officer")->delete();
            $checkHasIncentive = IncentiveOfficer::where("identity_no", $row["identity_no"])->first();
            if(!$checkHasIncentive){
                return new IncentiveOfficer([
                    "id" => $row["id"],
                    // "user_id" => $row["user_id"],
                    "identity_no" => $row["identity_no"],
                    "title" => $row["title"],
                    "first_name" => $row["first_name"],
                    "last_name" => $row["last_name"],
                    // "latin" => $row["latin"],
                    "duty" => $row["duty"],
                    "duty_id" => $row["duty_id"],
                    "entity" => $row["entity"],
                    "entity_id" => $entity_id,
                    "department" => $entityInfo->department,
                    "position" => $row["duty"],
                    // "gender" => $row["gender"],
                    // "address" => $row["address"],
                    "email" => $row["email"],
                    "bank_account_no" => $row["bank_account_no"],
                    "bank_name" => $row["bank_name"],
                    "bank_id" => $row["bank_id"],
                    // "bank_code" => $row["bank_code"],
                    "telephone_1" => $row["telephone_1"],
                    // "telephone_2" => $row["telephone_2"],
                    "updated_bank_acc" => $row["updated_bank_acc"],
                    "status" => $status
                ]);
            }
        // }
    }
}
