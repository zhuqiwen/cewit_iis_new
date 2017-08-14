<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitEmploymentSkillMappings extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_employment_skill_mappings';

    public function employment()
    {
        return $this->belongsTo('App\Models\CewitEmployments', 'employment_id');
    }

    public function skill()
    {
        return $this->belongsTo('App\Models\CewitEmployments', 'skill_id');
    }
}
