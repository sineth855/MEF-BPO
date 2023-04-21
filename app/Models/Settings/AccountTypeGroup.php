<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class AccountTypeGroup extends Model
{
    protected $table = 'account_type_group';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'title_en',
                            'title_kh',
                            'order_level',
                            'is_active'
                          ];
    public $timestamps = false;
}
