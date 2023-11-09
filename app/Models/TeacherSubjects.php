<?php

namespace App\Models;

use App\Traits\HasSchoolYear;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubjects extends Model
{
    use HasFactory, HasSchoolYear;

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'school_year',
        'semester'
    ];





    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);    
    }

   

    public function scopeCurrentSubject(Builder $query){

        $query->where('year_level',$this->getSetting('year_level'))
        ->where('semester', $this->getSetting('semester'));

    }

  
}
