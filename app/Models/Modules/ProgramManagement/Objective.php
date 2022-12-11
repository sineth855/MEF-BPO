<?php

namespace App\Models\Modules\ProgramManagement;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $table = 'objective';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'name',
                            'name_kh',
                            'remark'
                          ];
    public $timestamps = true;
}
