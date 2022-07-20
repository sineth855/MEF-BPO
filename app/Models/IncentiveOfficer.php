<?php

namespace App\Models;
use App\Models\CompositionRequest;
use App\Models\IncentiveOfficer;
use Illuminate\Database\Eloquent\Model;
use DB;
class IncentiveOfficer extends Model
{
    protected $table = 'incentive_officer';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'user_id',
                            'identity_no',
                            'title',
                            'first_name',
                            'last_name',
                            'latin',
                            'duty',
                            'duty_id',
                            'entity',
                            'entity_id',
                            'department',
                            'position',
                            'gender',
                            'address',
                            'email',
                            'bank_account_no',
                            'bank_id',
                            'bank_name',
                            'bank_code',
                            'telephone_1',
                            'telephone_2',
                            'updated_bank_acc',
                            'status',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;
    
    public static function getOfficerListByEntities($entity_id){
      $entityId = explode(",", $entity_id);
      $query = DB::table("incentive_officer as io")
                ->Select("io.*", "d.incentive")
                ->WhereIn("io.entity_id", $entityId)
                // ->Where('io.status', 1)
                ->Join("duty as d", "d.id" , "=", "io.duty_id")
                ->get();
      return $query;
    }

    public static function getOfficerByEntities($entity_id){
      $entityId = explode(",", $entity_id);
      $query = DB::table("incentive_officer as io")
                ->Select("io.*", "d.incentive")
                ->WhereIn("io.entity_id", $entityId)
                ->Where('io.status', 1)
                ->Join("duty as d", "d.id" , "=", "io.duty_id")
                ->get();
      return $query;
    }

    public static function activeOfficerInPeriod(){
      $currentDate = strtotime(date("Y-m-d"));
      $query = CompositionRequest::where("effective_date", '>' ,date("Y-m-d"))->get();
      if($query){
        foreach($query as $row){
          $icos = DB::table("incentive_composition_officer")->where("incentive_composition_request_id", $row->id)->get();
          foreach($icos as $ico){
            IncentiveOfficer::where("id", $ico->from_officer_id)->update(["status" => 0]);
            IncentiveOfficer::where("id", $ico->to_officer_id)->update(["status" => 1]);
          }
        }
      }
      return true;
    }

    public static function getOfficerGroupByEntities($entity_id){
      $entityId = explode(",", $entity_id);
      $query = DB::table("entity as e")
                ->Select("e.*")
                ->WhereIn("e.id", $entityId)
                ->get();
      $data = array();
      foreach($query as $row){
        $id = $row->id;
        $incentiveOfficers = DB::table("incentive_officer as io")
                  ->Select("io.*", "d.incentive")
                  ->where("io.entity_id", $id)
                  ->Where('io.status', 1)
                  ->Join("duty as d", "d.id" , "=", "io.duty_id")
                  ->OrderBy('d.order_level')
                  ->get();
        $officers = array();
        $i = 1;
        foreach($incentiveOfficers as $incentiveOfficer){
          $incentiveAmount = 0;
          if($incentiveOfficer->bank_account_no != null || $incentiveOfficer->updated_bank_acc != null){
            $incentiveAmount = $incentiveOfficer->incentive;
          }
          $officers[] = array(
            "no" => $i,
            "id" => $incentiveOfficer->id,
            "user_id" => $incentiveOfficer->user_id,
            "first_name" => $incentiveOfficer->first_name,
            "last_name" => $incentiveOfficer->last_name,
            "duty" => $incentiveOfficer->duty,
            "bank_id" => $incentiveOfficer->bank_id,
            "bank_name" => $incentiveOfficer->bank_name,
            "bank_code" => $incentiveOfficer->bank_code,
            "entity" => $incentiveOfficer->entity,
            "entity_id" => $incentiveOfficer->entity_id,
            "position" => $incentiveOfficer->position,
            "duty" => $incentiveOfficer->duty,
            "bank_account_no" => $incentiveOfficer->bank_account_no,
            "updated_bank_acc" => $incentiveOfficer->updated_bank_acc,
            "incentive" => $incentiveAmount
          );
          $i++;
        }
        $data[] = array(
          "entity" => $row->name,
          "officers" => $officers
        );

      }
      return $data;
    }

    public static function getUserInfo($officer_id){
      $query = DB::table("incentive_officer as io")
                ->Select("u.*")
                ->Where('io.id', $officer_id)
                ->Join("users as u", "u.id" , "=", "io.user_id")
                ->first();
      return $query;
    }

    public static function getIncetiveByOfficer($officer_id){
      $query = DB::table("incentive_to_officer")
                ->Where('officer_id', $officer_id)
                ->get();
      return $query;
    }

    public static function getCompositionHistory($officer_id){
      $query = DB::table("incentive_composition_officer as ico")
                ->Select("io1.first_name as from_first_name", "io1.last_name as from_last_name", "io1.bank_account_no as from_bank_account_no", "io1.updated_bank_acc as from_updated_bank_acc", "io2.first_name as to_first_name", "io2.first_name as to_last_name", "io2.bank_account_no as to_bank_account_no", "io2.updated_bank_acc as to_updated_bank_acc")
                ->Join('incentive_officer as io1', 'io1.id', '=', 'ico.from_officer_id')
                ->Join('incentive_officer as io2', 'io2.id', '=', 'ico.to_officer_id')
                ->Where('ico.from_officer_id', $officer_id)
                ->get();
      if($query){
        return $query;
      }else{
        return null;
      }
    }
}
