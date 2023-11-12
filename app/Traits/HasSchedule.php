<?php

namespace App\Traits;
use App\Models\Schedule;
use Illuminate\Support\Facades\Validator;

trait HasSchedule{



    


    public function addSchedule($data){


        Validator::make($data, [
            'teacher_subject_id' => ['required'],
            'day' => ['required'],
            'start' => ['required', 'date_format:H:i'],
            'end' => ['required', 'date_format:H:i', 'after:start'],
        ])->validate();



       

        return  Schedule::create($data);

    }
}