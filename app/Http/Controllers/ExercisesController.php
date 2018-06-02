<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Repositories\ExerciseRepository;

class ExercisesController extends Controller 
{

    public function get(Request $request, ExerciseRepository $exercises) 
    {
        $data = $exercises->getFor($request->user()->id);
        return response($data, 200);
    }

    public function create(Request $request) 
    {
    }

    public function update(Request $request) 
    {
    }

    public function destroy(Request $request) 
    {
    }

}
