<?php

namespace App\Traits; 
trait HasSubject{



    public function validate($attribute){

        switch ($attribute){
            case 'name':{
                return ['required','string'];
            }
            case 'year_level':{
                return ['required','string'];
            }
            case 'semester':{
                return ['required','string'];
            }
            case 'number_of_units':{
                return ['required','string'];
            }

            default:{
                return [];
            }
           
        }

    }



    public function addSubjects($data){
        
    }





}