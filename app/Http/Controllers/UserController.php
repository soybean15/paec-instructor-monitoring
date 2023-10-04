<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(Request $request){

        $user = $request->user();
        $user->load(['profile']);
        return response()->json([


            'user'=>$user
        ]);

    }

    public function isAdmin(Request $request){


        $user= $request->user();


        return response()->json([
            $user->isAdmin()
        ]);


    }
}
