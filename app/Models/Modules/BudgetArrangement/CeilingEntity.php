<?php

namespace App\Models\Modules\BudgetArrangement;

use Illuminate\Database\Eloquent\Model;

class CeilingEntity extends Model
{
    protected $table = 'mef_ceiling_entity';
    protected $fillable = [
                            'planing_id',
                            'ceiling_exp_group',
                            // 'ceiling_exp_type',
                            'sub_program_id',
                            'entity_id',
                            'entity_parent_id',
                            'ceiling_rule',
                            'reg_expense',
                            'non_reg_expense',
                            'ceiling_tran_year_0',
                            'ceiling_tran_year_1',
                            'ceiling_tran_year_2',
                            'ceiling_tran_year_3',
                            'increase_rate_year_0',
                            'increase_rate_year_1',
                            'increase_rate_year_2',
                            'increase_rate_year_3',
                            'remark',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;
}
