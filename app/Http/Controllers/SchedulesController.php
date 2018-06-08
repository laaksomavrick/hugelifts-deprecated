<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Routine;

class SchedulesController extends Controller 
{
    
    public function show(Request $request) 
    {
        $data = Routine::where(['user_id' => $request->user()->id, 'active' => 1])->first()->schedule;
        return response($data, 200);
    }

    public function update(Request $request) 
    {

    }

}
