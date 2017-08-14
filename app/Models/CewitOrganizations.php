<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitOrganizations extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_organizations';

    public function alums()
    {
        return $this->belongsToMany('App\Models\CewitAlums', 'cewit_employments', 'organization_id', 'alum_id');
    }

    public function sponsorships()
    {
        return $this->hasMany('App\Models\CewitSponsorships', 'organizations_id');
    }

    public function sponsorActivities()
    {
        return $this->belongsToMany('App\Models\CewitActivities', 'cewit_sponsorships', 'organization_id', 'activity_id');
    }
}
