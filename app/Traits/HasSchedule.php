<?php

namespace App\Traits;
use App\Models\Schedule;
use App\Models\TeacherSubjects;
use Illuminate\Support\Facades\Validator;

trait HasSchedule{

    use HasSchoolYear;

    


    public function addSchedule($data){


        // Validator::make($data, [
           
        //     'day' => ['required'],
        //     'start' => ['required', 'date_format:H:i'],
        //     'end' => ['required', 'date_format:H:i', 'after:start'],
        // ])->validate();


        try{

            $schedules = TeacherSubjects::where('semester',$this->currentSemester)
            ->where('school_year',$this->currentSchoolYear)
            ->get();




            return response()->json([
                'schedules'=>$schedules,
            ]);
            // return  Schedule::create([
            //     'teacher_subject_id'=>$this->id,
            //     'day'=> $data['day'],
            //     'start' => $data['start'],  
            //     'end'=> $data['end'],
            //     'section'=> $data['section'],
            //     'room'=> $data['room'],
            // ]);
            
        }catch(\Exception $e){

        }



       

      

    }
}