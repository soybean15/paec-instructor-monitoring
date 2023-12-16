<?php

namespace App\Models;


use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    protected $fillable = ['user_id','department_id'];


    protected $appends=['current_subjects'];
    public function user(){

        return $this->belongsTo(User::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
        
    }

 


    public function scopePending(Builder $query){

        $query->where('status','pending');

    }

    public function subjects(){
       
        return $this->hasMany(TeacherSubjects::class);
    }

    public function getCurrentSubjectsAttribute()
    {
        return $this->subjects()->currentSubject()->get();
    }

    public function getArchiveSubjects($school_year,$semester){

        //return response()->json(['year'=>$school_year,'sem'=>$semester]);
        return $this ->subjects()->archiveSubjects($school_year,$semester);
    }

    // public function availableSubjects(){
    //     $teacherSubjects = $this->subjects->pluck('subject_id');
    //     $subjects = Subject::whereDoesntHave('teacherSubjects', function ($query) use ($teacherSubjects) {
    //         $query->whereIn('subject_id', $teacherSubjects);
    //     })->get();
    
    //     return $subjects;
        
    // }

}
