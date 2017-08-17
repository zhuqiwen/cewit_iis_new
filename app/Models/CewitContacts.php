<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitContacts extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_contacts';
//    protected $appends = [
//        'full_name',
//        'student',
//        'staff',
//        'faculty',
//        'alum',
//        'affiliate_type',
//        'email',
//        ];

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'iuid',
        'gender',
        'street',
        'city',
        'state',
        'country',
        'join_date',
        'is_active',
        'is_affiliate',
        'is_test',
    ];





    public function student()
    {
        return $this->hasOne('App\Models\CewitStudents', 'contact_id');
    }

    public function faculty()
    {
        return $this->hasOne('App\Models\CewitFaculties', 'contact_id');
    }

    public function staff()
    {
        return $this->hasOne('App\Models\CewitStaff', 'contact_id');
    }

    public function alum()
    {
        return $this->hasOne('App\Models\CewitAlums', 'contact_id');
    }

    public function emails()
    {
        return $this->hasMany('App\Models\CewitEmails', 'contact_id');
    }

    // contacts who did attend an activity
    public function participateActivities()
    {
        return $this->belongsToMany('App\Models\CewitActivities', 'cewit_activity_attendance', 'contact_id', 'activity_id');
    }

    // contacts who replies to agree to attend an activity
    public function intendToAttendActivities()
    {
        return $this->belongsToMany('App\Models\CewitActivities', 'cewit_activity_rsvps', 'contact_id', 'activity_id');
    }

    public function sponsorActivities()
    {
        return $this->belongsToMany('App\Models\CewitActivities', 'cewit_sponsorships', 'contact_id', 'activity_id');
    }


    // contacts who help manage an activity
    public function manageActivities()
    {
        return $this->belongsToMany('App\Models\CewitActivities', 'cewit_activity_managers', 'contact_id', 'activity_id');
    }


    public function donateSponsorships()
    {
        $this->hasMany('App\Models\CetwitSponsorships', 'contact_id');
    }

    public function participateSigs()
    {
        return $this->belongsToMany('App\Models\CewitSigs', 'cewit_contact_sig_mappings', 'contact_id', 'sig_id');
    }

    public function manageSigs()
    {
        return $this->belongsToMany('App\Models\CewitSigs', 'cewit_sig_leads', 'contact_id', 'sig_id');
    }

//
//    public function getActiveAffiliates()
//    {
//        $data = $this->with(['student', 'faculty', 'staff', 'alum'])
//            ->where('is_active', 1)
//            ->where('is_affiliate', 1)
//            ->where('is_test', 0)
//            ->where('deleted_at', null)
//            ->get();
//        return $data;
//
//    }






    protected function getStudentAttribute()
    {
        return $this->student()->first();
    }

    protected function getFacultyAttribute()
    {
        return $this->faculty()->first();
    }

    protected function getStaffAttribute()
    {
        return $this->staff()->first();
    }

    protected function getAlumAttribute()
    {
        return $this->alum()->first();
    }

    protected function getAffiliateTypeAttribute()
    {
        $type = '';

        if($this->student)
        {
            $type .= 'student ';
        }

        if($this->faculty)
        {
            $type .= 'faculty ';
        }

        if($this->staff)
        {
            $type .= 'staff ';
        }

        if($this->alum)
        {
            $type .= 'alumni ';
        }

        return $type;
    }

    protected function getEmailAttribute()
    {
        return $this->emails()->where('is_primary', 1)->first()->email;
    }

    protected function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}


