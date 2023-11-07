<?php

namespace App\Traits;
use Illuminate\Support\Carbon; 


trait HasSchoolYear{
    use HasSettings;




    public function currentSchoolYear(){

        $now = Carbon::now();
        $currentMonth = $now->format('n');
        $schoolYearStart = $this->getSetting('school_year_start');

        if ($currentMonth >= $schoolYearStart) {
           
            $currentYear = $now->format('Y');
            $nextYear = $currentYear + 1;
            return $currentYear . '-' . $nextYear;
        } else {
           
            $currentYear = $now->format('Y');
            $previousYear = $currentYear - 1;
            return $previousYear . '-' . $currentYear;
        }
        

    }

    public function semester(){

    }
}