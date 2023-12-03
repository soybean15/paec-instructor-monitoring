<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index(){



        return response()->json([
            'teacher_count'=> User::teachers()->count(),
            'teacher_pending_count'=> User::pending()->count(),
            'total_users'=>User::count(),
            'course_count'=>Course::count(),
            'subject_count'=>Subject::count(),
            'department_count'=>Department::count()

        ]);

    }
}
