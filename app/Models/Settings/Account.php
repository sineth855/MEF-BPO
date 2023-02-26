<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'parent_id',
                            'code',
                            'name_en',
                            'name_kh',
                            'description',
                            'order_level'
                          ];
    public $timestamps = true;
}
