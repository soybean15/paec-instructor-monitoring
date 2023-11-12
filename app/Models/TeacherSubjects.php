<?php

namespace App\Models;

use App\Traits\HasSchedule;
use App\Traits\HasSchoolYear;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubjects extends Model
{
    use HasFactory, HasSchoolYear,HasSchedule;

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'school_year',
        'semester'
    ];



    protected $appends=['subject_name'];


    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);    
    }

   

    public function scopeCurrentSubject(Builder $query){

        $query->where('school_year',$this->currentSchoolYear())
        ->where('semester', $this->currentSemester());

    }

    public function schedules(){
        return $this->hasMany(Schedule::class, 'teacher_subject_id');
    }


    public function getSubjectNameAttribute(){
       
            return $this->subject->name;
       
    }

  
}
