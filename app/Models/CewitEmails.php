<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitEmails extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_emails';

    public function contacts()
    {
        return $this->belongsTo('App\Models\CewitContacts', 'contact_id');
    }
}
