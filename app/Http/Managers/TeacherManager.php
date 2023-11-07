<?php

namespace App\Http\Managers;
use App\Models\User;



class TeacherManager{




  

    public function getPending(){

        $pending = User::pending()->get();

        $pending->load(['profile']);

        return response()->json([
            'pending'=> $pending 
        ]);
        
    }


}
