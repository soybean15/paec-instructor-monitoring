<?php

namespace App\Actions\User;
use App\Models\User;

class UpdateProfile{


    public function execute($attributes, $id){

        $user = User::find($id);

        try {
            if ($user->validate($attributes)) {

                foreach ($attributes as $attribute => $value) {
                    $user->profile->update([$attribute => $value]);
                }

               // return $value;




                return response()->json([
                    'user' => $user
                ]);
            }

        } catch (\Exception $e) {
            if ($e->getCode() == 422) {
                $errors = json_decode($e->getMessage(), true);
                //return 422;
                return response()->json(['errors' => $errors], $e->getCode());
            }

            return response()->json($e->getMessage(), 404);
        }






        
    }

}
