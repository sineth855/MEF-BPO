<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    protected $fillable = [
                            'title_en',
                            'title_kh',
                            'order_level',
                            'remark'
                          ];
    public $timestamps = false;
}
