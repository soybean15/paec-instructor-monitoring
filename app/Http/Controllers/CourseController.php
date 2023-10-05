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
        $courses = Course::all();

        return response()-> json([
            'courses' => $courses
        ]);
    }


    public function store(Request $request){

        $this->manager->store($request->all());

    }
}
