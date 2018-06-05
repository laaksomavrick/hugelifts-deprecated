<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoutineExercise;

class Set extends Model
{
    public function routineExercise()
    {
        return $this->belongsTo(RoutineExercise::class);
    }
}
