<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    use DatabaseTransactions;

    public function testUserCanBeCreated()
    {

        $response = $this->json('POST', '/api/user', [
            'name' => 'name',
            'email' => 'email@gmail.ca',
            'password' => 'password',

        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => 'name',
                'email' => 'email@gmail.ca'
            ]);


    }

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
}
