<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'position';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name_en',
                            'name_kh',
                            'order_level',
                            'created_by',
                            'modified_by'
                          ];
    public $timestamps = true;
}
