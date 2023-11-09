<?php

namespace App\Http\Managers;

use App\Actions\Academics\CreateSubject;
use App\Models\Subject;
use App\Traits\HasSubject;
use Illuminate\Support\Facades\Validator;

class SubjectManager
{

    use HasSubject;



    function store($data)
    {



        $createSubject = new CreateSubject();

        $subject = $createSubject->execute($data);

        return response()->json([
            'subject' => $subject
        ]);

    }




    function update($data, $id)
    {
        $subject = Subject::find($id);



        $attribute = $data['attribute'];
        $newValue = $data['value'];

        try {



            $validator = Validator::make($data, [
                'value' => $this->validate($attribute),
            ]);

            if ($validator->fails()) {

                throw new \Exception($validator->errors(), 422);
              
            }

            if ($subject) {



                $subject[$attribute] = $newValue;

                $subject->save();


                return response()->json([
                    'message' => 'Subject Updated Succesfully',
                    'status' => 'success'

                ]);

            } else {

                throw new \Exception("No Subject Found", 422);
            }

        } catch (\Exception $e) {
            if ($e->getCode() == 422) {

                $error = json_decode($e->getMessage(), true);
                $errorMessage = $error['value'][0];


                return response()->json([
                    'message' => $errorMessage,
                    'status' => 'failed'

                ], $e->getCode());
            }


            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'failed'
            ], 404);

        }





    }


    public function destroy($id){


        $subject = Subject::find($id);

        try{

            if(!$subject){
                throw new \Exception("Subject not found", 404);
            }

            $subject->delete();


            return response()->json([

                'message'=>'Subject Successfully Deleted',
                'status'=>'success'
            ]);

        }catch(\Exception $e){


            return response()->json([

                'message'=>$e->getMessage(),
                'status'=>'failed'

            ],$e->getCode());


        }

    }



    public function search (String $val =''){

        $subjects = Subject::where('name', 'LIKE', "$val%")->paginate(10);

      
        return response()->json([
            'subjects'=>$subjects
        ]); 


    }

    public function filterByCourse($id){

        $subjects = Subject::where('cou', $id)->get();

    }





}