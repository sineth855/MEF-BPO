<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            "name_en",
                            "name_kh",
                            'created_by',
                            'order_level',
                            'modified_by'
                          ];
    protected $guarded = array(
      'api'
    );
    public $timestamps = true;
}
