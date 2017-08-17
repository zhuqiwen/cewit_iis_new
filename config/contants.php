<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Defined Variables
    |--------------------------------------------------------------------------
    |
    | This is a set of variables that are made specific to this application
    | that are better placed here rather than in .env file.
    | Use config('your_key') to get the values.
    |
    */

    'options_gender' => [
        'female' => 'female',
        'male' => 'male',
        'unknown' => 'unknown',
    ],

    'options_job_type' => [
        'full time' => 'Full Time',
        'part time' => 'Part Time',
        'unknown' => 'Unknown',
    ],

    'options_affiliate_type' => [
        'student' => 'Student',
        'staff' => 'Staff',
        'faculty' => 'Faculty',
        'alumni' => 'Alumni',
    ],

    'options_year_of_school' => [
        'freshman' => 'Freshman',
        'junior' => 'Junior',
        'senior' => 'Senior',
    ],


];