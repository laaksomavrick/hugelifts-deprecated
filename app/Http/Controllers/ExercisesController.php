<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\Models\Exercises; //TODO repository;

class ExercisesController extends Controller 
{

    public function get(Request $request) 
    {
        return response(['hi' => 'hello'], 200);
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
