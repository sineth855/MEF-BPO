<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\ProgramManagement\Objective;
use App\Models\Modules\ProgramManagement\SubProgram;
use App\Models\Settings\Entity;
use App\Models\Settings\EntityMember;

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
                          'is_active',
                          'created_by',
                          'modified_by'
                        ];
  public $timestamps = true;

  public function Objective(){
    return $this->belongsTo(Objective::class,'objective_id');
  }

  public function Entity(){
    return $this->belongsTo(Entity::class,'entity_id');
  }

  public function EntityMember(){
    return $this->belongsTo(EntityMember::class,'entity_member_id');
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

  public static function getProgramByObj($filter){
    $data = array();
    $queryObj = Objective::orderBy($filter["sort"], $filter["order"]);
    $whereClause = $queryObj;
    $whereClause->where("is_active", 1);
    $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);       
    $whereClause->limit($filter["limit"]);

    if($filter["search_field"]){
      $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
      $dataFields = $arraySingle;
      if (array_key_exists('objective_id', $dataFields)) {
        $whereClause->Where("id", $dataFields["objective_id"]["value"]);
      }
      if (array_key_exists('entity_id', $dataFields)) {
        $whereClause->Where("id", $dataFields["entity_id"]["value"]);
      }
    }
    $query = collect($whereClause->get());
    
    foreach($query as $row){
      $objId = $row->id;
      $cdata = array();
      $queryPrograms = Program::orderBy("order_level");
      $whereClausePro = $queryPrograms;
      $whereClausePro->where("objective_id", $objId);

      if($filter["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists('code', $dataFields)) {
          $whereClausePro->Where("id", $dataFields["code"]);
        }
        if (array_key_exists('entity_id', $dataFields)) {
          $whereClausePro->Where("id", $dataFields["entity_id"]["value"]);
        }
        if (array_key_exists('name_en', $dataFields)) {
          $whereClausePro->Where("name_en", "Like", "%".$dataFields["name_en"]."%");
        }
        if (array_key_exists('name_kh', $dataFields)) {
          $whereClausePro->Where("name_kh", "Like", "%".$dataFields["name_kh"]."%");
        }
      }

      $queryProgs = collect($whereClausePro->get());
      foreach($queryProgs as $crow){
        $cdata[] = array(
          'id' => $crow->id,
          'code' => $crow->code,
          'objective_id' => $crow->objective_id,
          'name_en' => $crow->name_en,
          'name_kh' => $crow->name_kh,
          'entity' => isset($crow->Entity)?$crow->Entity->name_kh:"",
          'entity_id' => $crow->entity_id,
          'entity_member_id' => $crow->entity_member_id,
          'entity_member' => isset($crow->EntityMember)?$crow->EntityMember->name_kh:"",
          'remark' => $crow->remark,
          'order_level' => $crow->order_level,
        );
      }
      $data[] = array(
        'id' => $row->id,
        'code' => $row->code,
        'name_en' => $row->name_en,
        'name_kh' => $row->name_kh,
        'field' => 'objective_id',
        // 'remark' => $row->remark,
        // 'order_level' => $row->order_level,
        'children' => $cdata
      );
    }
    return $data;
  }

  public static function getPrograms(){
    $query = Program::where("is_active", 1)->orderBy("order_level")->get();
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
    $query = Program::orderBy($filter["sort"], $filter["order"]);
    $whereClause = $query;
    $whereClause->where("is_active", 1);
    if($filter["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists('program_id', $dataFields)) {
          $whereClause->Where("id", $dataFields["program_id"]["value"]);
        }
      }
    $total = collect($whereClause->count());
    return $total;
  }

}
