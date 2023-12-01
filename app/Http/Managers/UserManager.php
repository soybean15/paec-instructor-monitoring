<?php

namespace App\Http\Managers;
use App\Actions\User\UpdateProfile;
use App\Models\TeacherSubjects;
use App\Models\User;


class UserManager
{
    private UpdateProfile $updateProfile;

    public function __construct( UpdateProfile $updateProfile)
    {
        $this->updateProfile = $updateProfile;
    }


    public function updateProfile($attributes, $id){

        return $this->updateProfile->execute($attributes,$id);
    }


    public function getClasses($teacher_id){
        $teacher =  TeacherSubjects::where('teacher_id',$teacher_id)->first();

        if($teacher){
            return $teacher->getTodaySchedules();

        }


    }

    public function getUserSchedules($teacher_id){
        $teacher =  TeacherSubjects::where('teacher_id',$teacher_id)->first();

        if($teacher){
            return $teacher->getSchedules();

        }
        
    }


    public function getSubjectSchedules($teacher_subject_id){
    
        $teacherSubject = TeacherSubjects::find($teacher_subject_id);


        return response()->json($teacherSubject->schedules);

    }

    public function upload($id,$file){

        $user = User::find($id);

        if($file){
            $user->profile->restoreImage('images/users', $file);
        }

        return response()->json([
            'image' =>$user->profile->image 
        ]);


    }


}