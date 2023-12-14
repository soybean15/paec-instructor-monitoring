<?php
use App\Http\Managers\TeacherManager;
use App\Models\Teacher;
use App\Models\TeacherSubjects;

use Illuminate\Support\Facades\Route;




Route::get('/schedule',function(){

  
   $teacherSubject = TeacherSubjects::find(1);

   return $teacherSubject->testAddSchedule();


});
Route::get('/{id}',function($id){
   $manager = new TeacherManager();

   return $manager->getTodaySchedule($id);
   
});

Route::get('/current/{id}',function($id){

   return "test";
});

Route::get('/subject-schedules/{id}',function($id){
   
   $manager = new TeacherManager();
   return $manager->getSubjectSchedules($id);

});

