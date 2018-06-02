<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Models\Exercise;

class ExerciseRepository
{

    public function getFor($userId) 
    {
        return Exercise::where('user_id', $userId)->get();
    }

    public function create($userId, $data)
    {
        return Exercise::create([
            'user_id' => $userId,
            'name' => $data['name'],
            'rep_max' => $data['rep_max'],
            'rep_max_interval' => $data['rep_max_interval']
        ]);
    }

}
