<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Routine;
use App\Models\Set;

class RoutineExercise extends Model
{

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    public function sets()
    {
        return $this->hasMany(Set::class);
    }

}
