<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\CreateUser;
Use App\Repositories\UserRepository;
use App\Services\PopulateNewUserService;

class UsersController extends Controller 
{

    public function get(Request $request) 
    {
        $user = $request->user();
        return response($user, 200);
    }

    public function create(CreateUser $request, UserRepository $users, PopulateNewUserService $service) 
    {
        $validated = $request->validated();
        $user = $users->create($validated);
        $service->run($user);
        return response($user, 200);
    }

    public function update(Request $request) 
    {

    }

    public function destroy(Request $request) 
    {

    }

}
