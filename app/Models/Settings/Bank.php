<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
  protected $table = 'bank';
  protected $fillable = [
                          "name_en",
                          "name_kh",
                          'code',
                          'order_level',
                          'address',
                          'remark',
                          'created_by',
                          'modified_by'
                        ];
  public $timestamps = true;
}
