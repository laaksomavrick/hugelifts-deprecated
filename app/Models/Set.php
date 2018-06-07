<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoutineExercise;

class Set extends Model
{

    protected $fillable = [
        'routine_day_exercise_id',
        'reps',
        'percentage'
    ];
    
    public function routineExercise()
    {
        return $this->belongsTo(RoutineExercise::class);
    }
}
