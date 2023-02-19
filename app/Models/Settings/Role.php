<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name',
                            'remark'
                          ];
    public $timestamps = true;
}
