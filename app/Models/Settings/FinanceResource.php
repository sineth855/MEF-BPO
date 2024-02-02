<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class FinanceResource extends Model
{
  protected $table = 'mef_finance_resource';
  protected  $primaryKey = 'id';
  protected $fillable = [
                          "name_en",
                          "name_kh",
                          'order_level',
                          'is_active'
                        ];
  public $timestamps = true;

  public static function getFinanceResource(){
    $query = FinanceResource::where("is_active", 1)->orderBy("order_level")->get();
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