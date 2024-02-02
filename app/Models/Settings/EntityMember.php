<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\Entity;
use Auth;

class EntityMember extends Model
{
  protected $table = 'entity_member';
  // protected  $primaryKey = 'id';
  protected $fillable = [
                          'user_id',
                          'photo',
                          'identity_no',
                          'title',
                          'fullname',
                          'first_name',
                          'last_name',
                          'latin',
                          'duty',
                          'duty_id',
                          "entity",
                          "entity_id",
                          'gender',
                          'address',
                          'email',
                          'position',
                          'department',
                          'telephone_1',
                          'telephone_2',
                          'order_level',
                          'created_by',
                          'modified_by',
                          'is_active'
                        ];
                        
  public $timestamps = true;

  public function Entity(){
    return $this->belongsTo(Entity::class,'entity_id');
  }
  
  public static function getMemberByEntity($filter){
    $data = array();
    $query = EntityMember::orderBy($filter["sort"], $filter["order"]);
    $whereClause = $query;
    $whereClause->orderBy("order_level")->get();
    $whereClause->where("is_active", 1);
    if(Auth::user()->entity_id !=0 || Auth::user()->entity_id !=null){
      $whereClause->where("entity_id", Auth::user()->entity_id);
    }
    $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);
    $whereClause->limit($filter["limit"]);
    
    if($filter["search_field"]){
      $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
      $dataFields = $arraySingle;
      if (array_key_exists('entity_id', $dataFields)) {
        $whereClause->Where("entity_id", 'Like', '%'.$dataFields["entity_id"]["value"].'%');
      }
      if (array_key_exists('fullname', $dataFields)) {
        $whereClause->Where("fullname", 'Like', '%'.$dataFields["fullname"].'%');
      }
      if (array_key_exists('latin', $dataFields)) {
        $whereClause->Where("latin", 'Like', '%'.$dataFields["latin"].'%');
      }
    }

    $queryResult = collect($whereClause->get());

    foreach($queryResult as $row){
      $data[] = array(
        'id' => $row->id,
        'entity' => $row->Entity->code.'-'.$row->Entity->name_kh,
        'entity_id' => $row->entity_id,
        'fullname' => $row->fullname,
        'is_active' => $row->is_active,
      );
    }
    return $data;
  }
  
  public static function getMembers(){
    $query = EntityMember::where("is_active", 1)->orderBy("order_level")->get();
    $data = array();
    foreach($query as $row){
      $data[] = array(
        "label" => $row->fullname,
        "value" => $row->id,
      );
    }
    return $data;
  }

  public static function getMemberByEntityID($param){
    $query = EntityMember::where("is_active", 1)->orderBy("order_level")->where("entity_id", $param["param"]["value"])->get();
    $data = array();
    foreach($query as $row){
      $data[] = array(
        "label" => $row->fullname,
        "value" => $row->id,
      );
    }
    return $data;
  }

  public static function getCount($filter){
    $query = EntityMember::orderBy($filter["sort"], $filter["order"]);
    $whereClause = $query;
    $whereClause->orderBy("order_level")->get();
    $whereClause->where("is_active", 1);
    if(Auth::user()->entity_id !=0 || Auth::user()->entity_id !=null){
      $whereClause->where("entity_id", Auth::user()->entity_id);
    }
    $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);       
    $whereClause->limit($filter["limit"]);
    
    if($filter["search_field"]){
      $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
      $dataFields = $arraySingle;
      if (array_key_exists('entity_id', $dataFields)) {
        $whereClause->Where("entity_id", 'Like', '%'.$dataFields["entity_id"]["value"].'%');
      }
      if (array_key_exists('fullname', $dataFields)) {
        $whereClause->Where("fullname", 'Like', '%'.$dataFields["fullname"].'%');
      }
      if (array_key_exists('latin', $dataFields)) {
        $whereClause->Where("latin", 'Like', '%'.$dataFields["latin"].'%');
      }
    }
    $total = collect($whereClause->count());
    return $total;
  }
}