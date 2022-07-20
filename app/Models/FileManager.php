<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileManager extends Model
{
    protected $table = 'file_manager';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'file_name',
                            'url',
                            'file_type',
                            'extention',
                            'caption'
                          ];
    public $timestamps = true;
}
