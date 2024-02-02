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
                            'code',
                            'department_id',
                            "name_en",
                            "name_kh",
                            'color',
                            'limit_member',
                            "order_level",
                            'abbreviation',
                            'deputy_commissionerofficer',
                            'professional_offier',
                            'is_active',
                            'created_by',
                            'modified_by',
                          ];
    
 
    public function Department(){
      return $this->belongsTo('App\Models\Department','department_id');
    }

    public $timestamps = true;

    public static function getEntities(){
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

    public static function getEntityByActivity($param){
      // dd($param["param"]["value"]);
      $query = DB::table("mef_activity as a")
                ->select("e.id", "e.code", "e.name_en", "e.name_kh")
                ->join("entity as e", "e.id", "=", "a.entity_id")
                ->where("a.id", $param["param"]["value"])
                ->orderBy("a.code")
                ->get();
              // ->Activity::where("is_active", 1)->where("cluster_activity_id", $param["param"]["value"])->orderBy("order_level")->get();
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
