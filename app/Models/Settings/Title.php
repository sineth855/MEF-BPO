<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table = 'title';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name_en',
                            'name_kh',
                            'modified_by'
                          ];
    public $timestamps = true;
}
