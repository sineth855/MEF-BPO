<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'name',
                            'description'
                          ];
    public $timestamps = true;
}
