<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Http\Requests\Exercise\CreateExercise;
Use App\Http\Requests\Exercise\UpdateExercise;
Use App\Http\Requests\Exercise\DeleteExercise;
Use App\Repositories\ExerciseRepository;

class ExercisesController extends Controller 
{

    public function get(Request $request, ExerciseRepository $exercises) 
    {
        $data = $exercises->get($request->user()->id);
        return response($data, 200);
    }

    public function create(CreateExercise $request, ExerciseRepository $exercises) 
    {
        $validated = $request->validated();
        $exercise = $exercises->create($request->user()->id, $validated);
        return response($exercise, 200);
    }

    public function update($exerciseId, UpdateExercise $request, ExerciseRepository $exercises) 
    {
        $validated = $request->validated();
        $exercise = $exercises->update($exerciseId, $validated);
        return response($exercise, 200);
    }

    public function destroy($exerciseId, DeleteExercise $request, ExerciseRepository $exercises) 
    {
        $exercise = $exercises->destroy($exerciseId);
        return response($exercise, 200);
    }

}
