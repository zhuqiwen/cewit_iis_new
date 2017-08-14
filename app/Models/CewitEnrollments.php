<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitEnrollments extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_enrollments';

    public function student()
    {
        return $this->belongsTo('App\Models\CewitStudents', 'student_id');
    }

    public function academicProgram()
    {
        return $this->belongsTo('App\Models\CewitAcademicPrograms', 'academic_program_id');
    }
}
