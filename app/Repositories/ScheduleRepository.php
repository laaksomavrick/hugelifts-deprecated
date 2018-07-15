<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\RoutineSchedule;
use App\Models\Routine;
use App\Repositories\RoutineDayRepository;

class ScheduleRepository
{

    public function create($userId, $routineId, $routineDayId)
    {
        return RoutineSchedule::create([
            'routine_id' => $routineId,
            'routine_day_id' => $routineDayId,
            'user_id' => $userId
        ]);
    }

    public function destroy($id)
    {
        return RoutineSchedule::destroy($id);
    }

    public function getActive($userId)
    {
        return Routine::where(['user_id' => $userId, 'active' => 1])->first()->schedule;
    }

    public function incrementOrdinal($scheduleId, RoutineDayRepository $routineDays)
    {
        $schedule = RoutineSchedule::find($scheduleId)->load('day');
        $ordinals = $routineDays->ordinals($schedule->routine_id);

        $currentOrdinal = $schedule->day->ordinal;
        $lastOrdinal = $ordinals->last();

        $newRoutineDayId;

        if ($currentOrdinal == $lastOrdinal['ordinal']) {
            $newRoutineDayId = $ordinals->first()['id'];
        } else {
            //TODO: + 1 here is bad, could be false
            $newRoutineDayId = $ordinals->where('ordinal', $currentOrdinal + 1)->first()['id'];
        }

        return $schedule->update(['routine_day_id' => $newRoutineDayId]);
    }

}
