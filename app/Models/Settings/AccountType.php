<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $table = 'account_type';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name',
                            'description'
                          ];
    public $timestamps = true;
}
