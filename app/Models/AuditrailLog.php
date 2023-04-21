<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditrailLog extends Model
{
    protected $table = 'auditrail_log';
    protected $guarded;
    protected $fillable = [
                            'id',
                            'user_id',
                            'method',
                            'activity',
                            'ip_access'
                          ];
    public $timestamps = false;
}
