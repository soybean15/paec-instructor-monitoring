<?php

namespace App\Actions\Academics;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
class CreateSubject
{

    // 'name',
    // 'description',
    // 'year_level',
    // 'semester',
    // 'number_of_units',

    // 'course_id'
    public function execute($data){

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'code'=>['required', 'string'],
            'year_level' => ['required'],
            'semester' => ['required'],
            'number_of_units'=> ['required'],

        ])->validate();

       return Subject::create([
            'name' =>$data['name'],
            'code'=>$data['code'],
            'description'=>$data['description'],
            'year_level' =>$data['year_level']['value'],
            'semester' => $data['semester']['value'],
            'course_id'=>$data['course_id']['value'],
            'number_of_units'=> $data['number_of_units'],
        ]);

    }


}
