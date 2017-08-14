<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitActivityRsvps extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_activity_rsvps';

    public function activity()
    {
        return $this->belongsTo('App\Models\CewitActivities', 'activity_id');
    }

    public function contact()
    {
        return $this->belongsTo('App\Models\CewitContacts', 'contact_id');
    }
}
