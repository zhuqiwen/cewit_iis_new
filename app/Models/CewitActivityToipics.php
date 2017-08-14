<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitActivityToipics extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_activity_topics';

    public function activities()
    {
        return $this->belongsToMany('App\Models\CewitActivities', 'cewit_activity_topic_mappings', 'topic_id', 'activity_id');
    }
}
