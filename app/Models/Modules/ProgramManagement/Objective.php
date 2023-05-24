<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\ProgramManagement\Program;
use DB;

class Objective extends Model
{
  protected $table = 'mef_objective';
  protected $primaryKey = 'id';
  protected $fillable = [
                          'id',
                          'code',
                          'sub_code',
                          'name_en',
                          'name_kh',
                          'remark',
                          'order_level'
                        ];
  public $timestamps = true;

  public static function getObjectives(){
    $query = Objective::where("is_active", 1)->orderBy("order_level")->get();
    $data = array();
    foreach($query as $row){
      $data[] = array(
        "label" => $row->name_kh,
        "value" => $row->id,
      );
    }
    return $data;
  }

  public static function getAllClusterPrograms(){
    $query = Objective::where("is_active", 1)->orderBy("order_level")->get();
    $data = array();
    foreach($query as $row){
      $proArr = array();
      // Program
      $queryPro = Program::where("is_active", 1)->where("objective_id", $row->id)->orderBy("order_level")->get();
      foreach($queryPro as $pro){
        $subProArr = array();
        $proIndArr = array();
        $queryProIndicator = DB::table("mef_kpi_program")
                                ->where("planning_id", PLANNING_YEAR)
                                ->where("program_id", $pro->id)
                                ->orderBy("order_level")
                                ->get();
        foreach($queryProIndicator as $proIndicator){
          $proIndArr[] = array(
            "id" => $proIndicator->id,
            "code" => $proIndicator->code,
            "indicator" => $proIndicator->kpi_name_kh
          );
        }

        $querySubPro = SubProgram::where("is_active", 1)->where("program_id", $pro->id)->orderBy("order_level")->get();
        foreach($querySubPro as $subPro){
          $cluActArr = array();
          $subProInd = array();
          $querySubProIndicator = DB::table("mef_kpi_subprogram")
                                      ->where("planning_id", PLANNING_YEAR)
                                      ->where("sub_program_id", $pro->id)
                                      ->orderBy("order_level")
                                      ->get();
          foreach($querySubProIndicator as $subProIndicator){
            $subProInd[] = array(
              "id" => $subProIndicator->id,
              "code" => $subProIndicator->code,
              "indicator" => $subProIndicator->kpi_name_kh
            );
          }
          $queryClusAct = ClusterActivity::where("is_active", 1)->where("sub_program_id", $subPro->id)->orderBy("order_level")->get();
          
          foreach($queryClusAct as $clusAct){
            $actArr = array();
            $clusActIndArr = array();
            $queryAct = Activity::where("is_active", 1)->where("cluster_activity_id", $clusAct->id)->orderBy("order_level")->get();
            
            $queryClusActIndicator = DB::table("mef_kpi_cluster_activity")
                                        ->where("cluster_activity_id", $pro->id)
                                        ->where("planning_id", PLANNING_YEAR)
                                        ->orderBy("order_level")
                                        ->get();
            foreach($queryClusActIndicator as $clusActIndicator){
              $clusActIndArr[] = array(
                "id" => $clusActIndicator->id,
                "code" => $clusActIndicator->code,
                "indicator" => $clusActIndicator->kpi_name_kh
              );
            }

            foreach($queryAct as $act){
              $actIndArr = array();
              $queryActIndicator = DB::table("mef_kpi_activity")
                                        ->where("activity_id", $act->id)
                                        ->where("planning_id", PLANNING_YEAR)
                                        ->orderBy("order_level")
                                        ->get();
                foreach($queryActIndicator as $actIndicator){
                  $actIndArr[] = array(
                    "id" => $actIndicator->id,
                    "code" => $actIndicator->code,
                    "indicator" => $actIndicator->kpi_name_kh
                  );
                }

              $actArr[] = array(
                "id" => $act->id,
                "name" => $act->code.": ".$act->name_kh,
                "indicator" => $actIndArr,
                "order_level" => $act->order_level,
              );
            }
            $cluActArr[] = array(
              "id" => $clusAct->id,
              "name" => $clusAct->code.": ".$clusAct->name_kh,
              "order_level" => $clusAct->order_level,
              "indicator" => $clusActIndArr,
              "children"=> $actArr
            );
          }
          $subProArr[] = array(
            "id" => $subPro->id,
            "name" => $subPro->code."-".$subPro->structure_name_kh.":".$subPro->name_kh,
            "order_level" => $subPro->order_level,
            "indicator" => $subProInd,
            "children"=> $cluActArr
          );
        }
        $proArr[] = array(
          "id" => $pro->id,
          "name" => $pro->code.': '.$pro->name_kh,
          "order_level" => $pro->order_level,
          "indicator" => $proIndArr,
          "children"=> $subProArr
        );
      }

      $data[] = array(
        "id" => $row->id,
        "name" => $row->name_kh,
        "name_en" => $row->name_en,
        "name_kh" => $row->name_kh,
        "order_level" => $row->order_level,
        "hasColspan" => true,
        "colspan"=> 4,
        "indicator" => array(),
        "children" => $proArr
      );
    }
    return $data;
  }

  public static function getCount($filter){
    $queryObj = Objective::orderBy($filter["sort"], $filter["order"]);
    $whereClause = $queryObj;
    $whereClause->where("is_active", 1);
    $total = collect($whereClause->count());
    return $total;
  }
}
