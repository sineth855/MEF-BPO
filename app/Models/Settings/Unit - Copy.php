<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use CommonService;
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

  public static function getUnitOptions($filter){
    // $data = array();
    // // $query = Unit::orderBy($filter["sort"], $filter["order"]);
    // // $whereClause = $query;
    // // $whereClause->whereNotIn("status", [4])->orWhereNull("status");
    // // $whereClause->orderBy("order_level");
    // $whereClause = CommonService::queryTable(Unit::class, $filter, $flag = 2); // Flag == 2 mean not include search criteria in query check
    // $queryResult = collect($whereClause->get());
    // foreach($queryResult as $row){
    //   $data[] = array(
    //     "label" => (config_language=="en")?$row->name_en:$row->name_kh,
    //     "value" => $row->id,
    //   );
    // }
    // return $data;
    return CommonService::optVals(Unit::class, $filter, $flag = 2);
  }

  public static function getUnits($filter){
    $data = array();
    $whereClause = CommonService::queryTable(Unit::class, $filter, $flag = 1); // Flag == 1 mean if query result limit by qty
    // $query = Unit::orderBy($filter["sort"], $filter["order"]);
    // $whereClause = $query;
    // $whereClause->whereNotIn("status", [4])->orWhereNull("status");
    // $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);       
    // $whereClause->limit($filter["limit"]);

    // Loop dynamic field search data
    // if($filter["search_field"]){
    //   $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
    //   $dataFields = $arraySingle;
    //   foreach($dataFields as $key => $field){
    //     if (array_key_exists($key, $dataFields)) {
    //       $whereClause->Where($key, $dataFields[$key]);
    //     }
    //   }
    // }

    // if (array_key_exists("name_kh", $dataFields)) {
    //   $whereClause->Where("name_kh", $dataFields["name_kh"]);
    // }
    // if (array_key_exists("name_en", $dataFields)) {
    //   $whereClause->Where("name_en", $dataFields["name_en"]);
    // }

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
    // $query = Unit::orderBy($filter["sort"], $filter["order"]);
    // $whereClause = $query;
    // $whereClause->whereNotIn("status", [4])->orWhereNull("status");
    // if($filter["search_field"]){
    //   $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
    //   $dataFields = $arraySingle;
    //   if (array_key_exists("name_kh", $dataFields)) {
    //     $whereClause->Where("name_kh", $dataFields["name_kh"]);
    //   }
    //   if (array_key_exists("name_en", $dataFields)) {
    //     $whereClause->Where("name_en", $dataFields["name_en"]);
    //   }
    // }
    $whereClause = CommonService::queryTable(Unit::class, $filter, $flag = 1); // Flag == 1 mean if query result limit by qty
    $total = collect($whereClause->count());
    return $total;
  }

}
