<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersController extends Controller {

    public function get(Request $request) {

    }

    public function create(Request $request) {

        //TODO: lots of logic here
            //move validator to validator class ~> Validator
            //move error handler response to generic way of handling
            //move user creation somewhere more appropriate ~> UserRepository
            //move token generation somewhere more appropriate ~> It's own controller
            // Write tests for login?
        
        $valid = validator($request->only('name', 'email', 'password'), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if ($valid->fails()) {
            $error = $valid->errors()->all();
            return response([
                'errors' => $error
            ], 500);
        }

        $data = request()->only('name', 'email', 'password');

        $user = User::Create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

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
