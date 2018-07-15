<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Routine\UpdateRoutine;
use App\Http\Requests\Routine\CreateRoutine;;
use App\Http\Requests\Routine\DeleteRoutine;;
use App\Services\ScheduleChangeService;

Use App\Repositories\RoutineRepository;

class RoutinesController extends Controller 
{

    public function get(Request $request, RoutineRepository $routines) 
    {
        $data = $routines->get($request->user());
        return response($data, 200);
    }

    public function create(CreateRoutine $request, RoutineRepository $routines, ScheduleChangeService $service) 
    {
        $validated = $request->validated();
        $routine = $routines->create($request->user()->id, $validated);
        $service->run($routine);
        return response($routine, 200);
    }

    public function update($routineId, UpdateRoutine $request, RoutineRepository $routines, ScheduleChangeService $service) 
    {
        $validated = $request->validated();
        $routine = $routines->update($routineId, $validated);
        $service->run($routine);
        return response($routine, 200);
    }

    public function destroy($routineId, DeleteRoutine $request, RoutineRepository $routines) 
    {
        $routine = $routines->destroy($routineId);
        return response($routine, 200);
    }

}
