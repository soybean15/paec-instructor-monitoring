<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    //

    public function index()
    {



        return response()->json([
            'teacher_count' => User::teachers()->count(),
            'teacher_pending_count' => User::pending()->count(),
            'total_users' => User::count(),
            'course_count' => Course::count(),
            'subject_count' => Subject::count(),
            'department_count' => Department::count()

        ]);

    }

    public function getTodaySchedules()
    {

        $dayOfWeek = Carbon::now()->format('N');

        $schedules = Schedule::with([
            'teacherSubject' => ['teacher' => [
                'user' => ['profile']
            ]]
        ])->where('day', $dayOfWeek)->get();

        return response()->json([
            'day' => $dayOfWeek,
            'schedules' => $schedules
        ]);


    }
}
