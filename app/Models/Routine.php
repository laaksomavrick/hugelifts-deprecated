<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RoutineExercise;

class Routine extends Model
{

    protected $with = ['exercises.sets'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exercises()
    {
        return $this->hasMany(RoutineExercise::class);
    }

}
