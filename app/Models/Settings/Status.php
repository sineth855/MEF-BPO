<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'mef_status';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            "group",
                            "title_en",
                            "title_kh",
                            "order_level",
                            "created_by",
                            "modified_by"
                          ];
    public $timestamps = false;
}
