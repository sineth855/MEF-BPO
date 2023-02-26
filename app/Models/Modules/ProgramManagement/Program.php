<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\ProgramManagement\SubProgram;

class Program extends Model
{
    protected $table = 'mef_program';
    protected $fillable = [
                            'code',
                            'sub_code',
                            'objective_id',
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

    public function Objective(){
      return $this->belongsTo(Objective::class,'objective_id');
    }

    public static function getSubProgramByProgram($filter){
      $data = array();
      $query = Program::orderBy("order_level")->get();
      foreach($query as $row){
        $parentId = $row->id;
        $cdata = array(); //cdata = children data
        $querySubPrograms = SubProgram::where("program_id", $parentId)->orderBy("order_level")->get();
        foreach($querySubPrograms as $crow){
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
          );
        }
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
        $data[] = array(
          'id' => $row->id,
          'code' => $row->code,
          'name_en' => $row->name_en,
          'name_kh' => $row->name_kh,
          'field' => 'program_id',
          'indicator' => $indicatorData,
          // 'remark' => $row->remark,
          // 'order_level' => $row->order_level,
          'children' => $cdata
        );
      }
      return $data;
    }
}
