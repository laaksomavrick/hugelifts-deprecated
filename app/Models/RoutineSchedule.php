<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Routine;
use App\Models\RoutineDay;

class RoutineSchedule extends Model
{

    protected $fillable = [
        'routine_id',
        'routine_day_id',
    ];

    protected $with = [
        'day.exercises.sets'
    ];

    public function routine()
    {
        return $this->belongsTo(Routine::class, 'routine_id');
    }

    public function day()
    {
        return $this->belongsTo(RoutineDay::class, 'routine_day_id');
    }

}
