<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ScheduleRepository;
use App\Services\CompleteWorkoutService;

use App\Models\Routine;

class SchedulesController extends Controller 
{
    
    public function show(Request $request, ScheduleRepository $schedules) 
    {
        $data = $schedules->getActive($request->user()->id);
        return response($data, 200);
    }

    public function update($scheduleId, Request $request, CompleteWorkoutService $completeWorkoutService) 
    {
        //TODO need to update any maxes via ExerciseRepository

        $completeWorkoutService->run();

        $data = Routine::where(['user_id' => $request->user()->id, 'active' => 1])->first()->schedule;

        return response($data, 200);
    }

}
