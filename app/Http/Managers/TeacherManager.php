<?php

namespace App\Http\Managers;

use App\Models\Teacher;
use App\Models\User;
use App\Traits\HasCarbon;



class TeacherManager
{

    use HasCarbon;



    public function index(){

        

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

        Teacher::create([
            'user_id' => $id
        ]);


        return response()->json(['message' => 'User Accepted']);


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
