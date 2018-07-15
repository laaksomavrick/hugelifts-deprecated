<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

use App\Repositories\ScheduleRepository;
use App\Repositories\RoutineDayRepository;
use App\Repositories\RoutineRepository;
use App\Models\RoutineSchedule;
use App\Models\Routine;

class ScheduleChangeService
{

    protected $scheduleRepository;
    protected $routineDayRepository;
    protected $routineRepository;

    public function __construct(ScheduleRepository $scheduleRepository,
                                RoutineDayRepository $routineDayRepository,
                                RoutineRepository $routineRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
        $this->routineDayRepository = $routineDayRepository;
        $this->routineRepository = $routineRepository;
    }

    public function run($routine)
    {
        $active = $routine->active;
        $userId = $routine->user_id;

        if ($active) {

            $routineId = $routine->id;
            $routineDayId = $this->routineDayRepository->get($routineId)->first()->id;

            RoutineSchedule::where(['user_id' => $userId])->delete();
            $this->scheduleRepository->create($userId, $routineId, $routineDayId);

            Routine::whereNotIn('id', [$routineId])->update(['active' => 0]);

        } else {

            $routineId = $this->routineRepository->find(['active' => true])->first()->id;
            $routineDayId = $this->routineDayRepository->get($routineId)->first()->id;

            RoutineSchedule::where(['user_id' => $userId])->delete();
            $this->scheduleRepository->create($userId, $routineId, $routineDayId);

        }
    }

}
