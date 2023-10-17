<?php

namespace App\Http\Managers;
use App\Actions\Academics\CreateCourse;
use App\Traits\HasSubject;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;

class CourseManager{

    use HasSubject;

    function store ($data){

        $createCourse = new CreateCourse();

        $course = $createCourse->execute($data);

        return response()->json([
            'course' => $course
        ]);
    }





    function update($data, $id)
    {
        $course = Course::find($id);



        $attribute = $data['attribute'];
        $newValue = $data['value'];

        try {



            $validator = Validator::make($data, [
                'value' => $this->validate($attribute),
            ]);

            if ($validator->fails()) {

                throw new \Exception($validator->errors(), 422);
              
            }

            if ($course) {



                $course[$attribute] = $newValue;

                $course->save();


                return response()->json([
                    'message' => 'Course Updated Succesfully',
                    'status' => 'success'

                ]);

            } else {

                throw new \Exception("No Course Found", 422);
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


        $course = Course::find($id);

        try{

            if(!$course){
                throw new \Exception("Course not found", 404);
            }

            $course->delete();


            return response()->json([

                'message'=>'Course Successfully Deleted',
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

        $courses = Course::where('name', 'LIKE', "$val%")->paginate(10);

      
        return response()->json([
            'courses'=>$courses
        ]); 


    }
   


   
}