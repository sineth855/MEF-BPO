<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
  protected $auditStrict = true;
  protected  $primaryKey = 'id';
  
  protected $table = 'unit';
  protected $fillable = [
                          "name_en",
                          "name_kh",
                          "order_level",
                          "remark",
                          "status",
                          "created_by",
                          "modified_by"
                        ];
  public $timestamps = false;

  public static function getUnitOptions(){
    $data = array();
    $query = Unit::whereNotIn("status", [4])->orWhere("status", null);
    $whereClause = $query;
    $whereClause->whereNotIn("status", [4])->orWhere("status", null);
    $whereClause->orderBy("order_level");
    $queryResult = collect($whereClause->get());
    foreach($queryResult as $row){
      $data[] = array(
        "label" => (config_language=="en")?$row->name_en:$row->name_kh,
        "value" => $row->id,
      );
    }
    return $data;
  }

  public static function getUnits($filter){
    $data = array();
    $query = Unit::orderBy($filter["sort"], $filter["order"]);
    $whereClause = $query;
    $whereClause->whereNotIn("status", [4])->orWhereNull("status");
    $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);       
    $whereClause->limit($filter["limit"]);

    if($filter["search_field"]){
      $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
      $dataFields = $arraySingle;
      if (array_key_exists("name_kh", $dataFields)) {
        $whereClause->Where("name_kh", $dataFields["name_kh"]);
      }
      if (array_key_exists("name_en", $dataFields)) {
        $whereClause->Where("name_en", $dataFields["name_en"]);
      }
    }
    $results = collect($whereClause->get());
    foreach($results as $row){
      $data[] = array(
        "id" => $row->id,
        "name_en" => $row->name_en,
        "name_kh" => $row->name_kh,
        "order_level" => $row->order_level,
        "remark" => $row->remark,
        "status" => $row->status,
      );
    }
    return $data;
  }

  public static function getCount($filter){
    $query = Unit::orderBy($filter["sort"], $filter["order"]);
    $whereClause = $query;
    $whereClause->whereNotIn("status", [4])->orWhereNull("status");
    if($filter["search_field"]){
      $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
      $dataFields = $arraySingle;
      if (array_key_exists("name_kh", $dataFields)) {
        $whereClause->Where("name_kh", $dataFields["name_kh"]);
      }
      if (array_key_exists("name_en", $dataFields)) {
        $whereClause->Where("name_en", $dataFields["name_en"]);
      }
    }
    $total = collect($whereClause->count());
    return $total;
  }
}
