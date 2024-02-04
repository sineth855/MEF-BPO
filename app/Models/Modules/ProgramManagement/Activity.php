<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\ProgramManagement\ClusterActivity;
use App\Models\Settings\Entity;
use App\Models\Settings\EntityMember;
use DB;

class Activity extends Model
{
    protected $table = 'mef_activity';
    protected $fillable = [
                            'code',
                            'cluster_activity_id',
                            'entity_id',
                            'entity_member_id',
                            "name_en",
                            "name_kh",
                            'remark',
                            'is_active',
                            'order_level',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;

    public function ClusterActivity(){
      return $this->belongsTo(ClusterActivity::class,'cluster_activity_id');
    }
    public function Entity(){
      return $this->belongsTo(Entity::class,'entity_id');
    }
    public function EntityMember(){
      return $this->belongsTo(EntityMember::class,'entity_member_id');
    }

    public static function getActivities($param){
      $queryData = Activity::where("is_active", 1);
      $whereClause = $queryData;
      $whereClause->orderBy("order_level");
      if(!empty($param["param"]["value"])){
        $whereClause->where("cluster_activity_id", $param["param"]["value"]);
      }
      $query = collect($whereClause->get());
      $data = array();
      foreach($query as $row){
        $data[] = array(
          "label" => (config_language == "en")?$row->code.'-'.$row->name_en:$row->code.'-'.$row->name_kh,
          "value" => $row->id,
        );
      }
      return $data;
    }


    public static function getActByCluster($filter){
      $data = array();
      $queryObj = ClusterActivity::orderBy($filter["sort"], $filter["order"]);
      $whereClause = $queryObj;
      $whereClause->where("is_active", 1);
      $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);       
      $whereClause->limit($filter["limit"]);

      if($filter["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists('cluster_activity_id', $dataFields)) {
          $whereClause->Where("id", $dataFields["cluster_activity_id"]["value"]);
        }
        if (array_key_exists('entity_id', $dataFields)) {
          $whereClause->Where("id", $dataFields["entity_id"]["value"]);
        }
      }
      $query = collect($whereClause->get());

      foreach($query as $row){
        $parentId = $row->id;
        $cdata = array(); //cdata = children data
        $queryAct = Activity::orderBy("order_level");
        $whereClauseAct = $queryAct;
        $whereClauseAct->where("is_active", 1);
        $whereClauseAct->where("cluster_activity_id", $parentId);

        if($filter["search_field"]){
          $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
          $dataFields = $arraySingle;
          if (array_key_exists('code', $dataFields)) {
            $whereClauseAct->Where("code", $dataFields["code"]);
          }
          if (array_key_exists('activity_id', $dataFields)) {
            $whereClauseAct->Where("id", $dataFields["activity_id"]["value"]);
          }
          if (array_key_exists("name_en", $dataFields)) {
            $whereClauseAct->Where("name_en", "Like", "%".$dataFields["name_en"]."%");
          }
          if (array_key_exists("name_kh", $dataFields)) {
            $whereClauseAct->Where("name_kh", "Like", "%".$dataFields["name_kh"]."%");
          }
        }
        
        $result = collect($whereClauseAct->get());

        if(count($result) > 0){
          foreach($result as $crow){
            $indicators = array(
              "id" => "id",
              "code" => "code",
              "kpi_name_en" => "kpi_name_en",
              "kpi_name_kh" => "kpi_name_kh",
              "order_level" => "order_level",
              "status" => "status",
            );
            $indicatorData = array(
              "data" => $indicators
            );
            // Task
            $taskArr = array();
            $queryTask = DB::table("mef_task")
                                    ->where("activity_id", $crow->id)
                                    ->orderBy("order_level")
                                    ->whereNull("is_delete")
                                    ->orWhere("is_delete", 0)
                                    ->get();
            foreach($queryTask as $task){
              // Costing
              $costingArr = array();
              $queryCostings = DB::table("mef_costing_to_entity")
                                    ->where("task_id", $task->id)
                                    ->orderBy("order_level")
                                    ->where("is_delete", "!=", 1)
                                    // ->orWhere("is_delete", 0)
                                    // ->where("planning_id", config_planning_year)
                                    ->get();

              // Costing Detail
              foreach($queryCostings as $costing){
                $queryCostingDetails = DB::table("mef_costing_detail_to_entity")
                                    ->where("costing_id", $costing->id)
                                    ->orderBy("order_level")
                                    ->whereNull("is_delete")
                                    ->orWhere("is_delete", 0)
                                    ->get();

                $costingDetailArr = array();
                foreach($queryCostingDetails as $cdetail){
                  $costingDetailArr[] = array(
                    "id" => $cdetail->id,
                    'task_id' => array(
                      "label" => (config_language == "en")?$task->code.'-'.$task->name_en:$task->code.'-'.$task->name_kh,
                      "value" => $task->id
                    ),
                    "name" => (config_language == "en")?$cdetail->name_en:$cdetail->name_kh,
                    "code" => $cdetail->line_no,
                    "group_chapter" => "",//$cdetail->group_chapter,
                    "no" => "",//$cdetail->no,
                    "line" => "",//$cdetail->line,
                    "code_cluster_activity" => "", //$cdetail->code_cluster_activity,
                    "code_activity" => "", //$cdetail->code_activity,
                    "sub_account" => "", //$cdetail->sub_account,
                    "is_reg_exp" => "", //$cdetail->is_reg_exp,
                    "unit" => "", //$cdetail->unit,
                    "quantity" => "", //$cdetail->quantity,
                    "currency" => $cdetail->currency,
                    "unit_price" => $cdetail->unit_price,
                    "total_amount" => $cdetail->total_amount,
                    "time_year" => "", //$cdetail->time_year,
                    "annual_amount" => "", //$cdetail->annual_amount,
                    "month" => "", //$cdetail->month,
                    "expense_type" => "", //$cdetail->expense_type,
                    "remark" => $cdetail->remark
                  );
                }

                $costingArr[] = array(
                  "id" => $costing->id,
                  'cluster_activity_id' => array(
                    "label" => (config_language == "en")?$row->code.'-'.$row->name_en:$row->code.'-'.$row->name_kh,
                    "value" => $row->id
                  ),
                  'activity_id' => array(
                    "label" => (config_language == "en")?$crow->code.'-'.$crow->name_en:$crow->code.'-'.$crow->name_kh,
                    "value" => $crow->id
                  ),
                  'task_id' => array(
                    "label" => (config_language == "en")?$task->code.'-'.$task->name_en:$task->code.'-'.$task->name_kh,
                    "value" => $task->id
                  ),
                  "name" => (config_language == "en")?$costing->code.": ".$costing->name_en:$costing->code.": ".$costing->name_kh,
                  "name_kh" => $costing->name_kh,
                  "name_en" => $costing->name_en,
                  "children" => $costingDetailArr
                );
              }

              $taskArr[] = array(
                "id" => $task->id,
                "code" => $task->code,
                'cluster_activity_id' => array(
                    "label" => (config_language == "en")?$row->code.'-'.$row->name_en:$row->code.'-'.$row->name_kh,
                    "value" => $row->id
                  ),
                  'activity_id' => array(
                    "label" => (config_language == "en")?$crow->code.'-'.$crow->name_en:$crow->code.'-'.$crow->name_kh,
                    "value" => $crow->id
                  ),
                "name" => (config_language == "en")?$task->code.": ".$task->name_en:$task->code.": ".$task->name_kh,
                "order_level" => $task->order_level,
                "children" => $costingArr
              );
            }

            $cdata[] = array(
              'id' => $crow->id,
              'code' => $crow->code,
              'sub_program_id' => [],
              'cluster_activity_id' => array(
                "label" => (config_language == "en")?$row->code.'-'.$row->name_en:$row->code.'-'.$row->name_kh,
                "value" => $row->id
              ),
              'activity_id' => array(
                "label" => (config_language == "en")?$crow->code.'-'.$crow->name_en:$crow->code.'-'.$crow->name_kh,
                "value" => $crow->id
              ),
              "name" => (config_language == "en")?$crow->code."-".$crow->name_en:$crow->code."-".$crow->name_kh,
              "name_en" => $crow->name_en,
              "name_kh" => $crow->name_kh,
              'entity' => isset($crow->Entity)?$crow->Entity->name_kh:"",
              'entity_id' => array(
                "label" => isset($crow->Entity)?$crow->Entity->code."-".$crow->Entity->name_kh:"",
                "value" => isset($crow->Entity)?$crow->Entity->id:"",
              ),
              'entity_member' => isset($crow->EntityMember)?$crow->EntityMember->fullname:"",
              'entity_member_id' => array(
                "label" => isset($crow->EntityMember)?$crow->EntityMember->fullname:"",
                "value" => isset($crow->EntityMember)?$crow->EntityMember->id:"",
              ),
              // 'remark' => $crow->remark,
              'order_level' => $crow->order_level,
              'indicator' => $indicatorData,
              'children' => $taskArr
            );
          }
          
          $data[] = array(
            'id' => $row->id,
            'code' => $row->code,
            'group_chapter' => '',
            "name" => (config_language == "en")?$row->name_en:$row->name_kh,
            "name" => (config_language == "en")?$row->name_en:$row->name_kh,
            "name_en" => $row->name_en,
            "name_kh" => $row->name_kh,
            'cluster_activity_id' => array(
              "label" => $row->code.'-'.(config_language == "en")?$row->name_en:$row->name_kh,
              "value" => $row->id
            ),
            'field' => 'cluster_activity_id',
            'order_level' => $row->order_level,
            'children' => $cdata
          );
        }
      }
      return $data;
    }

    public static function getCount($filter){
      $query = Activity::orderBy($filter["sort"], $filter["order"]);
      $whereClause = $query;
      $whereClause->where("is_active", 1);
      if($filter["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists('activity_id', $dataFields)) {
          $whereClause->Where("id", $dataFields["activity_id"]["value"]);
        }
        if (array_key_exists('cluster_activity_id', $dataFields)) {
          $whereClause->Where("cluster_activity_id", $dataFields["cluster_activity_id"]["value"]);
        }
      }

      $total = collect($whereClause->count());
      return $total;
    }
}
