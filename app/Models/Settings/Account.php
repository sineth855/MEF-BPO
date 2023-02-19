<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'name_en',
                            'name_kh',
                            'description'
                          ];
    public $timestamps = true;
}
