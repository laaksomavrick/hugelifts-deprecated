<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Exercise;
use App\Models\Routine;
use App\Services\PopulateNewUserService;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function routines()
    {
        return $this->hasMany(Routine::class);
    }

}
