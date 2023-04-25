<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\ProgramManagement\ClusterActivity;
use App\Models\Settings\Entity;
use App\Models\Settings\EntityMember;


class Activity extends Model
{
    protected $table = 'mef_activity';
    protected $fillable = [
                            'code',
                            'cluster_activity_id',
                            'entity_id',
                            'entity_member_id',
                            'name_en',
                            'name_kh',
                            'remark',
                            'is_active',
                            'order_level',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;

    public function ClusterActivity(){
      return $this->belongsTo(Program::class,'cluster_activity_id');
    }
    public function Entity(){
      return $this->belongsTo(Entity::class,'entity_id');
    }
    public function EntityMember(){
      return $this->belongsTo(EntityMember::class,'entity_member_id');
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
        $whereClauseAct->where("cluster_activity_id", $parentId);

        if($filter["search_field"]){
          $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
          $dataFields = $arraySingle;
          if (array_key_exists('code', $dataFields)) {
            $whereClauseAct->Where("id", $dataFields["code"]);
          }
          if (array_key_exists('entity_id', $dataFields)) {
            $whereClauseAct->Where("id", $dataFields["entity_id"]["value"]);
          }
          if (array_key_exists('name_en', $dataFields)) {
            $whereClauseAct->Where("name_en", "Like", "%".$dataFields["name_en"]."%");
          }
          if (array_key_exists('name_kh', $dataFields)) {
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

            $cdata[] = array(
              'id' => $crow->id,
              'code' => $crow->code,
              'cluster_activity_id' => $crow->cluster_activity_id,
              'name_en' => $crow->name_en,
              'name_kh' => $crow->name_kh,
              'entity' => $crow->Entity?$crow->Entity->name_kh:'',
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
            'field' => 'cluster_activity_id',
            // 'remark' => $row->remark,
            // 'order_level' => $row->order_level,
            'children' => $cdata
          );
        }
      }
      // dd($data);
      return $data;
    }
}
