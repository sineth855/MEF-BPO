<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    protected $table = 'mef_planning';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            "name_en",
                            "name_kh",
                            "year",
                            "start_date",
                            "end_date",
                            "is_default",
                            "created_by",
                            "modified_by"
                          ];
    public $timestamps = true;


    public static function getPlannings($filter){
      $data = array();
      $query = Planning::orderBy($filter["sort"], $filter["order"]);
      $whereClause = $query;
      $whereClause->whereNotIn("status", [4])->orWhereNull("status");
      $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);       
      $whereClause->limit($filter["limit"]);
  
      if($filter["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists("year", $dataFields)) {
          $whereClause->Where("year", $dataFields["year"]);
        }
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
          "year" => $row->year,
          "start_date" => $row->start_date,
          "end_date" => $row->end_date,
          "is_default" => $row->is_default
        );
      }
      return $data;
    }
  
    public static function getCount($filter){
      $query = Planning::orderBy($filter["sort"], $filter["order"]);
      $whereClause = $query;
      // $whereClause->where("is_active", 1);
      if($filter["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists("year", $dataFields)) {
          $whereClause->Where("year", $dataFields["year"]);
        }
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
