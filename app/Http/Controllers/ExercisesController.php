<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Http\Requests\CreateExercise;;
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

    public function update($id, CreateExercise $request, ExerciseRepository $exercises) 
    {
        $validated = $request->validated();
        $exercise = $exercises->update($id, $validated);
        return response($exercise, 200);
    }

    public function destroy(Request $request) 
    {
    }

}
