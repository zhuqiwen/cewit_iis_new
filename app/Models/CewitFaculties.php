<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitFaculties extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_faculties';

    public function contact()
    {
        return $this->hasOne('App\Models\CewitContacts', 'contact_id');
    }
}
