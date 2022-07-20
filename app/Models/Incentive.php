<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use CommonService;
class Incentive extends Model
{
    protected $table = 'incentive';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'title',
                            'sent_to',
                            'khmer_date',
                            'khmer_day',
                            'prepared_by',
                            'seen_by',
                            'approved_by',
                            'reference',
                            'letter_type',
                            'issue_date',
                            'issue_from_date',
                            'issue_to_date',
                            'effective_date',
                            'attach_fille',
                            'is_approve',
                            'allow_cal_tax',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;

    public static function getIncentiveByBanks($incentive_id){
      $query = DB::table("incentive_to_officer as i2o")
                ->Select('i2o.bank_id', DB::raw('sum(incentive_after_tax) as total_incentive'), 'b.id as id', 'b.name as label')
                ->Join('bank as b', 'b.id', '=', 'i2o.bank_id')
                ->Where('i2o.incentive_id', '=', $incentive_id)
                ->GroupBy('i2o.bank_id', 'id', 'name')
                ->OrderBy('b.order_level')
                ->get();
      $incentiveArr = array();
      $i = 1;
      foreach($query as $row){
        // $incentiveArr[] = array(
        //   "no" => Incentive::convertToKhmerNumber($i),
        //   "id" => $row->id,
        //   "label" => $row->label,
        //   "total_incentive" => Incentive::convertToKhmerNumber($row->total_incentive),
        //   "exchange_rate" => Incentive::convertToKhmerNumber($row->exchange_rate)
        // );
        $incentiveArr[] = array(
          "no" => $i,
          "id" => $row->id,
          "label" => $row->label,
          "total_incentive" => $row->total_incentive,
          "exchange_rate" => 4000
        );
        $i++;
      }
      return $incentiveArr;
    }

    public static function getIncentiveOfficerByBanks($incentive_id, $bank_id){
      $query = DB::table("incentive_to_officer as i2o")
                ->Select('i2o.entity_id', DB::raw('sum(incentive) as total_incentive'), DB::raw('sum(incentive_after_tax) as total_incentive_after_tax'), 'e.name as entity')
                ->Join('entity as e', 'e.id', '=', 'i2o.entity_id')
                ->Where('i2o.incentive_id', '=', $incentive_id)
                ->Where('i2o.bank_id', '=', $bank_id)
                ->OrderBy('e.order_level')
                ->GroupBy('i2o.entity_id', 'e.name')
                ->get();
      $incentiveArr = array();
      $i = 1;
      foreach($query as $row){
        // $incentiveArr[] = array(
        //   "no" => Incentive::convertToKhmerNumber($i),
        //   "id" => $row->id,
        //   "label" => $row->label,
        //   "total_incentive" => Incentive::convertToKhmerNumber($row->total_incentive),
        //   "exchange_rate" => Incentive::convertToKhmerNumber($row->exchange_rate)
        // );
        $incentiveArr[] = array(
          "no" => $i,
          "entity" => $row->entity,
          "total_incentive" => $row->total_incentive,
          "total_incentive_after_tax" => $row->total_incentive_after_tax,
          "exchange_rate" => 4000
        );
        $i++;
      }
      return $incentiveArr;
    }
    
    public static function getIncentiveByEntities($incentive_id, $bank_id){
      if($bank_id > 0){
        $incentiveToEntities = DB::table("incentive_to_entity as i2e")
                              ->Select("b.name as bank_name", "e.name as label", "e.code as code", "e.id as id")
                              ->Join("incentive_to_officer as i2o", "i2o.entity_id", "=", "i2e.entity_id")
                              ->Join("entity as e", "e.id", "=", "i2e.entity_id")
                              ->Join("bank as b", "b.id", "=", "i2o.bank_id")
                              ->OrderBy('e.order_level')
                              ->Where('i2o.bank_id', '=', $bank_id)
                              ->Where('i2e.incentive_id', $incentive_id)
                              ->GroupBy('b.name', 'i2e.entity_id', 'e.name', 'e.code', 'e.id', 'i2o.entity_id')
                              ->get();
        // $incentiveToEntities = DB::table("incentive_to_officer as i2o")
        //                       ->Select("")
        //                       ->Join("incentive_to_entity as i2e", "i2e.entity_id", "=", "i2o.entity_id")
        //                       ->Join("entity as e", "e.id", "=", "i2o.entity_id")
        //                       ->OrderBy('e.order_level')
        //                       // ->Where('i2o.bank_id', '=', $bank_id)
        //                       ->Where('i2o.incentive_id', $incentive_id)
        //                       ->GroupBy('i2e.entity_id', 'e.id', 'i2o.entity_id')
        //                       ->get();
      }else{
        $incentiveToEntities = DB::table("incentive_to_entity as i2e")
                             ->Select("e.name as label", "e.code as code", "e.id as id")
                             ->Join("entity as e", "e.id", "=", "i2e.entity_id")
                             ->OrderBy('e.order_level')
                             ->Where('incentive_id', $incentive_id)
                             ->get();
      }
      $entityData = array();
      $i = 0;
      foreach($incentiveToEntities as $incentiveToEntity){
        $officerData = array();
        if($bank_id > 0){
          $officers = DB::table("incentive_to_officer as i2o")
                  ->Select('i2o.*', "io.identity_no", "io.first_name", "io.last_name", "io.latin", "io.title")
                  ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                  ->Join('duty as d', 'd.id', '=', 'io.duty_id')
                  ->Where('i2o.incentive_id', '=', $incentive_id)
                  ->Where('i2o.entity_id', "=" ,$incentiveToEntity->id)
                  ->Where('i2o.bank_id', $bank_id)
                  ->OrderBy("d.order_level")
                  ->OrderBy("io.first_name")
                  ->get();
        }else{

          $officers = DB::table("incentive_to_officer as i2o")
                    ->Select('i2o.*', "io.identity_no", "io.first_name", "io.last_name", "io.latin", "io.title")
                    ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                    ->Join('duty as d', 'd.id', '=', 'io.duty_id')
                    ->Where('i2o.incentive_id', '=', $incentive_id)
                    ->Where('i2o.entity_id', "=" ,$incentiveToEntity->id)
                    ->OrderBy("d.order_level")
                    ->OrderBy("io.first_name")
                    ->get();
        }

        if($bank_id > 0){
          $subIncentive = DB::table("incentive_to_officer as i2o")
                    ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                    ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                    ->Where('i2o.incentive_id', '=', $incentive_id)
                    ->Where('i2o.entity_id', "=" ,$incentiveToEntity->id)
                    ->Where('i2o.bank_id', $bank_id)
                    ->sum("i2o.incentive");

          $sumTaxIncentive = DB::table("incentive_to_officer as i2o")
                    ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                    ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                    ->Where('i2o.incentive_id', '=', $incentive_id)
                    ->Where('i2o.entity_id', "=" ,$incentiveToEntity->id)
                    ->Where('i2o.bank_id', $bank_id)
                    ->sum("i2o.tax");

          $sumReturnIncentive = DB::table("incentive_to_officer as i2o")
                    ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                    ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                    ->Where('i2o.incentive_id', '=', $incentive_id)
                    ->Where('i2o.entity_id', "=" ,$incentiveToEntity->id)
                    ->Where('i2o.bank_id', $bank_id)
                    ->sum("i2o.return_amount");

          $sumIncentiveAterTax = DB::table("incentive_to_officer as i2o")
                    ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                    ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                    ->Where('i2o.incentive_id', '=', $incentive_id)
                    ->Where('i2o.entity_id', "=" ,$incentiveToEntity->id)
                    ->Where('i2o.bank_id', $bank_id)
                    ->sum("i2o.incentive_after_tax");

          $sumIncentiveReminder = DB::table("incentive_to_officer as i2o")
                    ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                    ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                    ->Where('i2o.incentive_id', '=', $incentive_id)
                    ->Where('i2o.entity_id', "=" ,$incentiveToEntity->id)
                    ->Where('i2o.bank_id', $bank_id)
                    ->sum("i2o.reminder_amount");
        }else{
          $subIncentive = DB::table("incentive_to_officer as i2o")
                    ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                    ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                    ->Where('i2o.incentive_id', '=', $incentive_id)
                    ->Where('i2o.entity_id', "=" ,$incentiveToEntity->id)
                    ->sum("i2o.incentive");

          $sumTaxIncentive = DB::table("incentive_to_officer as i2o")
                    ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                    ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                    ->Where('i2o.incentive_id', '=', $incentive_id)
                    ->Where('i2o.entity_id', "=" ,$incentiveToEntity->id)
                    ->sum("i2o.tax");

          $sumReturnIncentive = DB::table("incentive_to_officer as i2o")
                    ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                    ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                    ->Where('i2o.incentive_id', '=', $incentive_id)
                    ->Where('i2o.entity_id', "=" ,$incentiveToEntity->id)
                    ->sum("i2o.return_amount");

          $sumIncentiveAterTax = DB::table("incentive_to_officer as i2o")
                    ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                    ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                    ->Where('i2o.incentive_id', '=', $incentive_id)
                    ->Where('i2o.entity_id', "=" ,$incentiveToEntity->id)
                    ->sum("i2o.incentive_after_tax");

          $sumIncentiveReminder = DB::table("incentive_to_officer as i2o")
                    ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                    ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                    ->Where('i2o.incentive_id', '=', $incentive_id)
                    ->Where('i2o.entity_id', "=" ,$incentiveToEntity->id)
                    ->sum("i2o.reminder_amount");
        }

        $j = 0;
        foreach($officers as $officer){
          // $j++;
          // $officerData[] = array(
          //   "no" => Incentive::convertToKhmerNumber($j),
          //   "first_name" => $officer->first_name,
          //   "last_name" => $officer->last_name,
          //   "bank" => $officer->bank,
          //   "bank_account_no" => $officer->bank_account_no,
          //   "latin" => $officer->latin,
          //   "position" => $officer->position,
          //   "duty" => $officer->duty,
          //   "incentive_after_tax" => Incentive::convertToKhmerNumber($officer->incentive_after_tax)
          // );
          if($bank_id > 0){
            $bank = $incentiveToEntity->bank_name;
          }else{
            $bank = $officer->bank;
          }
          $bankAccOfficer = '';
          if($officer->bank_account_no != null){
              $bankAccOfficer = $officer->bank_account_no;
          }else{
              $bankAccOfficer = $officer->bank_account_no;
          }
          $officerData[] = array(
            "no" => ($j + 1),
            "identity_no" => $officer->identity_no,
            "first_name" => $officer->first_name,
            "last_name" => $officer->last_name,
            "title" => $officer->title,
            "bank" => $officer->bank,
            "bank_account_no" => $bankAccOfficer,
            "latin" => $officer->latin,
            "position" => $officer->position,
            "duty" => $officer->duty,
            "index" => $officer->index,
            "incentive" => floatval($officer->incentive),
            "total_incentive_with_reminder" => (floatval($officer->incentive) + floatval($officer->reminder_amount)),
            "tax" => floatval($officer->tax),
            "return_amount" => floatval($officer->return_amount),
            "reminder_amount" => floatval($officer->reminder_amount),
            "incentive_after_tax" => floatval($officer->incentive_after_tax)
          );
          $j++;
        }
        
        if($subIncentive > 0){
          // $entityData[] = array(
          //   "no" => Incentive::convertToKhmerNumber($i),
          //   "id" => $incentiveToEntity->id,
          //   "label" => $incentiveToEntity->label,
          //   "entity" => $incentiveToEntity->label,
          //   "total_incentive" => Incentive::convertToKhmerNumber($subIncentive),
          //   "total_officer" => Incentive::convertToKhmerNumber(count($officers)),
          //   "officers" => $officerData
          // );
          $entityData[] = array(
            "no" => ($i + 1),
            "id" => $incentiveToEntity->id,
            "label" => $incentiveToEntity->label,
            "entity" => $incentiveToEntity->label,
            "code" => $incentiveToEntity->code,
            "total_incentive" => $subIncentive,
            "total_incentive_with_reminder" => ($subIncentive + $sumIncentiveReminder),
            "total_tax" => $sumTaxIncentive,
            "total_return_amount" => $sumReturnIncentive,
            "total_incentive_after_tax" => $sumIncentiveAterTax,
            "total_reminder_amount" => $sumIncentiveReminder,
            "total_officer" => count($officers),
            "officers" => $officerData
          );
        }

        $i++;
      }
      return $entityData;
    }
    public static function getIncentiveListByEntities($incentive_id, $bank_id){
      
      $officers = DB::table("incentive_to_officer as i2o")
              ->Select('i2o.*', "io.identity_no", "io.first_name", "io.last_name", "io.latin", "io.title")
              ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
              ->Join('duty as d', 'd.id', '=', 'io.duty_id')
              ->Join('entity as e', 'e.id', '=', 'io.entity_id')
              ->Where('i2o.incentive_id', '=', $incentive_id)
              ->Where('i2o.bank_id', $bank_id)
              // ->OrderBy("d.order_level")
              ->OrderBy("i2o.entity_id")
              ->OrderBy("d.order_level")
              ->OrderBy("io.first_name")
              ->get();

      $subIncentive = DB::table("incentive_to_officer as i2o")
                ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                ->Where('i2o.incentive_id', '=', $incentive_id)
                ->Where('i2o.bank_id', $bank_id)
                ->sum("i2o.incentive");

      $sumTaxIncentive = DB::table("incentive_to_officer as i2o")
                ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                ->Where('i2o.incentive_id', '=', $incentive_id)
                ->Where('i2o.bank_id', $bank_id)
                ->sum("i2o.tax");

      $sumReturnIncentive = DB::table("incentive_to_officer as i2o")
                ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                ->Where('i2o.incentive_id', '=', $incentive_id)
                ->Where('i2o.bank_id', $bank_id)
                ->sum("i2o.return_amount");

      $sumIncentiveAterTax = DB::table("incentive_to_officer as i2o")
                ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                ->Where('i2o.incentive_id', '=', $incentive_id)
                ->Where('i2o.bank_id', $bank_id)
                ->sum("i2o.incentive_after_tax");

      $sumIncentiveReminder = DB::table("incentive_to_officer as i2o")
                ->Select('i2o.*', "io.first_name", "io.last_name", "io.latin")
                ->Join('incentive_officer as io', 'io.id', '=', 'i2o.officer_id')
                ->Where('i2o.incentive_id', '=', $incentive_id)
                ->Where('i2o.bank_id', $bank_id)
                ->sum("i2o.reminder_amount");
        
      $j = 0;
      foreach($officers as $officer){
        // $j++;
        // $officerData[] = array(
        //   "no" => Incentive::convertToKhmerNumber($j),
        //   "first_name" => $officer->first_name,
        //   "last_name" => $officer->last_name,
        //   "bank" => $officer->bank,
        //   "bank_account_no" => $officer->bank_account_no,
        //   "latin" => $officer->latin,
        //   "position" => $officer->position,
        //   "duty" => $officer->duty,
        //   "incentive_after_tax" => Incentive::convertToKhmerNumber($officer->incentive_after_tax)
        // );
        // if($bank_id > 0){
        //   $bank = $incentiveToEntity->bank_name;
        // }else{
        //   $bank = $officer->bank;
        // }
        $bankAccOfficer = '';
        if($officer->bank_account_no != null){
            $bankAccOfficer = $officer->bank_account_no;
        }else{
            $bankAccOfficer = $officer->bank_account_no;
        }
        $officerData[] = array(
          "no" => ($j + 1),
          "identity_no" => $officer->identity_no,
          "first_name" => $officer->first_name,
          "last_name" => $officer->last_name,
          "title" => $officer->title,
          "bank" => $officer->bank,
          "bank_account_no" => $officer->bank_account_no,
          "latin" => $officer->latin,
          "position" => $officer->position,
          "duty" => $officer->duty,
          "index" => $officer->index,
          "incentive" => intval($officer->incentive),
          "tax" => intval($officer->tax),
          "return_amount" => intval($officer->return_amount),
          "reminder_amount" => intval($officer->reminder_amount),
          "incentive_after_tax" => intval($officer->incentive_after_tax)
        );
        $j++;
      }

      return $officerData;
    }

    public static function getIncentiveByOfficers($incentive_id){
      $query = IncentiveOfficer::whereIn('entity', explode(',', $entity_id))->get();
      return $query;
    }

    public static function getIncentiveByStackholders($incentive_id){
      $query = IncentiveOfficer::whereIn('entity', explode(',', $entity_id))->get();
      return $query;
    }

    public static function getIncentiveData($id){
      // $table = Incentive::find($id);
      //   $getIncentiveByBanks = Incentive::getIncentiveByBanks($id);
      //   $getIncentiveByEntities = Incentive::getIncentiveByEntities($id, 0);
      //   // dd($this->num2khtext("1273800000", true));
      //   // dd($getIncentiveByEntities);
      //   $incentiveByBanks = array();
      //   foreach($getIncentiveByBanks as $getIncentiveByBank){
      //       $incentiveByBanks[] = array(
      //           "no" => CommonService::convertToKhmerNumber($getIncentiveByBank["no"]),
      //           "id" => $getIncentiveByBank["id"],
      //           "label" => $getIncentiveByBank["label"],
      //           "total_incentive" => CommonService::convertToKhmerNumber(number_format($getIncentiveByBank["total_incentive"]), 0),
      //           "total_incentive_in_word" => $this->num2khtext($getIncentiveByBank["total_incentive"], true),
      //           "exchange_rate" => CommonService::convertToKhmerNumber($getIncentiveByBank["exchange_rate"])
      //       );
      //   }

        return CommonService::convertToKhmerNumber(222);
    }
}
