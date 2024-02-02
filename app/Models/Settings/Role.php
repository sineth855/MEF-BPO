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
                            'is_delete',
                            'created_by',
                            'updated_by'
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
          "entity_id" => $row->entity_id,
          "entity" => $row->Entity->code.'-'.$row->Entity->name_kh,
          "name" => $row->name,
          "remark" => $row->remark,
          "order_level" => $row->order_level,
          "created_by" => $row->created_by,
          "updated_by" => $row->updated_by,
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
