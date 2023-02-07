<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    protected $table = 'duty';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name',
                            'incentive',
                            'order_level',
                            'modified_by'
                          ];
    public $timestamps = true;
}
