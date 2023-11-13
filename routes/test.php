<?php
use App\Models\TeacherSubjects;
use Illuminate\Support\Facades\Route;



Route::get('/{id}',function($id){
    $teacherSubject = TeacherSubjects::find($id);

    return $teacherSubject->getSchedules();

});