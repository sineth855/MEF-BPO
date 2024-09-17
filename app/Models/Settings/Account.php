<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
  protected $table = 'account';
  protected $primaryKey = 'id';
  protected $fillable = [
                          "account_group_id",
                          "parent_id",
                          "code",
                          "name_en",
                          "name_kh",
                          "description",
                          "order_level",
                          "status",
                          "created_by",
                          "modified_by"
                        ];
  public $timestamps = false;

  public static function getAcc($param){
    $data = array();
    $query = Account::whereNotIn("status", [4])->orWhere("status", null);
    $whereClause = $query;
    $whereClause->orderBy("order_level");
    if(!empty($param["param"]["value"])){
      $whereClause->where("account_group_id", $param["param"]["value"]);
    }
    $result = collect($whereClause->get());
    foreach($result as $row){
      $data[] = array(
        "label" => $row->code."-".(config_language=="en"?$row->en:$row->name_kh),
        "value" => $row->id,
      );
    }
    return $data;
  }

  public static function getAccountByGroup($param){
    $data = array();
    $query = Account::whereNotIn("status", [4])->orWhere("status", null);
    $whereClause = $query;
    $whereClause->orderBy("order_level");
    if(!empty($param["param"]["value"])){
      $whereClause->where("account_group_id", $param["param"]["value"]);
    }
    $result = collect($whereClause->get());
    foreach($result as $row){
      $data[] = array(
        "label" => $row->code."-".(config_language=="en"?$row->en:$row->name_kh),
        "value" => $row->id,
      );
    }
    return $data;
  }

  public static function getSubAccount($param){
    $data = array();
    $query = Account::whereNotIn("status", [4])->orWhere("status", null);
    $whereClause = $query;
    $whereClause->orderBy("order_level");
    if(!empty($param["param"]["value"])){
      $whereClause->where("parent_id", $param["param"]["value"]);
    }
    $result = collect($whereClause->get());
    foreach($result as $row){
      $data[] = array(
        "label" => $row->code."-".(config_language=="en"?$row->en:$row->name_kh),
        "value" => $row->id,
      );
    }
    return $data;
  }

  public static function getAccounts($filter){
    $data = array();
    $query = Account::orderBy($filter["sort"], $filter["order"]);
    $whereClause = $query;
    $whereClause->whereNotIn("status", [4])->orWhereNull("status");
    if(!empty($filter["search_field"])){
      $whereClause->offset((1 - 1) * $filter["limit"]);       
    }else{
      $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);
    }
    // $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);       
    $whereClause->limit($filter["limit"]);
    if($filter["search_field"]){
      $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
      $dataFields = $arraySingle;
      if (array_key_exists('account_group_id', $dataFields)) {
        $whereClause->Where("account_group_id", 'Like', '%'.$dataFields["account_group_id"]["value"].'%');
      }
      if (array_key_exists('parent_id', $dataFields)) {
        $whereClause->Where("parent_id", 'Like', '%'.$dataFields["parent_id"]["value"].'%');
      }
      if (array_key_exists('code', $dataFields)) {
        $whereClause->Where("code", 'Like', '%'.$dataFields["code"].'%');
      }
      if (array_key_exists('name_kh', $dataFields)) {
        $whereClause->Where("name_kh", 'Like', '%'.$dataFields["name_kh"].'%');
      }
      if (array_key_exists('name_en', $dataFields)) {
        $whereClause->Where("name_en", 'Like', '%'.$dataFields["name_en"].'%');
      }
    }
    $results = collect($whereClause->get());
    foreach($results as $row){
      $data[] = array(
        "id" => $row->id,
        "account_group_id" => $row->account_group_id,
        "parent_id" => $row->parent_id,
        "code" => $row->code,
        "name_en" => $row->name_en,
        "name_kh" => $row->name_kh,
        "description" => $row->description,
        "order_level" => $row->order_level,
        "status" => $row->status,
        "created_by" => $row->created_by,
        "modified_by" => $row->modified_by,
      );
    }
    return $data;
  }

  public static function getCount($filter){
    $data = array();
    $query = Account::orderBy($filter["sort"], $filter["order"]);
    $whereClause = $query;
    // if(!empty($filter["search_field"])){
    //   $whereClause->offset((1 - 1) * $filter["limit"]);       
    // }else{
    //   $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);
    // }
    // $whereClause->limit($filter["limit"]);
    if($filter["search_field"]){
      $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
      $dataFields = $arraySingle;
      if (array_key_exists('account_group_id', $dataFields)) {
        $whereClause->Where("account_group_id", 'Like', '%'.$dataFields["account_group_id"]["value"].'%');
      }
      if (array_key_exists('parent_id', $dataFields)) {
        $whereClause->Where("parent_id", 'Like', '%'.$dataFields["parent_id"]["value"].'%');
      }
      if (array_key_exists('code', $dataFields)) {
        $whereClause->Where("code", 'Like', '%'.$dataFields["code"].'%');
      }
      if (array_key_exists('name_kh', $dataFields)) {
        $whereClause->Where("name_kh", 'Like', '%'.$dataFields["name_kh"].'%');
      }
      if (array_key_exists('name_en', $dataFields)) {
        $whereClause->Where("name_en", 'Like', '%'.$dataFields["name_en"].'%');
      }
    }
    $total = collect($whereClause->count());
    return $total;
  }
  
}