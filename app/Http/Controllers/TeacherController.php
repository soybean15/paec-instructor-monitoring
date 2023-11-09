<?php

namespace App\Http\Controllers;

use App\Http\Managers\TeacherManager;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //


    protected TeacherManager $manager;

    public function __construct(TeacherManager $manager){

        $this->manager = $manager;
    }

    public function index(){
        return $this->manager->index();
    }



    public function pending(){

        return $this->manager->getPending();

    }

    public function accept(String $id){
        return $this->manager->accept($id);
    }

    public function reject(String $id){
        return $this->manager->reject($id);
    }


    public function store(Request $request){
        return $this->manager->store($request->all());
    }


    public function getTeacher(String $id){
        return    $this->manager->getTeacher($id);
    }

    public function insertSubjects(String $id, Request $request){

        // return response()->json([
        //     'request'=>$request->subjects,
        //     'id'=>$id
        // ]);
        return $this->manager->insertSubjects($request->subjects,$id);


      
    }

    public function getAvailableSubjects(String $id){

        return $this->manager->availableSubjects($id);

        
    }

    public function filterAvailableSubjectsByCourse(Request $request){
        return $this->manager->availableSubjects($request['teacher_id'],$request['course_id']);
    }



}
