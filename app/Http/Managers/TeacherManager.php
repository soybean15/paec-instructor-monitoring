<?php

namespace App\Http\Managers;

use App\Models\Teacher;
use App\Models\TeacherSubjects;
use App\Models\User;
use App\Traits\HasCarbon;
use App\Traits\HasSchoolYear;
use App\Traits\HasSettings;
use App\Traits\HasSubject;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class TeacherManager
{

    use HasCarbon, HasSettings, HasSchoolYear, HasSubject;




    public function index()
    {


        $teachers = User::teachers()->get();

        $teachers->load(['profile','teacher.department']);
        return response()->json($teachers);



    }

    public function getTeacher(String $id){
        $teacher = User::find($id);

        $teacher->load(['teacher.department','profile']);

        
        return response()->json(
            [
                'teacher'=>$teacher,
                'current_school_year'=>$this->currentSchoolYear(),
                'current_semester'=>$this->currentSemester()
            ]
        );


    }

    public function store($data)
    {
        Validator::make($data, [
            'user_id' => ['required'],
            'department_id' => ['required'],
        ])->validate();

        $teacher = Teacher::create($data);

        return response()->json($teacher);


    }



    public function getPending()
    {

        $pending = User::pending()->get();

        if($pending){
            $pending->load(['profile']);

        }
       
        return response()->json([
            'pending' => $pending
        ]);

    }

    public function accept(string $id)
    {

        $user = User::where('id', $id)->first();

        if ($user) {
            $teacher = $user->teacher;
            if ($teacher) {
                $teacher->status = "active";
                $teacher->save();
            }

            return response()->json(['message' => 'User Accepted']);
        }

        return response()->json(['message' => 'User not found'], 404);


    }

    public function reject(string $id)
    {

        $user = User::find($id);

        $user->update(['rejected_at' => $this->getNow()]);


        return response()->json(
            ['message' => 'User Rejected', 'user' => $user]

        );
    }

    public function insertSubjects($subjects, $id)
    {
        try {
            DB::transaction(function () use ($subjects, $id) {
                foreach ($subjects as $subject) {
                    TeacherSubjects::create([
                        'teacher_id' => $id,
                        'subject_id' => $subject['id'],
                        'school_year' => $this->currentSchoolYear(),
                        'semester' => $this->currentSemester(),
                    ]);
                }
            });
    
            return response()->json([
                'message' => 'Subjects Added'
            ]);
        } catch (\Exception $e) {
            // Handle the exception, log it, or return an error response
            return response()->json([
                'message' => 'Failed to add subjects',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    public function addSchedule(String $id, $data){
        $teacherSubject = TeacherSubjects::find($id);

        return $teacherSubject->addSchedule($data);

       
    }

    public function getSchedules($teacher_id){

        $teacher =  TeacherSubjects::where('teacher_id',$teacher_id)->first();

        return $teacher->getSchedules();


    }

    public function getSubjectSchedules($teacher_subject_id){


        $teacherSubject = TeacherSubjects::find($teacher_subject_id);




        
        return response()->json($teacherSubject->schedules);

    }




}
