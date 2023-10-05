<?php

namespace App\Actions\Academics;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;

class CreateCourse{

    public function execute($data){
        
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
        ])->validate();

        return Course::create([
            'name' =>$data['name'],
            'description' => $data['description'],
        ]);
    }
}