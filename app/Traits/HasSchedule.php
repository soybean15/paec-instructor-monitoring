<?php

namespace App\Traits;
use App\Models\Schedule;
use Illuminate\Support\Facades\Validator;

trait HasSchedule{



    


    public function addSchedule($data){


        Validator::make($data, [
           
            'day' => ['required'],
            'start' => ['required', 'date_format:H:i'],
            'end' => ['required', 'date_format:H:i', 'after:start'],
        ])->validate();



       

        return  Schedule::create([
            'teacher_subject_id'=>$this->id,
            'day'=> $data['day'],
            'start' => $data['start'],  
            'end'=> $data['end'],
            'section'=> $data['section'],
            'room'=> $data['room'],
        ]);

    }
}