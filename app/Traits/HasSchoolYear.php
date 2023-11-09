<?php

namespace App\Traits;
use Illuminate\Support\Carbon; 


trait HasSchoolYear{
    use HasSettings;

    protected $semester=1;



    public function currentSchoolYear(){

        $now = Carbon::now();
        $currentMonth = $now->format('n');
        $schoolYearStart = $this->getSetting('school_year_start');

        if ($currentMonth >= $schoolYearStart) {
           
            $this->semester = 1;
            $currentYear = $now->format('Y');
            $nextYear = $currentYear + 1;
            return $currentYear . '-' . $nextYear;
        } else {
           
            $currentYear = $now->format('Y');
            $previousYear = $currentYear - 1;
            $this->semester = 2;
            return $previousYear . '-' . $currentYear;
        }
        

    }



    public function currentSemester(){
        return $this->semester;
    }
}