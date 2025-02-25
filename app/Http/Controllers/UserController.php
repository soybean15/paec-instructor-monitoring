<?php

namespace App\Http\Controllers;

use App\Http\Managers\UserManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    //

    protected UserManager $manager;

    public function __construct(UserManager $manager){
        $this->manager = $manager;
    }

    public function index(Request $request){

        $user = $request->user();
        $user->load(['profile','teacher']);
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

        // return response()->json([
            
        //     'request'=>$request->all(),
        //     'id'=>$id
        // ]);

    }


    public function getClasses(String $id){
        return $this->manager->getClasses($id);
    }

    public function getSchedules(String $id){
        return $this->manager->getUserSchedules($id);
    }

    public function getSubjectSchedules(String $id){
        return $this->manager->getSubjectSchedules($id);

    }

    public function uploadPhoto(Request $request){

        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:2048', // Example rules
        ]);


        if ($validator->fails()) {

            return response()->json([
                'errors' => $validator->errors(),

            ],412);
        }

        return $this->manager->upload($request['id'], $request->file('image'));
    }
}
