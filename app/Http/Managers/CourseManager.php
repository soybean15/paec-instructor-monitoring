<?php

namespace App\Http\Managers;
use App\Actions\Academics\CreateCourse;

class CourseManager{


    function store ($data){

        $createCourse = new CreateCourse();

        $course = $createCourse->execute($data);

        return response()->json([
            'course' => $course
        ]);
    }
}