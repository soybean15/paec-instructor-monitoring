<?php

namespace App\Http\Managers;
use App\Actions\Academics\CreateSubject;
use App\Models\Subject;
use App\Traits\HasSubject;
use Illuminate\Support\Facades\Validator;
class SubjectManager{

    use HasSubject;



    function store ($data){

 

        $createSubject = new CreateSubject();

        $subject =  $createSubject->execute($data);

        return response()->json([
            'subject'=>$subject
        ]);

    }




    function update($data, $id){
        $subject = Subject::find($id);



        $attribute = $data['attribute'];
        $newValue = $data['value'];

        switch($data['value']){
            case 'name':{
                
                break;
            } 


        }
        
        $validator = Validator::make($data, [
            'value' => $this->validate($attribute),
        ]);

        if($validator->fails()){
            $error =$validator->errors();
            $errorMessage = $error->get('value')[0];
            return response()->json([
                'message'=>  $errorMessage,
                'status'=>'failed'
    
            ],422);

        }

        if($subject){

        
    
            $subject[$attribute] = $newValue; 
    
            $subject->save();     


        return response()->json([
            'message'=>'Subject Updated Succesfully',
            'status'=>'success'

        ]);
    
        }else{
            return response()->json([
                'message'=>'Subject not found',
                'status'=>'failed'
            ],404);
        }

      



    }




}