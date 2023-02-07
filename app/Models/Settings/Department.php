<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name',
                            'modified_by'
                          ];
    protected $guarded = array(
      'api'
    );
    public $timestamps = true;
}
