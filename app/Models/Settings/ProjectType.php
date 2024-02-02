<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    protected $table = 'mef_project_type';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            "name_en",
                            "name_kh",
                            'order_level',
                            'is_active'
                          ];
    public $timestamps = true;

    public static function getProjectTypes(){
      $query = ProjectType::orderBy("order_level")->get();
      $data = array();
      foreach($query as $row){
        $data[] = array(
          "label" => $row->name_kh,
          "value" => $row->id,
        );
      }
      return $data;
    }
}