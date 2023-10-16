<?php
namespace App\Traits;
use App\Models\Teacher; 


trait HasPending{



    public function pending(){
        $pending = Teacher::pending()->get();

        return $pending;
      
    }
}