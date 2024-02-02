<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'position';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            "name_en",
                            "name_kh",
                            'modified_by'
                          ];
    public $timestamps = true;

    public static function gePositionValues(){
    $data = array();
    $query = Position::where("is_active", 1);
    $whereClause = $query;
    $whereClause->orderBy("order_level");
    $queryResult = collect($whereClause->get());
    foreach($queryResult as $row){
      $data[] = array(
        "label" => $row->name_kh,
        "value" => $row->id,
      );
    }
    
    return $data;
  }

}
