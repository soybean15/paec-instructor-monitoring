<?php
use App\Http\Managers\TeacherManager;
use App\Models\TeacherSubjects;

use Illuminate\Support\Facades\Route;



Route::get('/{id}',function($id){
   $manager = new TeacherManager();

   return $manager->getSchedules($id);
   
});