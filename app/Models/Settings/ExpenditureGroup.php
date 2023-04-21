<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class ExpenditureGroup extends Model
{
    protected $table = 'mef_expenditure_group';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name_en',
                            'name_kh',
                            'order_level',
                            'is_active'
                          ];
    public $timestamps = false;
}