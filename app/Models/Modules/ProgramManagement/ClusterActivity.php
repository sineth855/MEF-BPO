<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\ProgramManagement\SubProgram;

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

    public static function getClusterActBySProgram($filter){
      $data = array();
      $query = SubProgram::orderBy("order_level")->get();
      foreach($query as $row){
        $parentId = $row->id;
        $cdata = array(); //cdata = children data
        $result = ClusterActivity::where("sub_program_id", $parentId)->orderBy("order_level")->get();
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
            'program_id' => $crow->program_id,
            'name_en' => $crow->name_en,
            'name_kh' => $crow->name_kh,
            'entity_id' => $crow->entity_id,
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
}
