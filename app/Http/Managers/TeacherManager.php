<?php

namespace App\Http\Managers;
use App\Traits\HasPending;


class TeacherManager{




    use HasPending;

    public function getPending(){
        return response()->json([
            'pending'=>$this->pending()
        ]);
        
    }


}
