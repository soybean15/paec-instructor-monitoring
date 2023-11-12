<?php

namespace App\Traits;
use App\Models\Schedule;
use App\Models\TeacherSubjects;
use Illuminate\Support\Facades\Validator;

trait HasSchedule{

    use HasSchoolYear;

    


    public function addSchedule($data)
{
    Validator::make($data, [
        'day' => ['required'],
        'start' => ['required', 'date_format:H:i'],
        'end' => ['required', 'date_format:H:i', 'after:start'],
    ])->validate();

    try {
        $schedules = TeacherSubjects::where('semester', $this->currentSemester())
            ->where('school_year', $this->currentSchoolYear())
            ->where('teacher_id', $this->teacher_id)
            ->with('schedules')
            ->first();

        $existingSchedules = $schedules->schedules;

        // Check for overlap with existing schedules
        foreach ($existingSchedules as $existingSchedule) {
            if($existingSchedule->day == $data['day']) {
                if (
                    ($data['start'] >= $existingSchedule->start && $data['start'] < $existingSchedule->end) ||
                    ($data['end'] > $existingSchedule->start && $data['end'] <= $existingSchedule->end) ||
                    ($data['start'] <= $existingSchedule->start && $data['end'] >= $existingSchedule->end)
                ) {
                    return response()->json([
                        'message' => 'Schedule overlaps with an existing schedule.',
                    ], 400);
                }

            }
          
        }

        // Create the new schedule if no overlap is found
        $newSchedule = new Schedule([
            'day' => $data['day'],
            'start' => $data['start'],
            'end' => $data['end'],
            'section' => $data['section'],
            'room' => $data['room'],
        ]);

        $schedules->schedules()->save($newSchedule);

        return response()->json([
            'message' => 'Schedule added successfully.',
            'new_schedule' => $newSchedule,
        ]);
    } catch (\Exception $e) {
        // Handle exception
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}