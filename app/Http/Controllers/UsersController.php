<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller {

    public function get(Request $request) {

    }

    public function create(Request $request) {

        //TODO: lots of logic here
            //move validator to validator class
            //move error handler response to generic way of handling
            //move user creation somewhere more appropriate
            //move token generation somewhere more appropriate
            //move user + token return somewhere more appropriate
            //encapsulate all of these processes into a service (UserCreationService) ~> DI
        
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


        //TODO token

        return response($user, 200);

    }

    public function update(Request $request) {

    }

    public function destroy(Request $request) {

    }

}
