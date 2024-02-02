<?php

namespace App\Models\Settings;
use App\Models\Settings\AccountTypeGroup;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $table = 'account_type';
    protected  $primaryKey = 'id';
     protected $fillable = [
                            'account_type_group_id',
                            "name_en",
                            "name_kh",
                            'description',
                            'order_level',
                            'is_delete'
                          ];
    public $timestamps = true;

    public function AccountTypeGroup(){
      return $this->belongsTo(AccountTypeGroup::class,'account_type_group_id');
    }

    public static function getAccTypes(){
      $query = AccountType::orderBy("order_level")->get();
      $data = array();
      foreach($query as $row){
        $data[] = array(
          "label" => $row->name_kh,
          "value" => $row->id,
        );
      }
      return $data;
    }

    public static function getAccountTypes($filter){
      $data = array();
      $query = AccountType::orderBy($filter["sort"], $filter["order"]);
      $whereClause = $query;
      // $whereClause->where("is_active", 1);
      $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);       
      $whereClause->limit($filter["limit"]);

      if($filter["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists('account_type_group_id', $dataFields)) {
          $whereClause->Where("id", $dataFields["account_type_group_id"]["value"]);
        }
      }
      $results = collect($whereClause->get());
      foreach($results as $row){
        $data[] = array(
          'id' => $row->id,
          'account_type_group' => $row->AccountTypeGroup->name_kh,
          'account_type_group_id' => array(
            "label" => $row->AccountTypeGroup->name_kh,
            "value" => $row->AccountTypeGroup->id
          ),
          "name_en" => $row->name_en,
          "name_kh" => $row->name_kh,
          'description' => $row->description,
          'order_level'
        );
      }
      return $data;

    }

    public static function getCount($filter){
      $query = AccountType::orderBy($filter["sort"], $filter["order"]);
      $whereClause = $query;
      // $whereClause->where("is_active", 1);
      if($filter["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists('account_type_id', $dataFields)) {
          $whereClause->Where("id", $dataFields["account_type_id"]["value"]);
        }
      }
      $total = collect($whereClause->count());
      return $total;
    }
}
