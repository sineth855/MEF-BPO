<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'mef_item';
    protected $fillable = [
                            'title_en',
                            'title_kh',
                            'order_level'
                          ];
    public $timestamps = false;
}
