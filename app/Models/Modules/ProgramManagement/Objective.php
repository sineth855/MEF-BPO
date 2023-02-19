<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\ProgramManagement\Program;

class Objective extends Model
{
    protected $table = 'mef_objective';
    protected $fillable = [
                            'code',
                            'name_en',
                            'name_kh',
                            'remark',
                            'order_level'
                          ];
    public $timestamps = true;

    public static function getProgramByObj($filter){
      $data = array();
      $query = Objective::orderBy("order_level")->get();
      foreach($query as $row){
        $objId = $row->id;
        $cdata = array(); //cdata = children data
        $queryPrograms = Program::where("objective_id", $objId)->orderBy("order_level")->get();
        foreach($queryPrograms as $crow){
          $cdata[] = array(
            'id' => $crow->id,
            'code' => $crow->code,
            'objective_id' => $crow->objective_id,
            'name_en' => $crow->name_en,
            'name_kh' => $crow->name_kh,
            'entity_id' => $crow->entity_id,
            'entity_member_id' => $crow->entity_member_id,
            // 'remark' => $crow->remark,
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
}
