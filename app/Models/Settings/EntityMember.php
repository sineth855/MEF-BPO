<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class EntityMember extends Model
{
    protected $table = 'entity_member';
    protected  $primaryKey = 'id';
    protected $fillable = [
                            'user_id',
                            'photo',
                            'identity_no',
                            'title',
                            'first_name',
                            'last_name',
                            'latin',
                            'duty',
                            'duty_id',
                            "entity",
                            "entity_id",
                            'gender',
                            'address',
                            'email',
                            'position',
                            'department',
                            'telephone_1',
                            'telephone_2',
                            'order_level',
                            'created_by',
                            'modified_by',
                            'is_active'
                          ];
                          
    public $timestamps = true;
}
