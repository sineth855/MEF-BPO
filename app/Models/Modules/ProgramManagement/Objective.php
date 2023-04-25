<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\ProgramManagement\Program;

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

  public static function getCountObjective($filter){
    $queryObj = Objective::orderBy($filter["sort"], $filter["order"]);
    $whereClause = $queryObj;
    $whereClause->where("is_active", 1);
    $total = collect($whereClause->count());
    return $total;
  }
}
