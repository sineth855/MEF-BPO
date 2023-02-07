<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entity';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'name',
                            'limit_member',
                            'sector_id',
                            'department_id',
                            'sector',
                            'department',
                            'code',
                            'color',
                            "order_level",
                            'abbreviation',
                            'deputy_commissionerofficer',
                            'professional_offier',
                            'modified_by',
                            'is_active'
                          ];
    
    public function Sector(){
      return $this->belongsTo('App\Models\Sector','sector_id');
    }

    public function Department(){
      return $this->belongsTo('App\Models\Department','department_id');
    }

    public $timestamps = true;
}
