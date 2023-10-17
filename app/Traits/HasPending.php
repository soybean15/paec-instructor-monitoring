<?php
namespace App\Traits;
use App\Models\Teacher; 


trait HasPending{



    public function pending(){
        return Teacher::pending()->with('user.profile')->get();

      
    }
}