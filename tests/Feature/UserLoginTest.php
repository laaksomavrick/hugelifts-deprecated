<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserLoginTest extends TestCase
{

    use DatabaseTransactions;

    public function testUserCanLogin()
    {

        $userCreation = $this->json('POST', '/api/user', [
            'name' => 'name',
            'email' => 'email@gmail.ca',
            'password' => 'password',
        ]);

        $userAuthentication = $this->json('POST', '/api/token/authenticate', [
            'email' => 'email@gmail.ca',
            'password' => 'password',
        ]);

        $userAuthentication
            ->assertStatus(200);
    }

    public function testUserNeedsPasswordToLogin()
    {

        $userCreation = $this->json('POST', '/api/user', [
            'name' => 'name',
            'email' => 'email@gmail.ca',
            'password' => 'password',
        ]);

        $userAuthentication = $this->json('POST', '/api/token/authenticate', [
            'email' => 'email@gmail.ca',
            'password' => 'badpassword',
        ]);

        $userAuthentication->assertStatus(401);
    }
}
