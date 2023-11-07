<?php

namespace App\Traits;
use Illuminate\Support\Carbon; 


trait HasCarbon
{

    public function getNow(){
        return Carbon::now();
    }

    


}
