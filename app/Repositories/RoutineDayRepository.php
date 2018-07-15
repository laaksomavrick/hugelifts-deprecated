<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\RoutineDay;

class RoutineDayRepository
{

    public function get($routineId)
    {
        return RoutineDay::where('routine_id', $routineId);
    }

    public function ordinals($routineId) {
        $days = RoutineDay::where('routine_id', $routineId)->get();
        return $days->map(function ($day) {
            return ['ordinal' => $day->ordinal, 'id' => $day->id];
        });
    }

}
