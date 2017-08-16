<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitStaff extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_staff';

    public function contact()
    {
        return $this->belongsTo('App\Models\CewitContacts', 'contact_id');
    }
}
