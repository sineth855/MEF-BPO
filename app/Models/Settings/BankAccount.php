<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_account';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name',
                            'name_kh',
                            'account_group',
                            'account_name',
                            'account_type',
                            'account_number',
                            'open_balance',
                            'currency',
                            'code',
                            'address',
                            'remark',
                            'modified_by',
                            'is_default',
                            'issue_date'
                          ];
    public $timestamps = true;
}
