<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Repositories\ExercisesRepository;

class ExercisesController extends Controller 
{

    public function get(Request $request, ExercisesRepository $exercises) 
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
