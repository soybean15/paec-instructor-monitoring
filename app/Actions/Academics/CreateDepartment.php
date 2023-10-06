<?php

namespace App\Actions\Academics;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;

class CreateDepartment{

    public function execute($data){

        Validator::make($data, [
            'name' =>['required', 'string', 'max:255'],
        ])->validate();

        return Department::create([
            'name'=>$data['name'],
        ]);
    }
}