<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitActivityTypeMappings extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_activity_type_mappings';

    public function activity()
    {
        return $this->belongsTo('App\Models\CewitActivities', 'activity_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\CewitActivityTypes', 'type_id');
    }
}
