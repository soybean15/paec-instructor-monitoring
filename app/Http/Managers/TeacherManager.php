<?php

namespace App\Http\Managers;
use App\Models\User;



class TeacherManager{




  

    public function getPending(){

        $pending = User::pending()->get();

        return response()->json([
            'pending'=> $pending 
        ]);
        
    }


}
