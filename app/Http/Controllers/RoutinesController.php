<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Routine\UpdateRoutine;

Use App\Repositories\RoutineRepository;

class RoutinesController extends Controller 
{

    public function get(Request $request, RoutineRepository $routines) 
    {
        $data = $routines->get($request->user());
        return response($data, 200);
    }

    public function create(CreateExercise $request, RoutineRepository $routines) 
    {
    }

    public function update($routineId, UpdateRoutine $request, RoutineRepository $routines) 
    {
        $validated = $request->validated();
        $routine = $routines->update($routineId, $validated);
        return response($routine, 200);
    }

    public function destroy($exerciseId, DeleteExercise $request, RoutineRepository $routines) 
    {
    }

}
