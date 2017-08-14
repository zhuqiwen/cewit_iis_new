<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitSkills extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_skills';

    public function employments()
    {
        return $this->belongsToMany('App\Models\CewitEmployments', 'cewit_employment_skill_mappings', 'skill_id', 'employment_id');
    }
}
