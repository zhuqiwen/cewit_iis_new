<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitStudents extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_students';

//    protected $appends = [
//        'contact',
//        'email',
//    ];


    protected $fillable = [
        'contact_id',
        'current_year_of_school',
    ];

    public function contact()
    {
        return $this->belongsTo('App\Models\CewitContacts', 'contact_id');
    }

    public function academicPrograms()
    {
//        return $this->belongsToMany('App\Models\CewitAcademicPrograms', 'cewit_enrollments', 'academic_program_id','student_id');
        return $this->belongsToMany('App\Models\CewitAcademicPrograms', 'cewit_enrollments', 'student_id','academin_programm_id');
    }




    protected function getContactAttribute()
    {
        return $this->contact()
            ->where('deleted_at', null)
            ->where('is_test', 0)
            ->where('is_active', 1)
            ->where('is_affiliate', 1)
            ->first();
    }


}
