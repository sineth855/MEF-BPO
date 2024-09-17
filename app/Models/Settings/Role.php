<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\Entity;
use Auth;

class Role extends Model
{
    protected $table = 'role';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'entity_id',
                            'name',
                            'remark',
                            'order_level',
                            'is_active',
                            'status',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;

    public function Entity(){
      return $this->belongsTo(Entity::class,'entity_id');
    }

    public static function getRoleValues($filters){
      $data = array();
      $query = Role::orderBy($filters["sort"], $filters["order"]);
      $whereClause = $query;
      $whereClause->where("is_active",1);
      if(Auth::user()->entity_id !=0 || Auth::user()->entity_id !=null){
        $whereClause->where("entity_id", Auth::user()->entity_id);
      }
      $whereClause->offset(($filters["page_number"] - 1) * $filters["limit"]);       
      $whereClause->limit($filters["limit"]);
      if($filters["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filters["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists('entity_id', $dataFields)) {
          $whereClause->Where("entity_id", $dataFields["entity_id"]["value"]);
        }
        if (array_key_exists('name', $dataFields)) {
          $whereClause->Where("name", "Like", "%".$dataFields["name"]."%");
        }
      }
      $tableResult = collect($whereClause->get());
      foreach($tableResult as $row){
        $data[] = array(
          "label" => $row->name,
          "value" => $row->id,
        );
      }
      return $data;
    }

    public static function getRoles($filters){
      $data = array();
      $query = Role::orderBy($filters["sort"], $filters["order"]);
      $whereClause = $query;
      $whereClause->where("is_active",1);
      $whereClause->whereNotIn("status", [4])->orWhereNull("status");
      if(Auth::user()->entity_id !=0 || Auth::user()->entity_id !=null){
        $whereClause->where("entity_id", Auth::user()->entity_id);
      }
      $whereClause->offset(($filters["page_number"] - 1) * $filters["limit"]);       
      $whereClause->limit($filters["limit"]);
      if($filters["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filters["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists('entity_id', $dataFields)) {
          $whereClause->Where("entity_id", $dataFields["entity_id"]["value"]);
        }
        if (array_key_exists('name', $dataFields)) {
          $whereClause->Where("name", "Like", "%".$dataFields["name"]."%");
        }
      }
      $tableResult = collect($whereClause->get());
      foreach($tableResult as $row){
        $data[] = array(
          "id" => $row->id,
          "entity_id" => $row->Entity->code.'-'.(config_language=="en")?$row->Entity->name_en:$row->Entity->name_kh,
          "entity" => $row->Entity->code.'-'.(config_language=="en")?$row->Entity->name_en:$row->Entity->name_kh,
          "name" => $row->name,
          "remark" => $row->remark,
          "order_level" => $row->order_level,
          "created_by" => $row->created_by,
          "modified_by" => $row->modified_by,
        );
      }
      return $data;
    }

    public static function getCount($filters){
      $query = Role::orderBy($filters["sort"], $filters["order"]);
      $whereClause = $query;
      $whereClause->where("is_active",1);
      if(Auth::user()->entity_id !=0 || Auth::user()->entity_id !=null){
        $whereClause->where("entity_id", Auth::user()->entity_id);
      }
      if($filters["search_field"]){
          $arraySingle = call_user_func_array('array_merge', $filters["search_field"]);
          $dataFields = $arraySingle;
          if (array_key_exists('role_id', $dataFields)) {
            $whereClause->Where("id", $dataFields["role_id"]["value"]);
          }
          if (array_key_exists('entity_id', $dataFields)) {
            $whereClause->Where("entity_id", $dataFields["entity_id"]["value"]);
          }
          if (array_key_exists('name', $dataFields)) {
            $whereClause->Where("name", "Like", "%".$dataFields["name"]."%");
          }
        }
      $total = collect($whereClause->count());
      return $total;
    }
}
