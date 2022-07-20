<?php

namespace App\Imports;

use App\Models\Income;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
// class IncomeImport implements ToModel,WithHeadingRow
class IncomeImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Condition this block to roll out and import Imcome of the file base on format provided
        // $year = 2020;
        for($i = 1; $i <= 12; $i++){
            $entity_id = 0;
            $entityInfo = DB::table("entity as e")->Select("e.name as entity","e.id")->where("code", $row["code"])->first();
            $month = "";
            if($i <= 9){
                $month = "0".$i;
            }else{
                $month = $i;
            }
            if($entityInfo){
                $entity_id = $entityInfo->id;
                $issue_date = "";
                switch ($i){
                    case "1":
                        # code...
                        $issue_date = $row["year"]."-".$month."-01";
                        break;
                    
                    case '2':
                        $issue_date = $row["year"]."-".$month."-01";
                        # code...
                        break;
                    case '3':
                        $issue_date = $row["year"]."-".$month."-01";
                        # code...
                        break;
                    case '4':
                        $issue_date = $row["year"]."-".$month."-01";
                        # code...
                        break;
                    case '5':
                        $issue_date = $row["year"]."-".$month."-01";
                        # code...
                        break;
                    case '6':
                        $issue_date = $row["year"]."-".$month."-01";
                        # code...
                        break;
                    case '7':
                        $issue_date = $row["year"]."-".$month."-01";
                        # code...
                        break;
                    case '8':
                        $issue_date = $row["year"]."-".$month."-01";
                        # code...
                        break;
                    case '9':
                        $issue_date = $row["year"]."-".$month."-01";
                        # code...
                        break;
                    case '10':
                        $issue_date = $row["year"]."-".$month."-01";
                        # code...
                        break;
                    case '11':
                        $issue_date = $row["year"]."-".$month."-01";
                        # code...
                        break;
                    case '12':
                        $issue_date = $row["year"]."-".$month."-01";
                        # code...
                        break;
                    default:
                        $issue_date = $row["year"]."-01-01";
                        break;
                }
                // Income::where("issue_date", $issue_date)->delete();
                // DB::table("entity as e")->Select("e.name as entity","e.id")->where("code", $row["code"])->first();
                Income::where("entity", $row["entity"])
                        ->where("entity_id", $entity_id)
                        ->where("issue_date", $issue_date)->delete(); 
                Income::insert([
                    // "account_group" => $row["account_group"],
                    // "account_type" => $row["account_type"],
                    // "account" => $row["account"],
                    "title" => "របាយការណ៍ចំណូលរង្វាន់លើកទឹកចិត្ត ១% របស់ ".$row["entity"]."",
                    // "description" => $row["description"],
                    "issue_date" => $issue_date,
                    // "category" => $row["category"],
                    // "payment_method" => $row["payment_method"],
                    "amount" => (float)$row["month_".$i.""],
                    "exchange_rate" => '4000',//$row["exchange_rate"],
                    // "reference" => $row["reference"],
                    "entity" => $row["entity"],
                    "entity_id" => $entity_id,
                    "currency" => "រៀល",
                ]);
                // return new Income([
                //     // "account_group" => $row["account_group"],
                //     // "account_type" => $row["account_type"],
                //     // "account" => $row["account"],
                //     "title" => "របាយការណ៍ចំណូលរង្វាន់លើកទឹកចិត្ត ១% របស់ក្រសួង ស្ថាប័ន ".$row["entity"]."",
                //     // "description" => $row["description"],
                //     // "issue_date" => $row["issue_date"],
                //     // "category" => $row["category"],
                //     // "payment_method" => $row["payment_method"],
                //     "amount" => $row["month_".$i.""],
                //     "exchange_rate" => '4000',//$row["exchange_rate"],
                //     // "reference" => $row["reference"],
                //     "entity" => $row["entity"],
                //     "entity_id" => $entity_id,
                //     "currency" => "រៀល",
                // ]);
            }
        }
    }
}
