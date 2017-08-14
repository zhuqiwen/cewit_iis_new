<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CewitAcademicPrograms extends Model
{
    use SoftDeletes;

    protected $table = 'cewit_academic_programs';

    public function students()
    {
        return $this->belongsToMany('App\Models\CewitStudents', 'cewit_enrollments', 'student_id', 'academic_program_id');
    }
}
