<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            "name_en",
                            "name_kh",
                            "order_level",
                            "status",
                            "created_by",
                            "modified_by"
                          ];
    protected $guarded = array(
      'api'
    );
    public $timestamps = false;

    public static function getDepartments($filter){
      $data = array();
      $query = Department::orderBy($filter["sort"], $filter["order"]);
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
      $query = Department::orderBy($filter["sort"], $filter["order"]);
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
