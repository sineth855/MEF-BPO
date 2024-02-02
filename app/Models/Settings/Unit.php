<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Unit extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  protected $auditStrict = true;
  protected  $primaryKey = 'id';
  
  protected $table = 'unit';
  protected $fillable = [
                          "name_en",
                          "name_kh",
                          'order_level',
                          'remark',
                          'status'
                        ];
  public $timestamps = false;
}
