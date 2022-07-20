<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    protected $table = 'notification_user';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'user_id',
                            'officer_id',
                            'title',
                            'description',
                            'status',
                            'push_count',
                            'notification_type',
                            'remark'
                          ];

    public $timestamps = false;
}
