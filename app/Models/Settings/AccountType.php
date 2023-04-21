<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
  protected $table = 'account_type';
  protected $primaryKey = 'id';
  protected $fillable = [
                          'account_type_group_id',
                          'name_en',
                          'name_kh',
                          'description',
                          'order_level'
                      ];
  public $timestamps = true;
}
