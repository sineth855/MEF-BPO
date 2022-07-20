<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    protected $table = 'account_group';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name',
                            'description'
                          ];
    public $timestamps = true;
}
