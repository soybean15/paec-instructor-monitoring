<?php

namespace App\Traits;
use App\Models\UserProfile;



trait UserTrait
{



    public function createEmptyProfile(){


        UserProfile::create([
            'user_id'=>$this->id,
            'firstname'=>'',
            'lastname'=>'',
            'middlename'=>''
        ]);


    }
}