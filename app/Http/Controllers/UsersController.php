<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\CreateUser;
Use App\Repositories\Users;

class UsersController extends Controller {

    public function get(Request $request) {

    }

    public function create(CreateUser $request, Users $users) {

        //TODO: lots of logic here
            //move user creation somewhere more appropriate ~> UserRepository
            //move token generation somewhere more appropriate ~> It's own controller
            // Write tests for login, front end specifically for refreshing

        $validated = $request->validated();
        $user = $users->create($validated);

        //TODO: move below to a .then() client side to get the access token perhaps

        /*$client = DB::table('oauth_clients')->where('password_client', 1)->first();

        $request->request->add([
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $data['email'],
            'password' => $data['password'],
            'scope' => null
        ]);

        $proxied = Request::create('oauth/token', 'POST');

        return \Route::dispatch($proxied); */

        return response($user, 200);

    }

    public function update(Request $request) {

    }

    public function destroy(Request $request) {

    }

}
