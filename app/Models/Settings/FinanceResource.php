<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class FinanceResource extends Model
{
    protected $table = 'mef_finance_resource';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name_en',
                            'name_kh',
                            'order_level',
                            'is_active'
                          ];
    public $timestamps = true;
}