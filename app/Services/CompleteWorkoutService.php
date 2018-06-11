<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

use App\Services\Service;
use App\Repositories\ScheduleRepository;
use App\Repositories\RoutineDayRepository;

class CompleteWorkoutService implements Service
{

    protected $schedules;
    protected $days;
    protected $scheduleId;

    public function __construct(ScheduleRepository $schedules, RoutineDayRepository $routineDays)
    {
        $this->schedules = $schedules;
        $this->days = $routineDays;
        $this->scheduleId = $schedules->getActive(Auth::user()->id)->id;
    }

    public function run()
    {
        return $this->schedules->incrementOrdinal($this->scheduleId, $this->days);
    }

}
