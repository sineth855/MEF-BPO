<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
  protected $table = 'bank';
  protected $fillable = [
                          'name',
                          'code',
                          'address',
                          'remark',
                          'modified_by'
                        ];
  public $timestamps = true;
}
