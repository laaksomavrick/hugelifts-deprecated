<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRepository
{

    public function create($data) {

        return User::Create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

    }

}
