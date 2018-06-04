<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Models\Routine;

class RoutineRepository
{

    public function get($user) 
    {
        return $user->routines;
    }

    public function create($userId, $data)
    {
    }

    public function update($id, $data)
    {
    }

    public function show($id) 
    {
    }

    public function destroy($id)
    {
    }

}
