<?php 

namespace App\Http\Managers;
use App\Actions\Academics\CreateDepartment;

class DepartmentManager{

    function store($data){
      
        $createDepartment = new CreateDepartment();

        $department = $createDepartment->execute($data);

        return response()->json([
            'department' => $department
        ]);
    }

}