<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\Routine;
use App\Models\RoutineDay;
use App\Models\RoutineDayExercise;
use App\Models\Set;

class RoutineRepository
{

    public function get($user) 
    {
        return $user->routines;
    }

    public function create($userId, $data)
    {
        $routine = Routine::create([
            'user_id' => $userId,
            'name' => $data['name'],
            'active' => $data['active'],
        ]);
        $this->handleRoutineChange($routine->id, $data);
        return $this->show($routine->id);
    }

    public function update($id, $data)
    {
        Routine::where('id', $id)->update(['name' => $data['name'], 'active' => $data['active']]);
        $this->handleRoutineChange($id, $data);
        return $this->show($id);
    }

    public function find($conditions)
    {
        return Routine::where($conditions);
    }

    public function show($id) 
    {
        return Routine::find($id);
    }

    public function destroy($id)
    {
        return Routine::destroy($id);
    }

    private function handleRoutineChange($id, $data)
    {
        $days = $data['days'];

        //TODO optimize nested loops
        DB::transaction(function() use ($id, $days) {

            //clear old records
            RoutineDay::where('routine_id', $id)->delete();

            //get fresh record
            $routine = Routine::setEagerLoads([])->where('id', $id)->first();

            foreach ($days as $day) {
                $day['routine_id'] = $id;
                $createdDay = RoutineDay::create($day);
                foreach ($day['exercises'] as $routineDayExercise) {
                    $routineDayExercise['routine_day_id'] = $createdDay->id;
                    $createdRoutineDayExercise = RoutineDayExercise::create($routineDayExercise);
                    foreach ($routineDayExercise['sets'] as $set) {
                        $set['routine_day_exercise_id'] = $createdRoutineDayExercise->id;
                        $createdSet = Set::create($set);
                    }
                }
            }
        });
    }

}
