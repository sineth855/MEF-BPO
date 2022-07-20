<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configuration';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'group',
                            'name',
                            'keyword',
                            'value',
                          ];
    public $timestamps = false;
}
