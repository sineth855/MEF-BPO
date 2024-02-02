<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_account';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            "name_en",
                            "name_kh",
                            'account_group',
                            'account_name',
                            'account_type',
                            'account_number',
                            'open_balance',
                            'currency',
                            'code',
                            'address',
                            'remark',
                            'created_by',
                            'modified_by',
                            'is_default',
                            'issue_date'
                          ];
    public $timestamps = true;
}
