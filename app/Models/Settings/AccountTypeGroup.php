<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class AccountTypeGroup extends Model
{
    protected $table = 'account_type_group';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            "name_en",
                            "name_kh",
                            'order_level',
                            'is_active',
                            'is_delete'
                          ];
    public $timestamps = false;

    public static function getAccountTypeGroups(){
      $query = AccountTypeGroup::orderBy("order_level")->get();
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
