<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCreationTest extends TestCase
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

    public function testUserNeedsEmailAndPassword()
    {
        $response = $this->json('POST', '/api/user', [
            'name' => 'name',
        ]);
        $response->assertStatus(422);
    }

}
