<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table = 'title';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name',
                            'modified_by'
                          ];
    public $timestamps = true;
}
