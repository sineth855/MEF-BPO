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
      $query = ClusterActivity::orderBy("order_level")->get();
      foreach($query as $row){
        $parentId = $row->id;
        $cdata = array(); //cdata = children data
        $result = Activity::where("cluster_activity_id", $parentId)->orderBy("order_level")->get();
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
