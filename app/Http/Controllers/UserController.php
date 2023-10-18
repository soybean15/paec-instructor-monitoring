<?php

namespace App\Http\Controllers;

use App\Http\Managers\UserManager;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    protected UserManager $manager;

    public function __construct(UserManager $manager){
        $this->manager = $manager;
    }

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

    public function updateProfile(Request $request,String $id){

       return $this->manager->updateProfile($request->all(),$id);

        return response()->json([
            
            'request'=>$request->all(),
            'id'=>$id
        ]);

    }
}
