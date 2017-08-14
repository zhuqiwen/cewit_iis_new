<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitContactSigMappings extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_contact_sig_mappings';

    public function contact()
    {
        return $this->belongsTo('App\Models\CewitContacts', 'contact_id');
    }

    public function sig()
    {
        return $this->belongsTo('App\Models\CewitSigs', 'sig_id');
    }

}
