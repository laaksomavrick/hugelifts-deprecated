<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoutineDayExercise;
use App\Models\Set;

class RoutineDay extends Model
{

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    public function exercises()
    {
        return $this->hasMany(RoutineDayExercise::class);
    }

}
