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
        if ($request->only('records')) {
            $records = $request->only('records');
            $completeWorkoutService->setRecords($records);
        }
        $data = $completeWorkoutService->run();
        return response($data, 200);
    }

}
