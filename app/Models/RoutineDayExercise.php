<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoutineDay;
use App\Models\Set;

class RoutineDayExercise extends Model
{

    public function routineDay()
    {
        return $this->belongsTo(RoutineDay::class);
    }

    public function sets()
    {
        return $this->hasMany(Set::class);
    }

}
