<?php

namespace App\Http\Managers;
use App\Actions\User\UpdateProfile;


class UserManager
{
    private UpdateProfile $updateProfile;

    public function __construct( UpdateProfile $updateProfile)
    {
        $this->updateProfile = $updateProfile;
    }


    public function updateProfile($attributes, $id){

        return $this->updateProfile->execute($attributes,$id);
    }


}