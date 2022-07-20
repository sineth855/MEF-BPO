<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompositionRequest extends Model
{
    protected $table = 'incentive_composition_request';
    protected  $primaryKey = 'id';
    protected $guarded;
    protected $fillable = [
                            'request_title',
                            'reference',
                            'request_from',
                            'description',
                            'letter_type',
                            'status',
                            'entity',
                            'entity_id',
                            'attach_file',
                            'request_date',
                            'effective_date',
                            'created_by',
                            'modified_by',
                            'is_approved'
                          ];
    public $timestamps = true;
}
