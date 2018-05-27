<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class TokensController extends Controller 
{

    private $client;

    public function __construct()
    {
        //TODO: should this be in a service provider instead on app bootstrap?
        $this->client = DB::table('oauth_clients')->where('password_client', 1)->first();
    }

    public function authenticate(Request $request) 
    {

        $request->request->add([
            'grant_type' => 'password',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => null
        ]);

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        return Route::Dispatch($proxy);
    }

    public function refresh(Request $request) 
    {
        //TODO
    }

}
