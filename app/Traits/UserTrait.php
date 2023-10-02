<?php

namespace App\Traits;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Validator;


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

    public function validate($attributes)
    {


        foreach ($attributes as $attribute => $value) {
            switch ($attribute) {
                case 'email':
                    $validationRules[$attribute] = 'required|email';
                    break;

                case 'firstname':
                    $validationRules[$attribute] = 'required|string';
                    break;

                case 'lastname':
                    $validationRules[$attribute] = 'required|string';
                    break;

                case 'contact_number':
                    $validationRules[$attribute] = 'required|regex:/^[0-9]{10}$/';
                    break;

                case 'birthdate':
                    $validationRules[$attribute] = 'required|date|before:today|after:1900-01-01';
                    break;



                // Add more cases for other attributes as needed

                default:
                    return true;

            }
        }

        $validator = Validator::make($attributes, $validationRules);



        if ($validator->fails()) {
            throw new \Exception($validator->errors(), 422);
        } else {
            return true;
        }

    }

}