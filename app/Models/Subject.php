<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'code',
        'description',
        'year_level',
        'semester',
        'number_of_units',
        'user_id',
        'course_id'

    ];

    protected $appends = ['courseName'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getCourseNameAttribute()
    {


        $roman = [
            1 => 'I',
            2 => 'I',
            3 => 'I',
            4 => 'IV'
        ];

        if ($this->course) {
            return $this->course->name;
        }


        return 'General Education ' . $roman[$this->year_level];
    }





}
