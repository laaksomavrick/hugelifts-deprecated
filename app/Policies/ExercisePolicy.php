<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Exercise;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExercisePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the exercise.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Exercise  $exercise
     * @return mixed
     */
    public function view(User $user, Exercise $exercise)
    {
        return $user->id == $exercise->user_id;
    }

    /**
     * Determine whether the user can create exercises.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the exercise.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Exercise  $exercise
     * @return mixed
     */
    public function update(User $user, Exercise $exercise)
    {
        return $user->id == $exercise->user_id;
    }

    /**
     * Determine whether the user can delete the exercise.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Exercise  $exercise
     * @return mixed
     */
    public function delete(User $user, Exercise $exercise)
    {
        return $user->id == $exercise->user_id;
    }
}
