<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class LetterType extends Model
{
    protected $table = 'letter_type';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name',
                            'modified_by'
                          ];
    public $timestamps = true;
}
