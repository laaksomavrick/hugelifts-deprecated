<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

use App\Services\Service;
use App\Repositories\ScheduleRepository;
use App\Repositories\RoutineDayRepository;
use App\Repositories\ExerciseRepository;

class CompleteWorkoutService implements Service
{

    protected $schedules;
    protected $days;
    protected $exercises;
    protected $userId;
    protected $scheduleId;
    protected $records;

    public function __construct(ScheduleRepository $schedules, RoutineDayRepository $routineDays, ExerciseRepository $exercises)
    {
        $this->schedules = $schedules;
        $this->days = $routineDays;
        $this->exercises = $exercises;
        $this->userId = Auth::user()->id;
        $this->scheduleId = $schedules->getActive($this->userId)->id;
    }

    public function setRecords(array $records)
    {
        $this->records = $records['records'];
    }

    public function run()
    {
        if ($this->records) {
            $ids = collect($this->records)->map(function($r) { return $r['exercise_id']; })->toArray(); 
            $this->exercises->incrementRecords($ids);
        }
        $this->schedules->incrementOrdinal($this->scheduleId, $this->days);
        return $this->schedules->getActive($this->userId);
    }

}
