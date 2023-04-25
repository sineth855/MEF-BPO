<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\ProgramManagement\SubProgram;
use App\Models\Settings\Entity;
use App\Models\Settings\EntityMember;

class ClusterActivity extends Model
{
    protected $table = 'mef_cluster_activity';
    protected $fillable = [
                            'code',
                            'sub_code',
                            'sub_program_id',
                            'entity_id',
                            'entity_member_id',
                            'name_en',
                            'name_kh',
                            'remark',
                            'order_level',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;
    
    public function SubProgram(){
      return $this->belongsTo(SubProgram::class,'sub_program_id');
    }
    public function Entity(){
      return $this->belongsTo(Entity::class,'entity_id');
    }
    public function EntityMember(){
      return $this->belongsTo(EntityMember::class,'entity_member_id');
    }

    public static function getClusterActBySProgram($filter){
      $data = array();
      $queryObj = SubProgram::orderBy($filter["sort"], $filter["order"]);
      $whereClause = $queryObj;
      $whereClause->where("is_active", 1);
      $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);       
      $whereClause->limit($filter["limit"]);

      if($filter["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists('sub_program_id', $dataFields)) {
          $whereClause->Where("id", $dataFields["sub_program_id"]["value"]);
        }
        if (array_key_exists('entity_id', $dataFields)) {
          $whereClause->Where("id", $dataFields["entity_id"]["value"]);
        }
      }
      $query = collect($whereClause->get());

      foreach($query as $row){
        $parentId = $row->id;
        $cdata = array();
        // $result = ClusterActivity::where("sub_program_id", $parentId)->orderBy("order_level")->get();

        $queryClusAct = ClusterActivity::orderBy("order_level");
        $whereClauseClusAct = $queryClusAct;
        $whereClauseClusAct->where("sub_program_id", $parentId);

        if($filter["search_field"]){
          $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
          $dataFields = $arraySingle;
          if (array_key_exists('code', $dataFields)) {
            $whereClauseClusAct->Where("id", $dataFields["code"]);
          }
          if (array_key_exists('entity_id', $dataFields)) {
            $whereClauseClusAct->Where("id", $dataFields["entity_id"]["value"]);
          }
          if (array_key_exists('name_en', $dataFields)) {
            $whereClauseClusAct->Where("name_en", "Like", "%".$dataFields["name_en"]."%");
          }
          if (array_key_exists('name_kh', $dataFields)) {
            $whereClauseClusAct->Where("name_kh", "Like", "%".$dataFields["name_kh"]."%");
          }
        }
        
        $queryClusActProgs = collect($whereClauseClusAct->get());
        foreach($queryClusActProgs as $crow){
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

          $cdata[] = array(
            'id' => $crow->id,
            'code' => $crow->code,
            'program_id' => $crow->program_id,
            'name_en' => $crow->name_en,
            'name_kh' => $crow->name_kh,
            'entity' => $crow->Entity->name_kh,
            'entity_id' => $crow->entity_id,
            'entity_member' => 'អ្នកទទួលបន្ទុក',//$crow->EntityMember->fullname,
            'entity_member_id' => $crow->entity_member_id,
            // 'remark' => $crow->remark,
            'order_level' => $crow->order_level,
          'indicator' => $indicatorData,
          );
        }
        
        $data[] = array(
          'id' => $row->id,
          'code' => $row->code,
          'name_en' => $row->name_en,
          'name_kh' => $row->name_kh,
          'field' => 'program_id',
          // 'remark' => $row->remark,
          // 'order_level' => $row->order_level,
          'children' => $cdata
        );
      }
      return $data;
    }

    public static function getClusterActs(){
      $query = ClusterActivity::where("is_active", 1)->orderBy("order_level")->get();
      $data = array();
      foreach($query as $row){
        $data[] = array(
          "label" => $row->code.'-'.$row->name_kh,
          "value" => $row->id,
        );
      }
      return $data;
    }

    public static function getCount($filter){
      $query = ClusterActivity::orderBy($filter["sort"], $filter["order"]);
      $whereClause = $query;
      $whereClause->where("is_active", 1);
      if($filter["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists('cluster_activity_id', $dataFields)) {
          $whereClause->Where("id", $dataFields["cluster_activity_id"]["value"]);
        }
      }

      $total = collect($whereClause->count());
      return $total;
    }
}
