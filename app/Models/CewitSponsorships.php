<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitSponsorships extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_sponsorships';


    public function activity()
    {
        return $this->belongsTo('App\Models\CewitActivities', 'activity_id');
    }

    public function contact()
    {
        return $this->belongsTo('App\Models\CewitContacts', 'contact_id');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\CewitOrganizations', 'organization_id');
    }
}
