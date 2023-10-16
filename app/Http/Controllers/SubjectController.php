<?php

namespace App\Http\Controllers;

use App\Http\Managers\SubjectManager;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    
 
    protected SubjectManager $manager;
    public function __construct(SubjectManager $manager)
    {
        $this->manager = $manager;
    }


    public function index(){
        $subjects = Subject::with('course')->paginate(10);

        return response()->json([
            'subjects'=>$subjects
        ]);
    }

    

    public function store(Request $request ){

    

        // return response()->json([

        //     'request'=>$request->all()
        // ]);

        $this->manager->store($request->all());

    }

    public function update(Request $request){


        return $this->manager->update(
            [
                'attribute'=>$request['attribute'],
                'value'=>$request['value']
            ], 
            $request['id']
        );
    }

    public function destroy(Request $request){



            return $this->manager->destroy($request['id']);
    }
   
}
