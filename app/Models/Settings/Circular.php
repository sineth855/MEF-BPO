<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circular extends Model
{
    protected $table = 'circular';
    protected $fillable = [
                            'achivement',
                            'incentive',
                            'shape',
                            'color',
                            'order_level',
                            'remark',
                            'modified_by'
                            ];
    public $timestamps = true;
}
