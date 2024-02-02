<?php

namespace App\Models\Modules\BudgetArrangement;
use App\Models\Modules\ProgramManagement\Program;
use App\Models\Modules\ProgramManagement\SubProgram;
use App\Models\Modules\ProgramManagement\ClusterActivity;
use App\Models\Modules\ProgramManagement\Activity;
use Illuminate\Database\Eloquent\Model;

class PBCostingDetail extends Model
{
  protected $table = 'mef_costing_detail_to_entity';
  protected $fillable = [
                          'costing_id',
                          'account_code',
                          'sub_account_code',
                          'line_no',
                          'item_id',
                          'unit_id',
                          'cost',
                          'unit_price',
                          'total_amount',
                          'time_annual',
                          'total_annual_amount',
                          'month',
                          'expense_type',
                          'currency_id',
                          'currency',
                          'flag_type',
                          'exchange_rate',
                          'remark',
                          'is_delete',
                          'created_by',
                          'modified_by'
                        ];
                        
  public $timestamps = false;
}