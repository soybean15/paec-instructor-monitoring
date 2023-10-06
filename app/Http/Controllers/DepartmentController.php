<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Managers\DepartmentManager;
class DepartmentController extends Controller
{

    protected DepartmentManager $manager;

    public function __construct(DepartmentManager $manager){
        $this->manager=$manager;
    }

    public function index(){
        $departments = Department::all();

        return response()-> json([
            'departments' => $departments
        ]);
    }


    public function store(Request $request){
        $this->manager->store($request->all());
    }
}
