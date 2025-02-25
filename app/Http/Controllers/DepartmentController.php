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
        $departments = Department::paginate(5);

        return response()-> json([
            'departments' => $departments
        ]);
    }

    public function getDepartments(){
        $departments = Department::all();

        return response()-> json([
            'departments' => $departments
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
 