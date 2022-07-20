<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    protected $table = 'notification_type';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'notification_type',
                            'remark'
                          ];
    public $timestamps = false;
}
