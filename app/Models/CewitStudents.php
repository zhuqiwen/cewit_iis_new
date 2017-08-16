<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitStudents extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_students';

    public function contact()
    {
        return $this->belongsTo('App\Models\CewitContacts', 'contact_id');
    }

    public function academicPrograms()
    {
        return $this->belongsToMany('App\Models\CewitAcademicPrograms', 'cewit_enrollments', 'academic_program_id','student_id');
    }
}
