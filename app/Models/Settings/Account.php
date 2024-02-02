<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
  protected $table = 'account';
  protected $primaryKey = 'id';
  protected $fillable = [
                          'account_group_id',
                          'parent_id',
                          'code',
                          "name_en",
                          "name_kh",
                          'description',
                          'order_level',
                          'is_delete'
                        ];
  public $timestamps = true;
}