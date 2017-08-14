<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitSigLeads extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_sig_leads';

    public function sig()
    {
        return $this->belongsTo('App\Models\CewitSigs', 'sig_id');
    }

    public function contact()
    {
        return $this->belongsTo('App\Models\CewitContacts', 'contact_id');
    }
}
