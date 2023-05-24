<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\ProgramManagement\SubProgram;
use App\Models\Settings\Entity;
use App\Models\Settings\EntityMember;

class KPISubProgram extends Model
{
    protected $table = 'mef_kpi_subprogram';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'planning_id',
                            'sub_program_id',
                            'kpi_program_id',
                            'subprog_to_entity_id',
                            'code',
                            'kpi_name_en',
                            'kpi_name_kh',
                            'order_level',
                            'attachment',
                            'year',
                            'progress',
                            'acheivement',
                            'reference_kpi_id',
                            'status',
                            'remark',
                            'is_active',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;

    public static function getKPISubProgram($filter){
        $query = KPISubProgram::orderBy("order_level");
        $whereClause = $query;
        if($filter["search_field"]){
            $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
            $dataFields = $arraySingle;
            if (array_key_exists('sub_program_id', $dataFields)) {
                $whereClause->Where("sub_program_id", $dataFields["sub_program_id"]);
            }
        }
        $result = collect($whereClause->get());
        return $result;
    }

    public static function getCount($filter){
      $query = KPISubProgram::orderBy($filter["sort"], $filter["order"]);
      $whereClause = $query;
    //   $whereClause->whereNotIn("status", [4]);
      if($filter["search_field"]){
        $arraySingle = call_user_func_array('array_merge', $filter["search_field"]);
        $dataFields = $arraySingle;
        if (array_key_exists('sub_program_id', $dataFields)) {
          $whereClause->Where("sub_program_id", $dataFields["sub_program_id"]);
        }
      }
      $total = collect($whereClause->count());
      return $total;
    }
}
