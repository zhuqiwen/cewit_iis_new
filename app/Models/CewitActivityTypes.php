<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitActivityTypes extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_acativity_types';


    public function activities()
    {
        return $this->belongsToMany('App\Models\CewitActivities', 'cewit_activity_type_mappings', 'type_id', 'activity_id');
    }
}
