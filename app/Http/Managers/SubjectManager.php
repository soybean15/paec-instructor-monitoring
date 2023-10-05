<?php

namespace App\Http\Managers;
use App\Actions\Academics\CreateSubject;

class SubjectManager{




    function store ($data){

        $createSubject = new CreateSubject();

        $subject =  $createSubject->execute($data);

        return response()->json([
            'subject'=>$subject
        ]);

    }


}