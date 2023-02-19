<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'mef_activity';
    protected $fillable = [
                            'code',
                            'cluster_activity_id',
                            'entity_id',
                            'entity_member_id',
                            'name_en',
                            'name_kh',
                            'remark',
                            'order_level',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;
}
