<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Entity extends Model
{
    protected $table = 'entity';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            "code",
                            "department_id",
                            "name_en",
                            "name_kh",
                            "color",
                            "limit_member",
                            "order_level",
                            "abbreviation",
                            "deputy_commissionerofficer",
                            "professional_offier",
                            "is_active",
                            "created_by",
                            "modified_by",
                          ];
    
 
    public function Department(){
      return $this->belongsTo('App\Models\Department','department_id');
    }

    public $timestamps = true;

    public static function getEntityOpts(){
      $data = array();
      $query = Entity::where("is_active", 1);
      $whereClause = $query;
      $whereClause->orderBy("order_level");
      if(Auth::user()->entity_id !=0 || Auth::user()->entity_id !=null){
        $whereClause->where("id", Auth::user()->entity_id);
      }
      $queryResult = collect($whereClause->get());
      foreach($queryResult as $row){
        $data[] = array(
          "label" => $row->code.'-'.$row->name_kh,
          "value" => $row->id,
        );
      }
      
      return $data;
    }

    public static function getEntities($filter){
      $data = array();
      $query = Entity::orderBy($filter["sort"], $filter["order"]);
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
          "code" => $row->code,
          "department_id" => $row->department_id,
          "name_en" => $row->name_en,
          "name_kh" => $row->name_kh,
          "color" => $row->color,
          "limit_member" => $row->limit_member,
          "order_level" => $row->order_level,
          "abbreviation" => $row->abbreviation,
          "deputy_commissionerofficer" => $row->deputy_commissionerofficer,
          "professional_offier" => $row->professional_offier,
          "is_active" => $row->is_active,
          "created_by" => $row->created_by,
          "modified_by" => $row->modified_by,
        );
      }
      return $data;
    }
  
    public static function getCount($filter){
      $query = Entity::orderBy($filter["sort"], $filter["order"]);
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

    public static function getEntityByActivity($param){
      $query = DB::table("mef_activity as a")
                ->select("e.id", "e.code", "e.name_en", "e.name_kh")
                ->join("entity as e", "e.id", "=", "a.entity_id")
                ->where("a.id", $param["param"]["value"])
                ->orderBy("a.code")
                ->get();
      $data = array();
      foreach($query as $row){
        $data[] = array(
          "label" => $row->code.'-'.$row->name_kh,
          "value" => $row->id,
        );
      }
      return $data;
    }
}
