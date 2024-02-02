<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class AuditrailLog extends Model
{
  protected $table = 'auditrail_log';
  protected $primaryKey = 'id';
  protected $fillable = [
                          'user_id',
                          'method',
                          'module',
                          'activity',
                          'ip_access',
                          'link',
                          'user_agent',
                          'created_at'
                        ];
  public $timestamps = false;

  public static function getAuditrails($filter){
    $data = array();
    $query = AuditrailLog::orderBy($filter["sort"], $filter["order"]);
    $whereClause = $query;
    $whereClause->offset(($filter["page_number"] - 1) * $filter["limit"]);
    $whereClause->limit($filter["limit"]);
    if($filter["search_field"]){
      $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
      $dataFields = $arraySingle;
      if (array_key_exists('user_id', $dataFields)) {
        $whereClause->Where("user_id", $dataFields["user_id"]["value"]);
      }
    }
    $queryResult = collect($whereClause->get());
    foreach($queryResult as $row){
      $data[] = array(
        'user_id' => $row->user_id,
        'method' => $row->method,
        'module' => $row->module,
        'activity' => $row->activity,
        'ip_access' => $row->ip_access,
        'link' => $row->link,
        'user_agent' => $row->user_agent,
        'created_at' => $row->created_at
      );
    }
    return $data;
  }
    
  public static function getCount($filter){
    $query = AuditrailLog::orderBy($filter["sort"], $filter["order"]);
    $whereClause = $query;
    if($filter["search_field"]){
      $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
      $dataFields = $arraySingle;
      if (array_key_exists('user_id', $dataFields)) {
        $whereClause->Where("user_id", $dataFields["user_id"]["value"]);
      }
    }
    $total = collect($whereClause->count());
    return $total;
  }

}