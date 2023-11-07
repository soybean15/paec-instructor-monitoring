<?php

namespace App\Actions\User;
use App\Models\User;
use App\Rules\IsAdult;
use Illuminate\Support\Facades\Validator;
class UpdateProfile{


    public function execute($attributes, $id){

        $user = User::find($id);

        Validator::make($attributes, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'=>['required', 'string', 'max:255'],
            'gender'=>['required'],
            'birthdate' => ['required' ,new IsAdult()],
         
           
        ])->validate();


        //return response()->json($attributes);
        try {

         
    
          

                foreach ($attributes as $attribute => $value) {
                    $user->profile->update([$attribute => $value]);
                }

        
                return response()->json([
                    'user' => $user
                ]);
       

        } catch (\Exception $e) {
               $errors = json_decode($e->getMessage(), true);
            return response()->json(['errors' => $errors], $e->getCode());
            if ($e->getCode() == 422) {
             
                //return 422;
             
            }

            return response()->json($e->getMessage(), 404);
        }






        
    }

}
