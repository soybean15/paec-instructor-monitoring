<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Schedule extends Model
{
    use HasFactory;


    protected $fillable = [
        'teacher_subject_id',
        'day',
        'start',
        'end',
        'section',
        'room'

    ];

    protected $appends=['day_str' ];

    public function getDayStrAttribute(){

        $days = [
            'Sunday',
           'Monday',
           'Tueday',
           'Wednesday',
           'Thursday',
           'Friday',
           'Saturday'
        ];

        return $days[$this->day];
      
    }

    public function teacherSubject(){
        return $this->belongsTo(TeacherSubjects::class,'teacher_subject_id');
    }

  
}

