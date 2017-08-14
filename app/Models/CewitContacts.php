<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitContacts extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_contacts';

    public function student()
    {
        return $this->belongsTo('App\Models\CewitStudents', 'contact_id');
    }

    public function faculty()
    {
        return $this->belongsTo('App\Models\CewitFaculties', 'contact_id');
    }

    public function staff()
    {
        return $this->belongsTo('App\Models\CewitStaff', 'contact_id');
    }

    public function alum()
    {
        return $this->belongsTo('App\Models\CewitAlums', 'contact_id');
    }

    public function emails()
    {
        return $this->hasMany('App\Models\CewitEmails', 'contact_id');
    }

    // contacts who did attend an activity
    public function participateActivities()
    {
        return $this->belongsToMany('App\Models\CewitActivities', 'cewit_activity_attendance', 'contact_id', 'activity_id');
    }

    // contacts who replies to agree to attend an activity
    public function intendToAttendActivities()
    {
        return $this->belongsToMany('App\Models\CewitActivities', 'cewit_activity_rsvps', 'contact_id', 'activity_id');
    }

    public function sponsorActivities()
    {
        return $this->belongsToMany('App\Models\CewitActivities', 'cewit_sponsorships', 'contact_id', 'activity_id');
    }


    // contacts who help manage an activity
    public function manageActivities()
    {
        return $this->belongsToMany('App\Models\CewitActivities', 'cewit_activity_managers', 'contact_id', 'activity_id');
    }


    public function donateSponsorships()
    {
        $this->hasMany('App\Models\CetwitSponsorships', 'contact_id');
    }

    public function participateSigs()
    {
        return $this->belongsToMany('App\Models\CewitSigs', 'cewit_contact_sig_mappings', 'contact_id', 'sig_id');
    }

    public function manageSigs()
    {
        return $this->belongsToMany('App\Models\CewitSigs', 'cewit_sig_leads', 'contact_id', 'sig_id');
    }


}


