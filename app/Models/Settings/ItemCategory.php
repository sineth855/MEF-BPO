<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $table = 'mef_item_category';
    protected $fillable = [
                            'parent_id',
                            'title_en',
                            'title_kh',
                            'order_level'
                          ];
    public $timestamps = false;
}
