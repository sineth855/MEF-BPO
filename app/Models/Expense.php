<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expense';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'account_group',
                            'account_type',
                            'account',
                            'title',
                            'description',
                            'issue_date',
                            'category',
                            'payment_method',
                            'amount',
                            'exchange_rate',
                            'reference',
                            'entity',
                            'entity_id',
                            'currency',
                          ];
    public $timestamps = true;
}
