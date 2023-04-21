<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $table = 'account_type';
    protected  $primaryKey = 'id';
     protected $fillable = [
                            'name_en',
                            'name_kh',
                            'description'
                          ];
    public $timestamps = true;
}
