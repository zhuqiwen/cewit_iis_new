<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitActivities extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_activities';

    // contacts who did attend an activity
    public function participants()
    {
        return $this->belongsToMany('App\Models\CewitContacts', 'cewit_activity_attendance', 'activity_id', 'contact_id');
    }

    // contacts who replies to agree to attend an activity
    public function rsvps()
    {
        return $this->belongsToMany('App\Models\CewitContacts', 'cewit_activity_rsvps', 'activity_id', 'contact_id');
    }


    // contacts who help manage an activity
    public function managers()
    {
        return $this->belongsToMany('App\Models\CewitContacts', 'cewit_activity_managers', 'activity_id', 'contact_id');
    }


    public function topics()
    {
        return $this->belongsToMany('App\Models\CewitActivityTopics', 'cewit_activity_topic_mappings', 'activity_id', 'topic_id');
    }

    public function types()
    {
        return $this->belongsToMany('App\Models\CewitActivityTypes', 'cewit_acativity_types', 'activity_id', 'type_id');
    }


    public function sponsorships()
    {
        return $this->hasOne('App\Models\CewitSponsorships', 'activity_id');
    }

}
