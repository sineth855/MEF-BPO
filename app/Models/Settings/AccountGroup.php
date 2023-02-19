<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    protected $table = 'account_group';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name_en',
                            'name_kh',
                            'description'
                          ];
    public $timestamps = true;
}
