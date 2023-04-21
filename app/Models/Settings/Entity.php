<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entity';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'code',
                            'department_id',
                            'name_en',
                            'name_kh',
                            'color',
                            'limit_member',
                            "order_level",
                            'abbreviation',
                            'deputy_commissionerofficer',
                            'professional_offier',
                            'is_active',
                            'created_by',
                            'modified_by',
                          ];
    
    // public function Sector(){
    //   return $this->belongsTo('App\Models\Sector','sector_id');
    // }

    public function Department(){
      return $this->belongsTo('App\Models\Department','department_id');
    }

    public $timestamps = true;
}
