<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\CreateUser;
Use App\Repositories\Users;

class UsersController extends Controller 
{

    public function get(Request $request) 
    {

    }

    public function create(CreateUser $request, Users $users) 
    {
        $validated = $request->validated();
        $user = $users->create($validated);
        return response($user, 200);
    }

    public function update(Request $request) 
    {

    }

    public function destroy(Request $request) 
    {

    }

}
