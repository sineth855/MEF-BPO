<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class ExpenditureType extends Model
{
  protected $table = 'mef_expenditure_type';
  protected  $primaryKey = 'id';
  protected $fillable = [
                          "name_en",
                          "name_kh",
                          'order_level',
                          'is_active'
                        ];
  public $timestamps = false;
}