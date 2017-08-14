<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitSigs extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_sigs';

    public function members()
    {
        return $this->belongsToMany('App\Models\CewitContacts', 'cewit_contact_sig_mappings', 'sig_id', 'contact_id');
    }

    public function leads()
    {
        return $this->belongsToMany('App\Models\CewitContacts', 'cewit_sig_leads', 'sig_id', 'contact_id');
    }
}
