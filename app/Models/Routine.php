<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RoutineDay;

class Routine extends Model
{

    protected $with = ['days.exercises.sets'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function days()
    {
        return $this->hasMany(RoutineDay::class);
    }

}
