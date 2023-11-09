<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Managers\CourseManager; 

class CourseController extends Controller
{

    protected CourseManager $manager;
    public function __construct(CourseManager $manager)
    {
        $this->manager = $manager;
    }

    public function index(){
        $courses = Course::paginate(10);

        return response()-> json([
            'courses' => $courses
        ]);
    }

    public function getCourses(){
        $courses = Course::all();

        return response()-> json([
            'courses' => $courses
        ]);
    }


    public function store(Request $request){

        $this->manager->store($request->all());

    }


    public function update(Request $request){


        return $this->manager->update(
            [
                'attribute'=>$request['attribute'],
                'value'=>$request['value']
            ], 
            $request['id']
        );
    }


    public function destroy(Request $request){

        return $this->manager->destroy($request['id']);
  }

  public function search (Request $request){

    return $this->manager->search($request['val']==null?'':$request['val']);

  
}
   
}
