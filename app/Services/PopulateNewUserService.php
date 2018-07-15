<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Exercise;
use App\Models\RoutineDay;
use App\Repositories\RoutineRepository;
use App\Repositories\ScheduleRepository;
use App\Services\Service;

class PopulateNewUserService
{

    protected $routineRepository;

    // TODO: learn how to type hint for service IoC
    public function __construct(RoutineRepository $routineRepository, ScheduleRepository $scheduleRepository)
    {
        $this->routineRepository = $routineRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    public function run(User $user)
    {
        $userId = $user->id;

        // create some exercises
        $exercises = [
            [
                'user_id' => $userId,
                'name' => 'Bench Press',
                'rep_max' => '135',
                'rep_max_interval' => '1'
            ],
            [
                'user_id' => $userId,
                'name' => 'Squat',
                'rep_max' => '135',
                'rep_max_interval' => '1'
            ],
            [
                'user_id' => $userId,
                'name' => 'Pendlay Row',
                'rep_max' => '135',
                'rep_max_interval' => '1'
            ],
            [
                'user_id' => $userId,
                'name' => 'Deadlift',
                'rep_max' => '135',
                'rep_max_interval' => '1'
            ],
            [
                'user_id' => $userId,
                'name' => 'Overhead Press',
                'rep_max' => '135',
                'rep_max_interval' => '1'
            ],
        ];

        $user->exercises()->createMany($exercises);

        // Create a simple A / B routine

        $exercises = Exercise::where('user_id', $userId)->get();

        $benchPressId;
        $squatId;
        $pendlayRowId;
        $deadliftId;
        $overheadPressId;

        foreach ($exercises as $exercise) 
        {
            $name = $exercise->name;
            $id = $exercise->id;
            switch ($name) {
                case 'Bench Press':
                    $benchPressId = $id;
                    break;
                case 'Squat':
                    $squatId = $id;
                    break;
                case 'Pendlay Row':
                    $pendlayRowId = $id;
                    break;
                case 'Deadlift':
                    $deadliftId = $id;
                    break;
                case 'Overhead Press':
                    $overheadPressId = $id;
                    break;
                default:
                    break;
            }
        }

        $routine = [
            'name' => '3 Day 5x5',
            'active' => 1,
            'days' => array([
                'name' => 'A',
                'ordinal' => 0,
                'exercises' => array([
                    'exercise_id' => $squatId,
                    'ordinal' => 0,
                    'sets' => array([
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ])
                ],
                [
                    'exercise_id' => $benchPressId,
                    'ordinal' => 1,
                    'sets' => array([
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ])
                ],
                [
                    'exercise_id' => $pendlayRowId,
                    'ordinal' => 2,
                    'sets' => array([
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ])
                ]),
            ],
            [
                'name' => 'B',
                'ordinal' => 1,
                'exercises' => array([
                    'exercise_id' => $squatId,
                    'ordinal' => 0,
                    'sets' => array([
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ])
                ],
                [
                    'exercise_id' => $overheadPressId,
                    'ordinal' => 1,
                    'sets' => array([
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ])
                ],
                [
                    'exercise_id' => $deadliftId,
                    'ordinal' => 2,
                    'sets' => array([
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ],
                    [
                        'reps' => 5,
                        'percentage' => 80
                    ])
                ])
            ])
        ];

        $routineId = $this->routineRepository->create($userId, $routine)->id;
        $routineDayId = RoutineDay::where('routine_id', $routineId)
            ->where('ordinal', 0)
            ->first()
            ->id;
        $this->scheduleRepository->create($userId, $routineId, $routineDayId);

    }

}