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

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    public function day()
    {
        return $this->belongsTo(RoutineDay::class, 'routine_day_id');
    }

}
