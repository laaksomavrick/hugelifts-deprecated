<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoutineDayExercise;
use App\Models\RoutineSchedule;
use App\Models\Set;

class RoutineDay extends Model
{

    protected $fillable = [
        'name',
        'routine_id',
        'ordinal'
    ];

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    public function schedule()
    {
        return $this->hasOne(RoutineSchedule::class);
    }

    public function exercises()
    {
        return $this->hasMany(RoutineDayExercise::class);
    }

}
