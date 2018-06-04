<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Repositories\RoutineRepository;

class RoutinesController extends Controller 
{

    public function get(Request $request, RoutineRepository $routines) 
    {
        $data = $routines->get($request->user());
        return response($data, 200);
    }

    public function create(CreateExercise $request, ExerciseRepository $exercises) 
    {
    }

    public function update($exerciseId, UpdateExercise $request, ExerciseRepository $exercises) 
    {
    }

    public function destroy($exerciseId, DeleteExercise $request, ExerciseRepository $exercises) 
    {
    }

}
