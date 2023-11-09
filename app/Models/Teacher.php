<?php

namespace App\Models;


use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    protected $fillable = ['user_id','department_id'];


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

    // public function availableSubjects(){
    //     $teacherSubjects = $this->subjects->pluck('subject_id');
    //     $subjects = Subject::whereDoesntHave('teacherSubjects', function ($query) use ($teacherSubjects) {
    //         $query->whereIn('subject_id', $teacherSubjects);
    //     })->get();
    
    //     return $subjects;
        
    // }

}
