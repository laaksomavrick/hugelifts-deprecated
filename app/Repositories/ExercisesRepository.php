<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Models\Exercise;

class ExercisesRepository
{

    public function getFor($userId) 
    {
        return Exercise::where('user_id', $userId)->get();
    }

}
