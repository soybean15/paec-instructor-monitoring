<?php

namespace App\Http\Managers;
use App\Actions\User\UpdateProfile;
use App\Models\TeacherSubjects;


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


}