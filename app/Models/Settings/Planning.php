<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    protected $table = 'mef_planning';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            "name_en",
                            "name_kh",
                            'year',
                            'start_date',
                            'end_date',
                            'is_default',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;
}
