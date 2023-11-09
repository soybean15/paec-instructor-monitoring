<?php

namespace App\Traits;
use App\Models\Subject;
use App\Models\Teacher; 
trait HasSubject{



    public function validate($attribute){

        switch ($attribute){
            case 'name':{
                return ['required','string'];
            }
            case 'year_level':{
                return ['required','string'];
            }
            case 'semester':{
                return ['required','string'];
            }
            case 'number_of_units':{
                return ['required','string'];
            }

            default:{
                return [];
            }
           
        }

    }



   public function availableSubjects($teacher_id){

     $teacher = Teacher::find($teacher_id);

     $teacherSubjects = $teacher->subjects->pluck('subject_id');

     $subjects = Subject::whereNotIn('id', $teacherSubjects)->get();

     return response()->json([
        'subjects'=>$subjects,
        'ids'=>$teacherSubjects
     ]);
    
   }





}