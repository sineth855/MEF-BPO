<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    protected $table = 'user_device';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'user_id',
                            'device_type',
                            'device_token',
                            'remark'
                          ];
    public $timestamps = false;
}
