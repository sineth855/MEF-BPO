<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\ProgramManagement\Program;
use App\Models\Settings\Entity;
use App\Models\Settings\EntityMember;

class SubProgram extends Model
{
    protected $table = 'mef_subprogram';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'code',
                            'sub_code',
                            'program_id',
                            'entity_id',
                            'entity_member_id',
                            'structure_name_en',
                            'structure_name_kh',
                            'name_en',
                            'name_kh',
                            'remark',
                            'administrative_class',
                            'order_level',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;
    
    public function Program(){
      return $this->belongsTo(Program::class,'objective_id');
    }
    public function Entity(){
      return $this->belongsTo(Entity::class,'entity_id');
    }
    public function EntityMember(){
      return $this->belongsTo(EntityMember::class,'entity_member_id');
    }

    public static function getSubPrograms(){
      $query = SubProgram::orderBy("order_level")->get();
      $data = array();
      foreach($query as $row){
        $data[] = array(
          "label" => $row->name_kh,
          "value" => $row->id,
        );
      }
      return $data;
    }

    public static function getSubProgramByProgram($filter){
      $data = array();
      $query = Program::orderBy("order_level")->get();
      foreach($query as $row){
        $parentId = $row->id;
        $cdata = array(); //cdata = children data
        $querySubPrograms = SubProgram::where("program_id", $parentId)->orderBy("order_level")->get();
        foreach($querySubPrograms as $crow){
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
          'field' => 'program_id',
          // 'remark' => $row->remark,
          // 'order_level' => $row->order_level,
          'children' => $cdata
        );
      }
      return $data;
    }
}
