<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitActivityTopicMappings extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_activity_topic_mappings';

    public function activity()
    {
        return $this->belongsTo('App\Models\CewitActivities', 'activity_id');
    }

    public function topic()
    {
        return $this->belongsTo('App\Models\CewitActivityToipics', 'topic_id');
    }
}
