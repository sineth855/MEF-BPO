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
                            'modified_by'
                          ];
    public $timestamps = true;

    public static function getTitles(){
      $query = Title::orderBy("order_level")->get();
      $data = array();
      foreach($query as $row){
        $data[] = array(
          "label" => $row->name_kh,
          "value" => $row->name_kh,
        );
      }
      return $data;
    }
}
