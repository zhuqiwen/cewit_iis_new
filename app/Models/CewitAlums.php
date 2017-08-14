<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CewitAlums extends Model
{
    protected $table = 'cewit_alums';

    public function contact()
    {
        return $this->hasOne('App\Models\CewitContacts', 'contact_id');
    }

    public function employments()
    {
        return $this->belongsToMany('App\Models\CewitOrganizations', 'cewit_employments', 'alum_id', 'organization_id');
    }

}
