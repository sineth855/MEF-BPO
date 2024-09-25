<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table = 'title';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            "name_en",
                            "name_kh",
                            "status",
                            "created_by",
                            "modified_by",
                          ];
    public $timestamps = true;

    public static function getTitleOpts(){
      $query = Title::orderBy("order_level")->whereNotIn("status", [4])->orWhereNull("status")->get();
      $data = array();
      foreach($query as $row){
        $data[] = array(
          "label" => $row->name_kh,
          "value" => $row->name_kh,
        );
      }
      return $data;
    }

    public static function getTitles($filter){
      $data = array();
      $query = Title::orderBy($filter["sort"], $filter["order"]);
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
          "status" => $row->status,
          "created_by" => $row->created_by,
          "modified_by" => $row->modified_by,
        );
      }
      return $data;
    }
  
    public static function getCount($filter){
      $query = Title::orderBy($filter["sort"], $filter["order"]);
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
