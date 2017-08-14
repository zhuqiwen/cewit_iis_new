<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitEmployments extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_employments';

    public function alum()
    {
        return $this->belongsTo('App\Models\CewitAlums', 'alum_id');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\CewitOrganizations', 'organization_id');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Models\CewitSkills', 'cewit_employment_skill_mappings', 'employment_id', 'skill_id');
    }
}
