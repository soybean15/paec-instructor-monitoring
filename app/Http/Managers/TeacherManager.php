<?php

namespace App\Http\Managers;

use App\Models\Teacher;
use App\Models\User;
use App\Traits\HasCarbon;
use App\Traits\HasSchoolYear;
use App\Traits\HasSettings;

use Illuminate\Support\Facades\Validator;

class TeacherManager
{

    use HasCarbon, HasSettings, HasSchoolYear;




    public function index()
    {


        $teachers = User::teachers()->get();

        $teachers->load(['profile','teacher.department']);
        return response()->json($teachers);



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

        $pending->load(['profile']);

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





}
