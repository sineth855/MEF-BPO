<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\Entity;

class EntityMember extends Model
{
  protected $table = 'entity_member';
  protected  $primaryKey = 'id';
  protected $fillable = [
                          'user_id',
                          'photo',
                          'identity_no',
                          'title',
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
    $data = array(); //cdata = children data
    $query = EntityMember::orderBy("order_level")->get();

    $query = collect($whereClause->get());
    foreach($query as $row){
      $data[] = array(
        'id' => $row->id,
        'entity' => $row->Entity->name_kh,
        'entity_id' => $row->entity_id,
        'fullname' => $row->fullname,
        'order_level' => $row->order_level,
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
      $whereClause->where("is_active", 1);
      if($filter["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists('sub_program_id', $dataFields)) {
          $whereClause->Where("id", $dataFields["sub_program_id"]["value"]);
        }
      }
      $total = collect($whereClause->count());
      return $total;
    }
}
