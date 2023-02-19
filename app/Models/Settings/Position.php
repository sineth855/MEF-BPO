<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'position';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name',
                            'modified_by'
                          ];
    public $timestamps = true;
}
