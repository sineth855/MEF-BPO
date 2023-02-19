<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currency';
    protected $fillable = [
                            'name',
                            'code',
                            'rate',
                            'abbreviation',
                            'symbol_left',
                            'symbol_right',
                            'remark',
                            'created_by',
                            'modified_by'
                            ];
    public $timestamps = true;
}
